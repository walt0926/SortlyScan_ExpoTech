<?php
// public/logic/get_dashboard_docente.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    // 2. Conexión a la base de datos
    $config_path = __DIR__ . '/../../config/conexion.php';
    if (!file_exists($config_path)) {
        throw new Exception("Error interno de configuración del servidor.");
    }
    require_once $config_path;

    // 3. Recepción del ID del Maestro
    $id_maestro = isset($_POST['id_maestro']) ? trim($_POST['id_maestro']) : '';

    if (empty($id_maestro)) {
        throw new Exception("ID de docente no proporcionado.");
    }

    // NUEVO: Obtener información del perfil del maestro
    $stmt_user = $pdo->prepare("SELECT nombre_completo, username FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_user->execute(array(':id' => $id_maestro));
    $user_info = $stmt_user->fetch(PDO::FETCH_ASSOC);

    if (!$user_info) {
        throw new Exception("Usuario maestro no encontrado.");
    }

    // 4. Buscar el salón que le pertenece a este maestro en la tabla Salones
    $stmt_salon = $pdo->prepare("SELECT id_salon, nombre_salon, codigo_aula FROM Salones WHERE id_maestro = :id LIMIT 1");
    $stmt_salon->execute(array(':id' => $id_maestro));
    $salon = $stmt_salon->fetch(PDO::FETCH_ASSOC);

    if (!$salon) {
        $respuesta = array(
            "success" => false,
            "message" => "You don't have an assigned classroom yet. Please contact your Principal."
        );
        ob_clean();
        echo json_encode($respuesta);
        exit;
    }

    $id_salon = $salon['id_salon'];

    // 5. Consultar los alumnos exclusivos de este salón ordenados por ranking
    $stmt_alumnos = $pdo->prepare("
        SELECT id_alumno, nombre_display, puntos_totales, pin 
        FROM Alumnos 
        WHERE id_salon = :id_salon 
        ORDER BY puntos_totales DESC
    ");
    $stmt_alumnos->execute(array(':id_salon' => $id_salon));
    $alumnos = $stmt_alumnos->fetchAll(PDO::FETCH_ASSOC);

    // 6. Construcción de la respuesta estructurada incluyendo datos de perfil
    $respuesta = array(
        "success" => true,
        "aula_nombre" => $salon['nombre_salon'],
        "aula_codigo" => $salon['codigo_aula'],
        "maestro_nombre" => $user_info['nombre_completo'],
        "maestro_user"   => $user_info['username'],
        "alumnos"     => $alumnos
    );

} catch (Exception $e) {
    $respuesta = array(
        "success" => false,
        "message" => "Error de servidor: " . $e->getMessage()
    );
}

ob_clean();
echo json_encode($respuesta);
exit;
?>