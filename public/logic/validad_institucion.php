<?php
// public/logic/validar_institucion.php
header('Content-Type: application/json; charset=utf-8');

try {
    // Subimos dos niveles: de logic/ a public/ y de public/ a la raíz
    require_once __DIR__ . '/../../config/conexion.php'; 
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error de conexión"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cct = $_POST['cct'] ?? '';

    if (empty($cct)) {
        echo json_encode(["success" => false, "message" => "CCT vacío"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT nombre_centro FROM Instituciones WHERE id_mined = ?");
        $stmt->execute([$cct]);
        $escuela = $stmt->fetch();

        if ($escuela) {
            echo json_encode([
                "success" => true,
                "nombre" => $escuela['nombre_centro']
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Institución no encontrada"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error en la consulta"]);
    }
}