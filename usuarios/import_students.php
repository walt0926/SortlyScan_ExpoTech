<?php
// usuarios/import_alumnos.php
session_start();
header("Content-Type: application/json");
require_once("../config/conexion.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Maestro') {
    echo json_encode(["success" => false, "message" => "Acceso denegado."]);
    exit;
}

$id_maestro = $_SESSION['user_id'];

try {
    $stmt_salon = $pdo->prepare("SELECT id_salon FROM Salones WHERE id_maestro = ?");
    $stmt_salon->execute([$id_maestro]);
    $salon = $stmt_salon->fetch();

    if (!$salon) {
        echo json_encode(["success" => false, "message" => "No tienes un salón asignado aún."]);
        exit;
    }

    $id_salon = $salon['id_salon'];

    if (!isset($_FILES['archivo_alumnos']) || $_FILES['archivo_alumnos']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(["success" => false, "message" => "Error al subir el archivo CSV."]);
        exit;
    }

    $file = $_FILES['archivo_alumnos']['tmp_name'];
    $handle = fopen($file, "r");
    
    $insertados = 0;
    $duplicados = 0;

    fgetcsv($handle, 1000, ","); // Saltar encabezado

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $nombre_estudiante = trim($data[0]); 

        if (empty($nombre_estudiante)) continue;

        $check = $pdo->prepare("SELECT id_alumno FROM Alumnos WHERE id_salon = ? AND nombre_display = ?");
        $check->execute([$id_salon, $nombre_estudiante]);

        if ($check->rowCount() == 0) {
            $pin_automatico = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $insert = $pdo->prepare("INSERT INTO Alumnos (id_salon, nombre_display, pin) VALUES (?, ?, ?)");
            $insert->execute([$id_salon, $nombre_estudiante, $pin_automatico]);
            $insertados++;
        } else {
            $duplicados++;
        }
    }
    fclose($handle);

    echo json_encode([
        "success" => true, 
        "message" => "Importación terminada.",
        "insertados" => $insertados,
        "ignorados" => $duplicados
    ]);

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error de base de datos."]);
}
?>