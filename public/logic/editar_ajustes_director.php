<?php
// public/logic/editar_ajustes_director.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_director     = isset($_POST['id_director'])     ? trim($_POST['id_director'])     : '';
    $nombre_escuela  = isset($_POST['nombre_escuela'])  ? trim($_POST['nombre_escuela'])  : '';
    $nombre_director = isset($_POST['nombre_director']) ? trim($_POST['nombre_director']) : '';
    $pass_director   = isset($_POST['pass_director'])   ? trim($_POST['pass_director'])   : '';

    if (empty($id_director) || empty($nombre_escuela) || empty($nombre_director)) {
        throw new Exception("Todos los campos obligatorios deben ser completados.");
    }

    // 1. Validar existencia del director y recuperar su CCT actual
    $stmt_dir = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_dir->execute(array(':id' => $id_director));
    $director = $stmt_dir->fetch(PDO::FETCH_ASSOC);

    if (!$director) {
        throw new Exception("Director no válido o sesión expirada.");
    }
    $cct = $director['id_mined'];

    // 2. Iniciar Transacción SQL de Seguridad
    $pdo->beginTransaction();

    // A) Actualizar el nombre de la institución en la tabla Instituciones
    $stmt_ins = $pdo->prepare("UPDATE Instituciones SET nombre_centro = :nombre WHERE id_mined = :cct");
    $stmt_ins->execute(array(':nombre' => $nombre_escuela, ':cct' => $cct));

    // B) Actualizar los datos del Director en la tabla Usuarios
    if (!empty($pass_director)) {
        // Si escribió una contraseña, la ciframos antes de guardar
        $password_hash = password_hash($pass_director, PASSWORD_DEFAULT);
        $stmt_usr = $pdo->prepare("
            UPDATE Usuarios 
            SET nombre_completo = :nombre, password = :pass 
            WHERE id_usuario = :id
        ");
        $stmt_usr->execute(array(
            ':nombre' => $nombre_director,
            ':pass' => $password_hash,
            ':id' => $id_director
        ));
    } else {
        // Si se dejó en blanco, se omiten los cambios de contraseña
        $stmt_usr = $pdo->prepare("
            UPDATE Usuarios 
            SET nombre_completo = :nombre 
            WHERE id_usuario = :id
        ");
        $stmt_usr->execute(array(
            ':nombre' => $nombre_director,
            ':id' => $id_director
        ));
    }

    $pdo->commit();
    $respuesta = array("success" => true);

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $respuesta = array("success" => false, "message" => $e->getMessage());
}

ob_clean();
echo json_encode($respuesta);
exit;
?>