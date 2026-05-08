<?php
// usuarios/create_salon.php
session_start();
header("Content-Type: application/json");
require_once("../config/conexion.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Director') {
    echo json_encode(["success" => false, "message" => "Acceso denegado."]);
    exit;
}

$nombre_salon = filter_input(INPUT_POST, 'nombre_salon', FILTER_SANITIZE_STRING);
$id_maestro = filter_input(INPUT_POST, 'id_maestro', FILTER_SANITIZE_NUMBER_INT);
$id_mined = $_SESSION['id_mined']; 

function generarCodigoAula($length = 6) {
    $caracteres = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ'; 
    $codigo = '';
    for ($i = 0; $i < $length; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo;
}

if ($nombre_salon && $id_maestro) {
    try {
        $codigo_generado = generarCodigoAula();
        $query = "INSERT INTO Salones (id_mined, id_maestro, nombre_salon, codigo_aula) 
                  VALUES (:id_mined, :id_maestro, :nombre, :codigo)";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':id_mined'   => $id_mined,
            ':id_maestro' => $id_maestro,
            ':nombre'     => $nombre_salon,
            ':codigo'     => $codigo_generado
        ]);

        echo json_encode([
            "success" => true, 
            "message" => "Salón creado con éxito.",
            "codigo_aula" => $codigo_generado
        ]);

    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error: El maestro ya tiene un salón asignado o error de sistema."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
}
?>