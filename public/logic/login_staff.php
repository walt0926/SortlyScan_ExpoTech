<?php
// public/logic/login_staff.php

// 1. Blindaje: Evitamos que cualquier advertencia de PHP rompa el formato JSON esperado por JS
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

// Iniciamos el buffer para atrapar cualquier salida inesperada
ob_start();

try {
    // 2. Conexión a la base de datos
    $config_path = __DIR__ . '/../../config/conexion.php';
    if (!file_exists($config_path)) {
        throw new Exception("Archivo de conexión no encontrado.");
    }
    
    require_once $config_path;

    if (!isset($pdo)) {
        throw new Exception("La variable de conexión \$pdo no está definida.");
    }

    // 3. Validación de método
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método de solicitud no válido.");
    }

    // 4. Recepción de datos (Modificado a 'isset' para total compatibilidad con PHP viejo)
    $identificador  = isset($_POST['identificador']) ? trim($_POST['identificador']) : ''; 
    $password_input = isset($_POST['pass'])          ? trim($_POST['pass'])          : '';
    $rol            = isset($_POST['rol'])           ? trim($_POST['rol'])           : ''; 
    $cct            = isset($_POST['cct'])           ? trim($_POST['cct'])           : ''; 

    // 5. Validación de campos obligatorios
    if (empty($identificador) || empty($password_input) || empty($rol)) {
        throw new Exception("Usuario y contraseña son obligatorios.");
    }

    if ($rol === 'maestro' && empty($cct)) {
        throw new Exception("Falta el CCT de la institución para el maestro.");
    }

    // 6. Preparamos la consulta SQL basándonos en tu estructura de base de datos
    if ($rol === 'director') {
        // Buscamos en la tabla 'Usuarios' por la columna 'email' y rol 'Director'
        $query = "SELECT id_usuario, nombre_completo, password FROM Usuarios 
                  WHERE email = :identificador AND rol = 'Director' LIMIT 1";
        $stmt = $pdo->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta del director.");
        }
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    } else {
        // Para maestros buscamos por 'username' e 'id_mined'
        $query = "SELECT id_usuario, nombre_completo, password FROM Usuarios 
                  WHERE username = :identificador AND rol = 'Maestro' AND id_mined = :cct LIMIT 1";
        $stmt = $pdo->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta del maestro.");
        }
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
        $stmt->bindParam(':cct', $cct, PDO::PARAM_STR);
    }

    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // 7. Verificamos las credenciales
    if ($usuario) {
        $db_password = $usuario['password'];

        // Soporta tanto contraseñas encriptadas con hash como texto plano para tus pruebas
        if (password_verify($password_input, $db_password) || $password_input === $db_password) {
            $respuesta = array(
                "success" => true,
                "nombre_usuario" => $usuario['nombre_completo'],
                "id_usuario" => $usuario['id_usuario'] 
            );
        } else {
            $respuesta = array(
                "success" => false, 
                "message" => "Contraseña incorrecta."
            );
        }
    } else {
        $respuesta = array(
            "success" => false, 
            "message" => "Usuario no encontrado. Verifica el correo ingresado."
        );
    }

} catch (Exception $e) {
    // Cambiado de 'Throwable' a 'Exception' para que no rompa versiones viejas de PHP
    $respuesta = array(
        "success" => false,
        "message" => "Error interno en el servidor: " . $e->getMessage()
    );
}

// Limpiamos el buffer y enviamos la respuesta estructurada
ob_clean();
echo json_encode($respuesta);
exit;
?>