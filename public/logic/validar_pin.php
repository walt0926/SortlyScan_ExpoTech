<?php
// public/logic/validar_pin.php

// 1. Evitamos que se imprima cualquier advertencia de PHP que rompa el JSON
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

// Iniciamos el buffer
ob_start();

try {
    // 2. Conexión a la base de datos
    $config_path = __DIR__ . '/../../config/conexion.php';
    
    if (!file_exists($config_path)) {
        throw new Exception("No se encuentra el archivo de conexión.");
    }

    require_once $config_path;

    // 3. Recibimos los datos del JavaScript
    $alumno_id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $pin_input = isset($_POST['pin']) ? trim($_POST['pin']) : '';

    if (empty($alumno_id) || empty($pin_input)) {
        throw new Exception("Faltan datos de validación.");
    }

    // 4. Consulta a la tabla Alumnos (según tu database/estructura.sql)
    $query = "SELECT pin FROM Alumnos WHERE id_alumno = :id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $alumno_id]);
    $alumno = $stmt->fetch();

    if ($alumno) {
        // 5. Comparamos el PIN (asegurándonos de que ambos sean cadenas de texto sin espacios extra)
        if (trim((string)$alumno['pin']) === (string)$pin_input) {
            $respuesta = [
                "success" => true,
                "message" => "Acceso concedido"
            ];
        } else {
            $respuesta = [
                "success" => false, 
                "message" => "PIN Incorrecto."
            ];
        }
    } else {
        $respuesta = [
            "success" => false, 
            "message" => "Alumno no encontrado en la base de datos."
        ];
    }

} catch (Exception $e) {
    $respuesta = [
        "success" => false,
        "message" => "Error interno: " . $e->getMessage()
    ];
}

// Limpiamos basura y enviamos el JSON
ob_clean();
echo json_encode($respuesta);
exit;
?>