<?php
// auth/logout.php
session_start();
header('Content-Type: application/json');

$_SESSION = [];

if (session_destroy()) {
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    
    echo json_encode(['success' => true, 'message' => 'Sesión cerrada correctamente.']);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error al cerrar la sesión"]);
}
?>