<?php
// public/logic/editar_alumno.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    $config_path = __DIR__ . '/../../config/conexion.php';
    if (!file_exists($config_path)) {
        throw new Exception("Error interno de configuración del servidor.");
    }
    require_once $config_path;

    // Recepción de parámetros
    $id_alumno     = isset($_POST['id_alumno'])     ? trim($_POST['id_alumno'])     : '';
    $nombre_alumno = isset($_POST['nombre_alumno']) ? trim($_POST['nombre_alumno']) : '';
    $pin_alumno    = isset($_POST['pin_alumno'])    ? trim($_POST['pin_alumno'])    : '';
    $puntos_alumno = isset($_POST['puntos_alumno']) ? trim($_POST['puntos_alumno']) : '';

    if (empty($id_alumno) || empty($nombre_alumno) || empty($pin_alumno) || $puntos_alumno === '') {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar el formato del PIN
    if (!preg_match('/^\d{4}$/', $pin_alumno)) {
        throw new Exception("El PIN debe constar exactamente de 4 dígitos numéricos.");
    }

    // Actualización de los datos del estudiante
    $stmt_update = $pdo->prepare("
        UPDATE Alumnos 
        SET nombre_display = :nombre, pin = :pin, puntos_totales = :puntos 
        WHERE id_alumno = :id
    ");
    
    $stmt_update->execute(array(
        ':nombre' => $nombre_alumno,
        ':pin'    => $pin_alumno,
        ':puntos' => (int)$puntos_alumno,
        ':id'     => $id_alumno
    ));

    $respuesta = array(
        "success" => true,
        "message" => "Datos del alumno actualizados con éxito."
    );

} catch (Exception $e) {
    $respuesta = array(
        "success" => false,
        "message" => $e->getMessage()
    );
}

ob_clean();
echo json_encode($respuesta);
exit;
?>