// Esto servirá para desglosar las métricas por salones

<?php
// admin/stats_globales.php
session_start();
header("Content-Type: application/json");
require_once("../config/conexion.php");

// Seguridad: Solo Director
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Director') {
    echo json_encode(["success" => false, "message" => "No autorizado"]);
    exit;
}

$id_mined = $_SESSION['id_mined'];

try {
    // Consulta: Suma puntos de alumnos agrupados por salón
    $query = "SELECT 
                s.nombre_salon, 
                s.codigo_aula,
                IFNULL(SUM(a.puntos_totales), 0) as total_puntos,
                COUNT(a.id_alumno) as cantidad_alumnos
              FROM Salones s
              LEFT JOIN Alumnos a ON s.id_salon = a.id_salon
              WHERE s.id_mined = :mined
              GROUP BY s.id_salon
              ORDER BY total_puntos DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute([':mined' => $id_mined]);
    $stats = $stmt->fetchAll();

    echo json_encode([
        "success" => true,
        "institucion" => $id_mined,
        "data" => $stats
    ]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al obtener estadísticas"]);
}