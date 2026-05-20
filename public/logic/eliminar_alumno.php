<?php
// public/logic/eliminar_alumno.php

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
    $id_alumno = isset($_POST['id_alumno']) ? trim($_POST['id_alumno']) : '';

    if (empty($id_alumno)) {
        throw new Exception("ID de estudiante no proporcionado.");
    }

    // Ejecutamos el borrado físico del registro
    $stmt_delete = $pdo->prepare("DELETE FROM Alumnos WHERE id_alumno = :id");
    $stmt_delete->execute(array(':id' => (int)$id_alumno));

    $respuesta = array(
        "success" => true,
        "message" => "Registro eliminado exitosamente."
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