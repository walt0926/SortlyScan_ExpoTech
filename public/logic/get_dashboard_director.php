<?php
// public/logic/get_dashboard_director.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    $config_path = __DIR__ . '/../../config/conexion.php';
    if (!file_exists($config_path)) {
        throw new Exception("Error de conexión al servidor.");
    }
    require_once $config_path;

    $id_director = isset($_POST['id_director']) ? trim($_POST['id_director']) : '';

    if (empty($id_director)) {
        throw new Exception("ID de director no proporcionado.");
    }

    // A) Obtener el CCT
    $stmt_dir = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_dir->execute(array(':id' => $id_director));
    $director = $stmt_dir->fetch(PDO::FETCH_ASSOC);

    if (!$director) {
        throw new Exception("Director no encontrado.");
    }

    $cct = $director['id_mined'];

    // B) Obtener nombre de la Institución
    $stmt_escuela = $pdo->prepare("SELECT nombre_centro FROM Instituciones WHERE id_mined = :cct LIMIT 1");
    $stmt_escuela->execute(array(':cct' => $cct));
    $escuela = $stmt_escuela->fetch(PDO::FETCH_ASSOC);
    $nombre_escuela = $escuela ? $escuela['nombre_centro'] : 'Mi Institución';

    // C) Obtener el total de Salones
    $stmt_salones_total = $pdo->prepare("SELECT COUNT(*) as total FROM Salones WHERE id_mined = :cct");
    $stmt_salones_total->execute(array(':cct' => $cct));
    $total_salones = $stmt_salones_total->fetch(PDO::FETCH_ASSOC);
    $total_salones = $total_salones['total'];

    // D) Obtener el total de Alumnos
    $stmt_alumnos = $pdo->prepare("
        SELECT COUNT(*) as total 
        FROM Alumnos a 
        INNER JOIN Salones s ON a.id_salon = s.id_salon 
        WHERE s.id_mined = :cct
    ");
    $stmt_alumnos->execute(array(':cct' => $cct));
    $total_alumnos = $stmt_alumnos->fetch(PDO::FETCH_ASSOC);
    $total_alumnos = $total_alumnos['total'];

    // E) MODIFICADO: Traer salones junto con la información de sus maestros asignados
    $stmt_ranking = $pdo->prepare("
        SELECT s.id_salon, s.nombre_salon, s.codigo_aula, s.id_maestro,
               u.nombre_completo as nombre_maestro, u.username as user_maestro,
               COALESCE(SUM(a.puntos_totales), 0) as puntos 
        FROM Salones s
        LEFT JOIN Usuarios u ON s.id_maestro = u.id_usuario
        LEFT JOIN Alumnos a ON s.id_salon = a.id_salon
        WHERE s.id_mined = :cct
        GROUP BY s.id_salon, s.id_maestro, u.nombre_completo, u.username
        ORDER BY puntos DESC
    ");
    $stmt_ranking->execute(array(':cct' => $cct));
    $salones = $stmt_ranking->fetchAll(PDO::FETCH_ASSOC);

    // F) Calcular puntos totales
    $total_puntos = 0;
    foreach ($salones as $s) {
        $total_puntos += (int)$s['puntos'];
    }

    $respuesta = array(
        "success" => true,
        "escuela_nombre" => $nombre_escuela,
        "escuela_cct" => $cct, 
        "stats" => array(
            "total_clases" => $total_salones,
            "total_alumnos" => $total_alumnos,
            "total_puntos" => $total_puntos
        ),
        "salones" => $salones
    );

} catch (Exception $e) {
    $respuesta = array(
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    );
}

ob_clean();
echo json_encode($respuesta);
exit;
?>