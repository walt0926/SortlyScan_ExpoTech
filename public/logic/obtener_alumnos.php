<?php
// public/logic/obtener_alumnos.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $clase_id = isset($_POST['clase_id']) ? $_POST['clase_id'] : '';

    if (empty($clase_id)) {
        throw new Exception("ID de clase no proporcionado.");
    }

    // Consulta basada en tu SQL: Tabla 'Alumnos' -> id_salon, nombre_display
    $query = "SELECT id_alumno, nombre_display 
              FROM Alumnos 
              WHERE id_salon = :clase_id 
              ORDER BY nombre_display ASC";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([':clase_id' => $clase_id]);
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($alumnos) {
        $respuesta = [
            "success" => true,
            "alumnos" => $alumnos
        ];
    } else {
        $respuesta = [
            "success" => false,
            "message" => "No hay alumnos registrados en esta clase."
        ];
    }

} catch (Exception $e) {
    $respuesta = [
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ];
}

ob_clean();
echo json_encode($respuesta);
exit;