<?php
// public/logic/eliminar_clase.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_salon = isset($_POST['id_salon']) ? trim($_POST['id_salon']) : '';

    if (empty($id_salon)) {
        throw new Exception("ID del aula no proporcionado.");
    }

    $stmt_delete = $pdo->prepare("DELETE FROM Salones WHERE id_salon = :id");
    $stmt_delete->execute(array(':id' => (int)$id_salon));

    $respuesta = array("success" => true);

} catch (Exception $e) {
    $respuesta = array("success" => false, "message" => $e->getMessage());
}

ob_clean();
echo json_encode($respuesta);
exit;
?>