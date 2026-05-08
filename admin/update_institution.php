// opción para corregir el nombre o código de la institución en caso de haber cometido un error_clear_last

<?php
// admin/update_institucion.php
session_start();
require_once '../config/conexion.php';
header('Content-Type: application/json');

// SEGURIDAD: Solo el Director
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Director') {
    echo json_encode(['success' => false, 'message' => 'Acceso denegado.']);
    exit;
}

$id_actual = $_SESSION['id_mined']; 
$nuevo_id = filter_input(INPUT_POST, 'nuevo_id_mined', FILTER_SANITIZE_STRING);
$nuevo_nombre = filter_input(INPUT_POST, 'nuevo_nombre_centro', FILTER_SANITIZE_STRING);

if (!$nuevo_id || !$nuevo_nombre) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit;
}

try {
    // Al usar ON UPDATE CASCADE en SQL, esto actualiza automáticamente a maestros y salones
    $stmt = $pdo->prepare("UPDATE Instituciones SET id_mined = ?, nombre_centro = ? WHERE id_mined = ?");
    $stmt->execute([$nuevo_id, $nuevo_nombre, $id_actual]);

    // Actualizamos la sesión para que el Director no pierda el acceso
    $_SESSION['id_mined'] = $nuevo_id;

    echo json_encode(['success' => true, 'message' => 'Datos de la institución actualizados con éxito.']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: El nuevo ID ya está registrado en otra escuela.']);
}