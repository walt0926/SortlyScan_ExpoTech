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

    // NUEVO: Importamos el enviador centralizado de PHPMailer
    $mailer_path = __DIR__ . '/../../config/mailer.php';
    if (!file_exists($mailer_path)) {
        throw new Exception("El módulo de correo no está disponible.");
    }
    require_once $mailer_path;

    // 3. Recepción de la acción
    $action = isset($_POST['action']) ? trim($_POST['action']) : '';

    // -------------------------------------------------------------------------
    // ACCIÓN 1: VALIDAR DATOS Y ENVIAR CÓDIGO
    // -------------------------------------------------------------------------
    if ($action === 'enviar_codigo') {
        $nombre_escuela  = isset($_POST['nombre_escuela']) ? trim($_POST['nombre_escuela']) : '';
        $cct             = isset($_POST['cct'])            ? trim($_POST['cct'])            : '';
        $nombre_completo = isset($_POST['nombre_completo']) ? trim($_POST['nombre_completo']) : '';
        $email_director  = isset($_POST['email_director']) ? trim($_POST['email_director']) : '';
        $password_dir    = isset($_POST['password_director']) ? trim($_POST['password_director']) : '';

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

        // --- ENVIAR CORREO REAL CON PHPMAILER ---
        $asunto = "SortlyScan - Verification Code";
        
        // Creamos una plantilla HTML limpia y moderna con la identidad verde de SortlyScan
        $cuerpoHTML = "
            <html>
            <body style='font-family: Arial, sans-serif; background-color: #f4f4f5; padding: 20px; color: #333;'>
                <div style='max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 15px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);'>
                    <h2 style='color: #4CAF50; margin-top: 0;'>Welcome to SortlyScan!</h2>
                    <p>Hello, <strong>" . htmlspecialchars($nombre_completo) . "</strong>.</p>
                    <p>You are receiving this email because you started the registration process for <strong>" . htmlspecialchars($nombre_escuela) . "</strong>.</p>
                    
                    <div style='background: #f0fdf4; border: 1px solid #bbf7d0; padding: 15px; border-radius: 10px; text-align: center; margin: 25px 0;'>
                        <span style='font-size: 0.85rem; color: #166534; font-weight: bold; display: block; margin-bottom: 5px; letter-spacing: 1px;'>YOUR VERIFICATION CODE</span>
                        <strong style='font-size: 2.2rem; letter-spacing: 0.5rem; color: #15803d; font-family: monospace;'>" . $codigo . "</strong>
                    </div>
                    
                    <p style='font-size: 0.85rem; color: #64748b; line-height: 1.4;'>This code is confidential and required to verify your institutional account. If you did not request this registration, please ignore this message.</p>
                    <hr style='border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;'>
                    <p style='font-size: 0.8rem; color: #94a3b8; text-align: center; margin: 0;'>SortlyScan Ecosystem &copy; 2026</p>
                </div>
            </body>
            </html>
        ";

        // Despachamos el correo usando la función global centralizada
        enviarCorreo($email_director, $asunto, $cuerpoHTML);

        $respuesta = array(
            "success" => true,
            "message" => "Código generado y enviado con éxito."
        );
    } 
    // -------------------------------------------------------------------------
    // ACCIÓN 2: VERIFICAR CÓDIGO Y COMPLETAR REGISTRO DEFINITIVO
    // -------------------------------------------------------------------------
    elseif ($action === 'registrar_institucion') {
        $nombre_escuela  = isset($_POST['nombre_escuela']) ? trim($_POST['nombre_escuela']) : '';
        $cct             = isset($_POST['cct'])            ? trim($_POST['cct'])            : '';
        $nombre_completo = isset($_POST['nombre_completo']) ? trim($_POST['nombre_completo']) : '';
        $email_director  = isset($_POST['email_director']) ? trim($_POST['email_director']) : '';
        $password_dir    = isset($_POST['password_director']) ? trim($_POST['password_director']) : '';
        $codigo_input    = isset($_POST['codigo_verificacion']) ? trim($_POST['codigo_verificacion']) : '';

        // Validar el código contra la sesión
        $codigo_guardado = isset($_SESSION['registro_codigo']) ? $_SESSION['registro_codigo'] : '';
        $email_guardado  = isset($_SESSION['registro_email'])  ? $_SESSION['registro_email']  : '';

        if (empty($codigo_guardado) || $email_guardado !== $email_director) {
            throw new Exception("La sesión de verificación ha expirado. Solicita un nuevo código.");
        }

        if ($codigo_input !== $codigo_guardado) {
            throw new Exception("El código de verificación es incorrecto.");
        }

        // Iniciamos una transacción SQL por seguridad
        $pdo->beginTransaction();

        // 1. Insertar la Institución
        $stmt_ins = $pdo->prepare("INSERT INTO Instituciones (id_mined, nombre_centro) VALUES (:cct, :nombre)");
        $stmt_ins->execute(array(
            ':cct' => $cct,
            ':nombre' => $nombre_escuela
        ));

        // Encriptar contraseña de forma segura
        $password_hash = password_hash($password_dir, PASSWORD_DEFAULT);

        // 2. Insertar al Director
        $stmt_usr = $pdo->prepare("
            INSERT INTO Usuarios (id_mined, email, username, password, rol, nombre_completo) 
            VALUES (:cct, :email, NULL, :password, 'Director', :nombre_completo)
        ");
        $stmt_usr->execute(array(
            ':cct'             => $cct,
            ':email'          => $email_director,
            ':password'       => $password_hash,
            ':nombre_completo'=> $nombre_completo
        ));

        // Confirmamos los cambios en la base de datos
        $pdo->commit();

        // Limpiamos las variables temporales de la sesión
        unset($_SESSION['registro_codigo']);
        unset($_SESSION['registro_email']);

        $respuesta = array(
            "success" => true,
            "message" => "Registro completado con éxito."
        );
    } else {
        throw new Exception("Acción no permitida.");
    }

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    $respuesta = array(
        "success" => false,
        "message" => $e->getMessage()
    );
}

ob_clean();
echo json_encode($respuesta);
exit;
?>