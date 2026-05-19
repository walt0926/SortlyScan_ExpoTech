<?php
// public/logic/registro_proceso.php

// 1. Blindaje contra salidas inesperadas de texto
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();
session_start(); // Necesario para guardar el código temporalmente

try {
    // 2. Conexión a la base de datos
    $config_path = __DIR__ . '/../../config/conexion.php';
    if (!file_exists($config_path)) {
        throw new Exception("Error interno de configuración del servidor.");
    }
    require_once $config_path;

    // 3. Recepción de la acción
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';

    // -------------------------------------------------------------------------
    // ACCIÓN 1: VALIDAR DATOS Y ENVIAR CÓDIGO
    // -------------------------------------------------------------------------
    if ($action === 'enviar_codigo') {
        $nombre_escuela = isset($_POST['nombre_escuela']) ? trim($_POST['nombre_escuela']) : '';
        $cct            = isset($_POST['cct'])            ? trim($_POST['cct'])            : '';
        $nombre_completo= isset($_POST['nombre_completo']) ? trim($_POST['nombre_completo']) : '';
        $email_director = isset($_POST['email_director']) ? trim($_POST['email_director']) : '';
        $password_dir   = isset($_POST['password_director']) ? trim($_POST['password_director']) : '';

        if (empty($nombre_escuela) || empty($cct) || empty($nombre_completo) || empty($email_director) || empty($password_dir)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Validar si el CCT ya existe
        $stmt_cct = $pdo->prepare("SELECT id_mined FROM Instituciones WHERE id_mined = :cct LIMIT 1");
        $stmt_cct->execute(array(':cct' => $cct));
        if ($stmt_cct->fetch()) {
            throw new Exception("Esta escuela (CCT) ya se encuentra registrada.");
        }

        // Validar si el correo del director ya existe
        $stmt_email = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE email = :email LIMIT 1");
        $stmt_email->execute(array(':email' => $email_director));
        if ($stmt_email->fetch()) {
            throw new Exception("Este correo electrónico ya está registrado por otro usuario.");
        }

        // Generar código aleatorio de 6 dígitos
        $codigo = (string)rand(100000, 999999);

        // Guardamos el código en la sesión para el siguiente paso
        $_SESSION['registro_codigo'] = $codigo;
        $_SESSION['registro_email']  = $email_director;

        // --- SIMULACIÓN DE ENVÍO DE CORREO (Para tus pruebas en Localhost) ---
        // Guarda el código en un archivo de texto local para que puedas verlo sin configurar SMTP
        file_put_contents(__DIR__ . '/codigo_debug.txt', "Código de verificación para " . $email_director . ": " . $codigo);
        
        // Aquí iría tu lógica real de PHPMailer o mail() en producción:
        // mail($email_director, "SortlyScan Code", "Your verification code is: " . $codigo);

        $respuesta = array(
            "success" => true,
            "message" => "Código generado con éxito."
        );
    } 
    // -------------------------------------------------------------------------
    // ACCIÓN 2: VERIFICAR CÓDIGO Y COMPLETAR REGISTRO DEFINITIVO
    // -------------------------------------------------------------------------
    elseif ($action === 'registrar_institucion') {
        $nombre_escuela = isset($_POST['nombre_escuela']) ? trim($_POST['nombre_escuela']) : '';
        $cct            = isset($_POST['cct'])            ? trim($_POST['cct'])            : '';
        $nombre_completo= isset($_POST['nombre_completo']) ? trim($_POST['nombre_completo']) : '';
        $email_director = isset($_POST['email_director']) ? trim($_POST['email_director']) : '';
        $password_dir   = isset($_POST['password_director']) ? trim($_POST['password_director']) : '';
        $codigo_input   = isset($_POST['codigo_verificacion']) ? trim($_POST['codigo_verificacion']) : '';

        // Validar el código contra la sesión
        $codigo_guardado = isset($_SESSION['registro_codigo']) ? $_SESSION['registro_codigo'] : '';
        $email_guardado  = isset($_SESSION['registro_email'])  ? $_SESSION['registro_email']  : '';

        if (empty($codigo_guardado) || $email_guardado !== $email_director) {
            throw new Exception("La sesión de verificación ha expirado. Solicita un nuevo código.");
        }

        if ($codigo_input !== $codigo_guardado) {
            throw new Exception("El código de verificación es incorrecto.");
        }

        // Iniciamos una transacción SQL por seguridad (si falla el usuario, no se crea la escuela)
        $pdo->beginTransaction();

        // 1. Insertar la Institución
        $stmt_ins = $pdo->prepare("INSERT INTO Instituciones (id_mined, nombre_centro) VALUES (:cct, :nombre)");
        $stmt_ins->execute(array(
            ':cct' => $cct,
            ':nombre' => $nombre_escuela
        ));

        // Encriptar contraseña de forma segura
        $password_hash = password_hash($password_dir, PASSWORD_DEFAULT);

        // 2. Insertar al Director (dejando 'username' como NULL ya que entra por correo)
        $stmt_usr = $pdo->prepare("
            INSERT INTO Usuarios (id_mined, email, username, password, rol, nombre_completo) 
            VALUES (:cct, :email, NULL, :password, 'Director', :nombre_completo)
        ");
        $stmt_usr->execute(array(
            ':cct'            => $cct,
            ':email'          => $email_director,
            ':password'       => $password_hash,
            ':nombre_completo'=> $nombre_completo
        ));

        // Confirmamos los cambios en la base de datos
        $pdo->commit();

        // Limpiamos las variables temporales de la sesión
        unset($_SESSION['registro_codigo']);
        unset($_SESSION['registro_email']);
        
        // Eliminamos el archivo temporal de debug
        if (file_exists(__DIR__ . '/codigo_debug.txt')) {
            unlink(__DIR__ . '/codigo_debug.txt');
        }

        $respuesta = array(
            "success" => true,
            "message" => "Registro completado con éxito."
        );
    } else {
        throw new Exception("Acción no permitida.");
    }

} catch (Exception $e) {
    // Si algo falla y la transacción estaba activa, revertimos los cambios parciales
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    $respuesta = array(
        "success" => false,
        "message" => $e->getMessage()
    );
}

// Despejamos buffer y enviamos la respuesta JSON limpia
ob_clean();
echo json_encode($respuesta);
exit;
?>