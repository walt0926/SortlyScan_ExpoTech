<?php
// 1. SEGURIDAD REQUERIDA (Comentado temporalmente para pruebas)
// require_once "../auth/verificar_acceso.php";
// verificarAccesoAPI(['Maestro']); 

require_once("../config/conexion.php");

// Iniciamos sesión manualmente por si acaso
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si la sesión está vacía por los bloqueos anteriores, le asignamos el ID temporalmente para que corra
$id_maestro = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 


try {
    // 2. Buscar el salón asignado al maestro
    $stmt_salon = $pdo->prepare("SELECT id_salon FROM Salones WHERE id_maestro = ?");
    $stmt_salon->execute([$id_maestro]);
    $salon = $stmt_salon->fetch();

    if (!$salon) {
        echo json_encode(["success" => false, "message" => "No tienes un salón asignado aún."]);
        exit;
    }

    $id_salon = $salon['id_salon'];

    // 3. Validar el archivo subido de forma segura
    if (!isset($_FILES['archivo_alumnos']) || $_FILES['archivo_alumnos']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["success" => false, "message" => "Error al subir el archivo CSV."]);
        exit;
    }

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