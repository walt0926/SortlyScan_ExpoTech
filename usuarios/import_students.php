<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("../config/conexion.php");

// 1. Capturar el usuario enviado directamente o por sesión por orden de prioridad
$user_session = 'profe_juan'; // Valor por defecto basado en tu setup.php

if (isset($_POST['id_maestro_directo']) && !empty($_POST['id_maestro_directo'])) {
    $user_session = $_POST['id_maestro_directo'];
} elseif (isset($_SESSION['usuario'])) {
    $user_session = $_SESSION['usuario'];
} elseif (isset($_SESSION['user_id'])) {
    $user_session = $_SESSION['user_id'];
}

try {
    $id_salon = null;
    $codigo_aula = isset($_POST['codigo_aula_interfaz']) ? trim($_POST['codigo_aula_interfaz']) : '';

    // 1. Intentar buscar por el código de aula dinámico que viene de la pantalla (SORT26, SORT27, etc.)
    if (!empty($codigo_aula)) {
        $stmt_salon = $pdo->prepare("SELECT id_salon FROM Salones WHERE codigo_aula = ? LIMIT 1");
        $stmt_salon->execute([$codigo_aula]);
        $salon = $stmt_salon->fetch();
        if ($salon) {
            $id_salon = $salon['id_salon'];
        }
    }

    // 2. Si no llegó el código, intentar buscar por la sesión del maestro
    if (!$id_salon && !empty($user_session)) {
        $stmt_maestro = $pdo->prepare("SELECT id_salon FROM Salones WHERE id_maestro = ? LIMIT 1");
        $stmt_maestro->execute([$user_session]);
        $salon = $stmt_maestro->fetch();
        if ($salon) {
            $id_salon = $salon['id_salon'];
        }
    }

    // 3. Si todo lo anterior falla en entorno local, buscar por coincidencia de usuario del setup.php
    if (!$id_salon) {
        $stmt_setup = $pdo->prepare("SELECT id_salon FROM Salones WHERE id_maestro = (SELECT id_usuario FROM Usuarios WHERE usuario = ? LIMIT 1) LIMIT 1");
        $stmt_setup->execute([$user_session]);
        $salon = $stmt_setup->fetch();
        if ($salon) {
            $id_salon = $salon['id_salon'];
        }
    }

    // Si no encontró nada con ninguna regla, lanzar error
    if (!$id_salon) {
        echo json_encode(["success" => false, "message" => "No se pudo identificar el salón correspondiente para este panel."]);
        exit;
    }

    // ASIGNACIÓN CORRECTA Y DINÁMICA
    // Eliminamos el candado fijo de '6to Grado A' para que use la variable limpia
    $file = $_FILES['archivo_alumnos']['tmp_name'];
    $handle = fopen($file, "r");
    
    // Leer la primera línea para detectar si usa coma (,) o punto y coma (;)
    $firstLine = fgets($handle);
    $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';
    
    // Regresar el puntero al inicio del archivo para procesarlo bien
    rewind($handle);

    $insertados = 0;
    $duplicados = 0;

    // Saltar encabezado usando el delimitador detectado
    fgetcsv($handle, 1000, $delimiter); 

    // ⚡ PREPARAR CONSULTAS ANTES DEL CICLO (Mejor rendimiento)
    $check = $pdo->prepare("SELECT id_alumno FROM Alumnos WHERE id_salon = ? AND nombre_display = ?");
    $insert = $pdo->prepare("INSERT INTO Alumnos (id_salon, nombre_display, pin) VALUES (?, ?, ?)");

    // ⚡ INICIAR TRANSACCIÓN: Escritura masiva rápida y segura
    $pdo->beginTransaction();

    // 4. Procesar fila por fila
    while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
        if (!isset($data[0])) continue;

        // Convertir codificación para evitar problemas con eñes y tildes de Excel
        $nombre_estudiante = mb_convert_encoding(trim($data[0]), "UTF-8", "UTF-8, ISO-8859-1, Windows-1252"); 

        if (empty($nombre_estudiante)) continue;

        // Evitar duplicados en el mismo salón
        $check->execute([$id_salon, $nombre_estudiante]);

        if ($check->rowCount() == 0) {
            // Generar PIN de 4 dígitos (ej: 0521)
            $pin_automatico = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            
            $insert->execute([$id_salon, $nombre_estudiante, $pin_automatico]);
            $insertados++;
        } else {
            $duplicados++;
        }
    }
    fclose($handle);

    // Guardar todos los cambios en la base de datos
    $pdo->commit();

    echo json_encode([
        "success" => true, 
        "message" => "Importación terminada exitosamente.",
        "insertados" => $insertados,
        "ignorados" => $duplicados
    ]);

} catch (PDOException $e) {
    // Si algo falla, cancela la transacción para no dejar datos corruptos
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(["success" => false, "message" => "Error de base de datos: " . $e->getMessage()]);
}
?>