<?php
// public/logic/get_dashboard_director.php
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../../config/conexion.php';
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error de conexión al servidor."]);
    exit;
}

$id_director = $_POST['id_director'] ?? '';

if (empty($id_director)) {
    echo json_encode(["success" => false, "message" => "ID de director no proporcionado."]);
    exit;
}

try {
    // 1. Obtener el CCT (id_mined) del director
    $stmt_dir = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_dir->execute(['id' => $id_director]);
    $director = $stmt_dir->fetch(PDO::FETCH_ASSOC);

    if (!$director) {
        echo json_encode(["success" => false, "message" => "Director no encontrado."]);
        exit;
    }

    $cct = $director['id_mined'];

    // 2. A) Obtener nombre de la Institución
    $stmt_escuela = $pdo->prepare("SELECT nombre_centro FROM Instituciones WHERE id_mined = :cct LIMIT 1");
    $stmt_escuela->execute(['cct' => $cct]);
    $escuela = $stmt_escuela->fetch(PDO::FETCH_ASSOC);
    $nombre_escuela = $escuela ? $escuela['nombre_centro'] : 'Mi Institución';

    // 2. B) Obtener el total de Salones
    $stmt_salones_total = $pdo->prepare("SELECT COUNT(*) as total FROM Salones WHERE id_mined = :cct");
    $stmt_salones_total->execute(['cct' => $cct]);
    $total_salones = $stmt_salones_total->fetch(PDO::FETCH_ASSOC)['total'];

    // 2. C) Obtener el total de Alumnos (haciendo un JOIN con los salones de esa escuela)
    $stmt_alumnos = $pdo->prepare("
        SELECT COUNT(*) as total 
        FROM Alumnos a 
        INNER JOIN Salones s ON a.id_salon = s.id_salon 
        WHERE s.id_mined = :cct
    ");
    $stmt_alumnos->execute(['cct' => $cct]);
    $total_alumnos = $stmt_alumnos->fetch(PDO::FETCH_ASSOC)['total'];

    // 2. D) Obtener los Salones para el Ranking y Select (sumando los puntos de sus alumnos)
    $stmt_ranking = $pdo->prepare("
        SELECT s.id_salon, s.nombre_salon, COALESCE(SUM(a.puntos_totales), 0) as puntos 
        FROM Salones s
        LEFT JOIN Alumnos a ON s.id_salon = a.id_salon
        WHERE s.id_mined = :cct
        GROUP BY s.id_salon
        ORDER BY puntos DESC
    ");
    $stmt_ranking->execute(['cct' => $cct]);
    $salones = $stmt_ranking->fetchAll(PDO::FETCH_ASSOC);

    // 2. E) Calcular puntos totales sumando el ranking
    $total_puntos = 0;
    foreach ($salones as $s) {
        $total_puntos += (int)$s['puntos'];
    }

    // 3. Enviar la respuesta
    echo json_encode([
        "success" => true,
        "escuela_nombre" => $nombre_escuela,
        "stats" => [
            "total_clases" => $total_salones,
            "total_alumnos" => $total_alumnos,
            "total_puntos" => $total_puntos
        ],
        "salones" => $salones
    ]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error de base de datos: " . $e->getMessage()]);
}
?>