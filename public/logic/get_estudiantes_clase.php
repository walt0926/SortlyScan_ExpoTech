<?php
// public/logic/get_estudiantes_clase.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_salon = isset($_POST['id_salon']) ? trim($_POST['id_salon']) : '';

    if (empty($id_salon)) {
        throw new Exception("ID de salón faltante.");
    }

    $stmt = $pdo->prepare("SELECT nombre_display, puntos_totales FROM Alumnos WHERE id_salon = :id ORDER BY puntos_totales DESC");
    $stmt->execute(array(':id' => (int)$id_salon));
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $respuesta = array("success" => true, "alumnos" => $alumnos);

} catch (Exception $e) {
    $respuesta = array("success" => false, "message" => $e->getMessage());
}

ob_clean();
echo json_encode($respuesta);
exit;
?>