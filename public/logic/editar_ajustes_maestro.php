<?php
// public/logic/editar_ajustes_maestro.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_maestro     = isset($_POST['id_maestro'])     ? trim($_POST['id_maestro'])     : '';
    $nombre_maestro = isset($_POST['nombre_maestro']) ? trim($_POST['nombre_maestro']) : '';
    $user_maestro   = isset($_POST['user_maestro'])   ? trim($_POST['user_maestro'])   : '';
    $pass_maestro   = isset($_POST['pass_maestro'])   ? trim($_POST['pass_maestro'])   : '';

    if (empty($id_maestro) || empty($nombre_maestro) || empty($user_maestro)) {
        throw new Exception("All mandatory fields must be completed.");
    }

    // 1. Validar la existencia del usuario y recuperar su CCT (id_mined)
    $stmt_maestro = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_maestro->execute(array(':id' => $id_maestro));
    $user_data = $stmt_maestro->fetch(PDO::FETCH_ASSOC);

    if (!$user_data) {
        throw new Exception("Teacher account not found or invalid session.");
    }
    $cct = $user_data['id_mined'];

    // 2. Verificar duplicados del nombre de usuario dentro de la misma institución (Excluyéndose a sí mismo)
    $stmt_check = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE id_mined = :cct AND username = :username AND id_usuario != :id LIMIT 1");
    $stmt_check->execute(array(':cct' => $cct, ':username' => $user_maestro, ':id' => $id_maestro));
    
    if ($stmt_check->fetch()) {
        throw new Exception("The username '$user_maestro' is already taken by another teacher in your school.");
    }

    // 3. Ejecutar actualización
    if (!empty($pass_maestro)) {
        // Si el docente rellenó el campo de clave, la encriptamos de forma segura
        $password_hash = password_hash($pass_maestro, PASSWORD_DEFAULT);
        $stmt_update = $pdo->prepare("
            UPDATE Usuarios 
            SET nombre_completo = :nombre, username = :username, password = :pass 
            WHERE id_usuario = :id
        ");
        $stmt_update->execute(array(
            ':nombre'   => $nombre_maestro,
            ':username' => $user_maestro,
            ':pass'     => $password_hash,
            ':id'       => $id_maestro
        ));
    } else {
        // Si se dejó en blanco, se actualizan solo los campos de texto
        $stmt_update = $pdo->prepare("
            UPDATE Usuarios 
            SET nombre_completo = :nombre, username = :username 
            WHERE id_usuario = :id
        ");
        $stmt_update->execute(array(
            ':nombre'   => $nombre_maestro,
            ':username' => $user_maestro,
            ':id'       => $id_maestro
        ));
    }

    $respuesta = array("success" => true);

} catch (Exception $e) {
    $respuesta = array("success" => false, "message" => $e->getMessage());
}

ob_clean();
echo json_encode($respuesta);
exit;
?>