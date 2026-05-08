<?php
// usuarios/create.php (Para crear maestros)
session_start();
header("Content-Type: application/json");
require_once("../config/conexion.php"); 

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Director') {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Acceso denegado. Solo directores pueden crear usuarios."]);
    exit;
}

$nombre = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = $_POST['password'] ?? '';
$id_mined = $_SESSION['id_mined']; 

if ($nombre && $username && $password) {
    try {
        $check = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE username = ?");
        $check->execute([$username]);
        
        if ($check->rowCount() > 0) {
            echo json_encode(["success" => false, "message" => "El nombre de usuario ya está en uso."]);
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO Usuarios (id_mined, username, password, rol, nombre_completo) 
                  VALUES (:id_mined, :username, :password, 'Maestro', :nombre)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':id_mined' => $id_mined,
            ':username' => $username,
            ':password' => $hashed_password,
            ':nombre'   => $nombre
        ]);

        echo json_encode(["success" => true, "message" => "Maestro registrado con éxito."]);

    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error de base de datos."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
}
?>