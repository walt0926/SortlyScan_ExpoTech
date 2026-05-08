<?php
// auth/signup.php
require_once '../config/conexion.php';
header('Content-Type: application/json');

$id_mined = filter_input(INPUT_POST, 'id_mined', FILTER_SANITIZE_STRING);
$nombre_centro = filter_input(INPUT_POST, 'nombre_centro', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';
$nombre_director = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_STRING);

if (!$id_mined || !$nombre_centro || !$email || !$password || !$nombre_director) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios.']);
    exit;
}

try {
    $pdo->beginTransaction(); 

    $stmt1 = $pdo->prepare("INSERT INTO Instituciones (id_mined, nombre_centro) VALUES (?, ?)");
    $stmt1->execute([$id_mined, $nombre_centro]);

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt2 = $pdo->prepare("INSERT INTO Usuarios (id_mined, email, password, rol, nombre_completo) VALUES (?, ?, ?, 'Director', ?)");
    $stmt2->execute([$id_mined, $email, $hashed_pass, $nombre_director]);

    $pdo->commit(); 
    echo json_encode(['success' => true, 'message' => 'Institución y Director registrados correctamente.']);

} catch (PDOException $e) {
    $pdo->rollBack();
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'El Código de Centro o el Email ya están registrados.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>