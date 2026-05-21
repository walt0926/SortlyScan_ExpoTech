<?php
// public/logic/asignar_docente.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_director    = isset($_POST['id_director']) ? trim($_POST['id_director']) : '';
    $id_salon       = isset($_POST['id_salon']) ? trim($_POST['id_salon']) : '';
    $nombre_docente = isset($_POST['nombre_docente']) ? trim($_POST['nombre_docente']) : '';
    $user_docente   = isset($_POST['user_docente']) ? trim($_POST['user_docente']) : '';
    $pass_docente   = isset($_POST['pass_docente']) ? trim($_POST['pass_docente']) : '';

    if (empty($id_director) || empty($id_salon) || empty($nombre_docente) || empty($user_docente) || empty($pass_docente)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // 1. Obtener CCT de la escuela
    $stmt_dir = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_dir->execute(array(':id' => $id_director));
    $director = $stmt_dir->fetch(PDO::FETCH_ASSOC);
    if (!$director) throw new Exception("Director no válido.");
    
    $cct = $director['id_mined'];

    // 2. REGLA DE SEGURIDAD: Verificar que el usuario no exista DENTRO DE ESTA MISMA ESCUELA
    $stmt_check = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE id_mined = :cct AND username = :username LIMIT 1");
    $stmt_check->execute(array(':cct' => $cct, ':username' => $user_docente));
    if ($stmt_check->fetch()) {
        throw new Exception("Ya tienes a un docente registrado con el usuario '$user_docente'. Intenta con otro alias.");
    }

    $password_hash = password_hash($pass_docente, PASSWORD_DEFAULT);

    // 3. Iniciar Transacción
    $pdo->beginTransaction();

    // Crear el usuario con el username elegido
    $stmt_user = $pdo->prepare("
        INSERT INTO Usuarios (id_mined, username, email, password, rol, nombre_completo) 
        VALUES (:cct, :username, NULL, :pass, 'Maestro', :nombre)
    ");
    $stmt_user->execute(array(
        ':cct' => $cct,
        ':username' => $user_docente,
        ':pass' => $password_hash,
        ':nombre' => $nombre_docente
    ));

    $id_nuevo_maestro = $pdo->lastInsertId();

    // Actualizar el salón para vincularlo al maestro
    $stmt_salon = $pdo->prepare("UPDATE Salones SET id_maestro = :id_maestro WHERE id_salon = :id_salon AND id_mined = :cct");
    $stmt_salon->execute(array(
        ':id_maestro' => $id_nuevo_maestro,
        ':id_salon' => $id_salon,
        ':cct' => $cct
    ));

    $pdo->commit();

    $respuesta = array(
        "success" => true
    );

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