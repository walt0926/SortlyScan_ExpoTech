<?php
// public/logic/agregar_alumno.php

// 1. Blindaje contra salidas inesperadas de texto
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

ob_start();

try {
    // 2. Conexión a la base de datos
    $config_path = __DIR__ . '/../../config/conexion.php';
    if (!file_exists($config_path)) {
        throw new Exception("Error interno de configuración del servidor.");
    }
    require_once $config_path;

    // 3. Recepción de parámetros (Sintaxis compatible PHP 5.6)
    $id_maestro    = isset($_POST['id_maestro'])    ? trim($_POST['id_maestro'])    : '';
    $nombre_alumno = isset($_POST['nombre_alumno']) ? trim($_POST['nombre_alumno']) : '';
    $pin_alumno    = isset($_POST['pin_alumno'])    ? trim($_POST['pin_alumno'])    : '';

    if (empty($id_maestro) || empty($nombre_alumno) || empty($pin_alumno)) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar el formato del PIN por seguridad
    if (!preg_match('/^\d{4}$/', $pin_alumno)) {
        throw new Exception("El PIN debe constar estrictamente de 4 dígitos numéricos.");
    }

    // 4. Buscar el ID del salón asignado a este maestro
    $stmt_salon = $pdo->prepare("SELECT id_salon FROM Salones WHERE id_maestro = :id LIMIT 1");
    $stmt_salon->execute(array(':id' => $id_maestro));
    $salon = $stmt_salon->fetch(PDO::FETCH_ASSOC);

    if (!$salon) {
        throw new Exception("No tienes un salón asignado para registrar alumnos.");
    }

    $id_salon = $salon['id_salon'];

    // 5. Insertar al nuevo alumno en la tabla Alumnos
    // (puntos_totales tiene DEFAULT 0 en la BD, no es necesario enviarlo)
    $stmt_insert = $pdo->prepare("
        INSERT INTO Alumnos (id_salon, nombre_display, pin) 
        VALUES (:id_salon, :nombre, :pin)
    ");
    
    $stmt_insert->execute(array(
        ':id_salon' => $id_salon,
        ':nombre'   => $nombre_alumno,
        ':pin'      => $pin_alumno
    ));

    // 6. Construcción de la respuesta exitosa
    $respuesta = array(
        "success" => true,
        "message" => "Alumno registrado exitosamente."
    );

} catch (Exception $e) {
    $respuesta = array(
        "success" => false,
        "message" => $e->getMessage()
    );
}

// Despejar buffer y enviamos JSON limpio
ob_clean();
echo json_encode($respuesta);
exit;
?>