<?php
// public/logic/editar_clase.php

error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');
ob_start();

try {
    require_once __DIR__ . '/../../config/conexion.php';

    $id_director    = isset($_POST['id_director'])    ? trim($_POST['id_director'])    : '';
    $id_salon       = isset($_POST['id_salon'])       ? trim($_POST['id_salon'])       : '';
    $nombre_salon   = isset($_POST['nombre_salon'])   ? trim($_POST['nombre_salon'])   : '';
    $nombre_docente = isset($_POST['nombre_docente']) ? trim($_POST['nombre_docente']) : '';
    $user_docente   = isset($_POST['user_docente'])   ? trim($_POST['user_docente'])   : '';
    $pass_docente   = isset($_POST['pass_docente'])   ? trim($_POST['pass_docente'])   : '';

    if (empty($id_director) || empty($id_salon) || empty($nombre_salon) || empty($nombre_docente) || empty($user_docente)) {
        throw new Exception("Todos los campos obligatorios deben estar completos.");
    }

    // 1. Obtener CCT de la institución
    $stmt_dir = $pdo->prepare("SELECT id_mined FROM Usuarios WHERE id_usuario = :id LIMIT 1");
    $stmt_dir->execute(array(':id' => $id_director));
    $director = $stmt_dir->fetch(PDO::FETCH_ASSOC);
    if (!$director) throw new Exception("Director no válido.");
    $cct = $director['id_mined'];

    // 2. Traer información actual del salón para validar propiedad
    $stmt_salon_actual = $pdo->prepare("SELECT id_maestro FROM Salones WHERE id_salon = :id_salon AND id_mined = :cct LIMIT 1");
    $stmt_salon_actual->execute(array(':id_salon' => $id_salon, ':cct' => $cct));
    $salon_info = $stmt_salon_actual->fetch(PDO::FETCH_ASSOC);
    if (!$salon_info) throw new Exception("El salón no pertenece a tu institución.");

    $id_maestro_actual = $salon_info['id_maestro'];

    // 3. Verificar duplicados del Username dentro de la misma escuela (Excluyendo al maestro actual)
    if ($id_maestro_actual) {
        $stmt_check = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE id_mined = :cct AND username = :username AND id_usuario != :id_maestro LIMIT 1");
        $stmt_check->execute(array(':cct' => $cct, ':username' => $user_docente, ':id_maestro' => $id_maestro_actual));
    } else {
        $stmt_check = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE id_mined = :cct AND username = :username LIMIT 1");
        $stmt_check->execute(array(':cct' => $cct, ':username' => $user_docente));
    }
    
    if ($stmt_check->fetch()) {
        throw new Exception("El usuario '$user_docente' ya lo tiene asignado otro docente en tu escuela.");
    }

    // 4. Iniciar Transacción Segura
    $pdo->beginTransaction();

    if (empty($id_maestro_actual)) {
        // ESCENARIO A: El salón no tenía maestro registrado. Creamos una cuenta nueva desde cero.
        if (empty($pass_docente)) {
            throw new Exception("Debes asignarle una contraseña inicial al nuevo maestro.");
        }
        $password_hash = password_hash($pass_docente, PASSWORD_DEFAULT);

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

        // Vinculamos el salón con su nuevo maestro y nombre actualizado
        $stmt_up_salon = $pdo->prepare("UPDATE Salones SET nombre_salon = :nombre, id_maestro = :id_maestro WHERE id_salon = :id_salon");
        $stmt_up_salon->execute(array(
            ':nombre' => $nombre_salon,
            ':id_maestro' => $id_nuevo_maestro,
            ':id_salon' => $id_salon
        ));

    } else {
        // ESCENARIO B: El salón ya posee un maestro. Modificamos su cuenta actual.
        if (!empty($pass_docente)) {
            // Si el director escribió algo en el campo, actualizamos datos completos + contraseña
            $password_hash = password_hash($pass_docente, PASSWORD_DEFAULT);
            $stmt_up_user = $pdo->prepare("
                UPDATE Usuarios 
                SET nombre_completo = :nombre, username = :username, password = :pass 
                WHERE id_usuario = :id_maestro
            ");
            $stmt_up_user->execute(array(
                ':nombre' => $nombre_docente,
                ':username' => $user_docente,
                ':pass' => $password_hash,
                ':id_maestro' => $id_maestro_actual
            ));
        } else {
            // Si se dejó en blanco, modificamos únicamente nombre y usuario sin tocar la contraseña actual
            $stmt_up_user = $pdo->prepare("
                UPDATE Usuarios 
                SET nombre_completo = :nombre, username = :username 
                WHERE id_usuario = :id_maestro
            ");
            $stmt_up_user->execute(array(
                ':nombre' => $nombre_docente,
                ':username' => $user_docente,
                ':id_maestro' => $id_maestro_actual
            ));
        }

        // Actualizamos el nombre del salón por si acaso cambió
        $stmt_up_salon = $pdo->prepare("UPDATE Salones SET nombre_salon = :nombre WHERE id_salon = :id_salon");
        $stmt_up_salon->execute(array(':nombre' => $nombre_salon, ':id_salon' => $id_salon));
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