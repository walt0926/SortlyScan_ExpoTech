<?php
// public/logic/validad_institucion.php

// 1. Configuramos para que NADA se imprima excepto nuestro JSON
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

// Iniciamos un buffer para atrapar cualquier basura (warnings, notices)
ob_start();

try {
    // 2. Intentamos conectar a la base de datos
    // Ajusta esta ruta si tu conexión está en otro lugar
    $config_path = __DIR__ . '/../../config/conexion.php';
    
    if (!file_exists($config_path)) {
        throw new Exception("El archivo de conexión no existe en: " . $config_path);
    }

    require_once $config_path;

    // Verificar si $pdo existe (creado en conexion.php)
    if (!isset($pdo)) {
        throw new Exception("La variable de conexión \$pdo no está definida.");
    }

    // 3. Procesar la petición
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método de solicitud no válido.");
    }

    $cct = isset($_POST['cct']) ? trim($_POST['cct']) : '';

    if (empty($cct)) {
        throw new Exception("El CCT es obligatorio.");
    }

    // 4. Consulta (Basada en tu estructura SQL: Instituciones -> id_mined, nombre_centro)
    $stmt = $pdo->prepare("SELECT nombre_centro FROM Instituciones WHERE id_mined = :cct LIMIT 1");
    $stmt->execute([':cct' => $cct]);
    $resultado = $stmt->fetch();

    if ($resultado) {
        $respuesta = [
            "success" => true,
            "nombre_institucion" => $resultado['nombre_centro']
        ];
    } else {
        $respuesta = [
            "success" => false,
            "message" => "CCT no registrado en la base de datos."
        ];
    }

} catch (Exception $e) {
    // Si algo falla, enviamos el error en formato JSON
    $respuesta = [
        "success" => false,
        "message" => "Error interno: " . $e->getMessage()
    ];
}

// Limpiamos cualquier salida previa y enviamos el JSON
ob_clean();
echo json_encode($respuesta);
exit;