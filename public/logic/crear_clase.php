<?php
// public/logic/crear_clase.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_director = isset($_POST['id_director']) ? trim($_POST['id_director']) : '';
    $nombre_clase = isset($_POST['nombre_clase']) ? trim($_POST['nombre_clase']) : '';

    if (empty($id_director) || empty($nombre_clase)) {
        throw new Exception("Datos incompletos.");
    }

    // Obtener el CCT de la escuela
    $stmt_dir = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_dir->execute(array(':id' => $id_director));
    $director = $stmt_dir->fetch(PDO::FETCH_ASSOC);

    if (!$director) throw new Exception("Director no válido.");
    $cct = $director['id_mined'];

    // Evitar salones duplicados en la misma escuela
    $stmt_check = $pdo->prepare("SELECT id_salon FROM Salones WHERE id_mined = :cct AND nombre_salon = :nombre LIMIT 1");
    $stmt_check->execute(array(':cct' => $cct, ':nombre' => $nombre_clase));
    if ($stmt_check->fetch()) {
        throw new Exception("Ya existe un salón con ese nombre en esta institución.");
    }

    // Generar código de aula único global de 6 caracteres (Letras mayúsculas y números)
    $codigo_aula = '';
    $es_unico = false;
    while (!$es_unico) {
        $codigo_aula = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $stmt_codigo = $pdo->prepare("SELECT id_salon FROM Salones WHERE codigo_aula = :codigo LIMIT 1");
        $stmt_codigo->execute(array(':codigo' => $codigo_aula));
        if (!$stmt_codigo->fetch()) $es_unico = true;
    }

    // Insertar el salón
    $stmt_insert = $pdo->prepare("
        INSERT INTO Salones (id_mined, id_maestro, nombre_salon, codigo_aula) 
        VALUES (:cct, NULL, :nombre, :codigo)
    ");
    $stmt_insert->execute(array(
        ':cct' => $cct,
        ':nombre' => $nombre_clase,
        ':codigo' => $codigo_aula
    ));

    $respuesta = array("success" => true, "codigo_aula" => $codigo_aula);

} catch (Exception $e) {
    $respuesta = array("success" => false, "message" => $e->getMessage());
}

ob_clean();
echo json_encode($respuesta);
exit;
?>