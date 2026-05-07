<?php
require_once("config/conexion.php");

$database = new Database();
$db = $database->getConnection();

try {
    $id_mined = "10293";
    $stmt1 = $db->prepare("INSERT IGNORE INTO Instituciones (id_mined, nombre_centro) VALUES (?, ?)");
    $stmt1->execute([$id_mined, 'Centro Escolar SortlyScan']);

    $user = "director_expo";
    $pass = password_hash("admin123", PASSWORD_DEFAULT);
    
    $stmt2 = $db->prepare("INSERT IGNORE INTO Usuarios (id_mined, username, password, rol, nombre_completo) VALUES (?, ?, ?, ?, ?)");
    $stmt2->execute([$id_mined, $user, $pass, 'Director', 'Administrador General']);

    echo "Sistema inicializado correctamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>