<?php
// config/mailer.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargamos los archivos de PHPMailer de forma manual
require_once __DIR__ . '/../libs/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/src/SMTP.php';

/**
 * Función global para enviar correos electrónicos
 * @param string $para Correo del destinatario
 * @param string $asunto Asunto del mensaje
 * @param string $cuerpoHTML Contenido del correo en formato HTML
 * @return bool True si se envió, lanza una excepción si falla
 */
function enviarCorreo($para, $asunto, $cuerpoHTML) {
    $mail = new PHPMailer(true);

    try {
        // --- CONFIGURACIÓN DEL SERVIDOR SMTP ---
        $mail->isSMTP();                                            // Usar SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Servidor SMTP de Gmail
        $mail->SMTPAuth   = true;                                   // Activar autenticación SMTP
        $mail->Username   = 'sortlyscan75@gmail.com';               // Tu correo emisor de Gmail
        $mail->Password   = 'jsrhbxrzhatygibj';                     // La contraseña de aplicación de 16 letras
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Cifrado TLS implícito
        $mail->Port       = 587;                                    // Puerto TCP para TLS
        $mail->CharSet    = 'UTF-8';                                // Evita problemas con eñes o acentos

        // --- CAMBIO OBLIGATORIO: PARCHE PARA EVITAR EL ERROR DE CERTIFICADOS EN LOCALHOST (XAMPP) ---
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // --- DESTINATARIOS ---
        $mail->setFrom('sortlyscan75@gmail.com', 'SortlyScan');     // Corregido con tu remitente real
        $mail->addAddress($para);                                   // A quién va dirigido

        // --- CONTENIDO ---
        $mail->isHTML(true);                                        // Formato HTML activo
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpoHTML;
        $mail->AltBody = strip_tags($cuerpoHTML);                   // Texto plano para gestores de correo viejos

        $mail->send();
        return true;
    } catch (Exception $e) {
        throw new Exception("El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}");
    }
}