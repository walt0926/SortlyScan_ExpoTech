<?php
// public/logic/validar_clase.php

// 1. Bloqueamos cualquier salida de texto no deseada
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

// Iniciamos buffer para atrapar basura
ob_start();

try {
    // 2. Conexión a la base de datos
    $config_path = __DIR__ . '/../../config/conexion.php';
    
    if (!file_exists($config_path)) {
        throw new Exception("Archivo de conexión no encontrado.");
    }

    require_once $config_path;

    if (!isset($pdo)) {
        throw new Exception("Error en la configuración de la base de datos.");
    }

    // 3. Recibir y limpiar datos
    $codigo_clase = isset($_POST['codigo_clase']) ? trim($_POST['codigo_clase']) : '';
    $cct = isset($_POST['cct']) ? trim($_POST['cct']) : '';

    if (empty($codigo_clase) || empty($cct)) {
        throw new Exception("Faltan datos obligatorios.");
    }

    // 4. Consulta SQL (Basada en tu tabla 'Salones')
    // Buscamos el salón que coincida con el código Y con la escuela (id_mined)
    $query = "SELECT id_salon, nombre_salon 
              FROM Salones 
              WHERE codigo_aula = :codigo 
              AND id_mined = :cct 
              LIMIT 1";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':codigo' => $codigo_clase,
        ':cct' => $cct
    ]);

    $salon = $stmt->fetch();

    if ($salon) {
        $respuesta = [
            "success" => true,
            "clase_id" => $salon['id_salon'],
            "nombre_clase" => $salon['nombre_salon']
        ];
    } else {
        $respuesta = [
            "success" => false,
            "message" => "El código de aula no existe para esta institución."
        ];
    }

} catch (Exception $e) {
    $respuesta = [
        "success" => false,
        "message" => "Error interno: " . $e->getMessage()
    ];
}

// Limpiamos cualquier "eco" previo y enviamos solo el JSON
ob_clean();
echo json_encode($respuesta);
exit;