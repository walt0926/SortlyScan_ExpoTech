<?php
// public/logic/login_staff.php
header('Content-Type: application/json; charset=utf-8');

// 1. Conexión a la base de datos
try {
    require_once __DIR__ . '/../../config/conexion.php';
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error de conexión al servidor."]);
    exit;
}

// 2. Validación de método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Método no permitido."]);
    exit;
}

// 3. Recepción de datos desde el JS
$identificador = $_POST['identificador'] ?? ''; // Para maestros es username, para directores es email
$password_input = $_POST['pass'] ?? '';
$rol = $_POST['rol'] ?? ''; // 'maestro' o 'director'
$cct = $_POST['cct'] ?? ''; // Ya no será obligatorio para el maestro

// 4. Validación de campos obligatorios
if (empty($identificador) || empty($password_input) || empty($rol)) {
    echo json_encode(["success" => false, "message" => "Usuario y contraseña son obligatorios."]);
    exit;
}

try {
    // 5. Preparamos la consulta SQL
    if ($rol === 'director') {
        // Al director lo buscamos por email
        $query = "SELECT id_usuario, nombre_completo, password FROM Usuarios 
                  WHERE email = :identificador AND rol = 'Director' LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    } else {
        // Al maestro lo buscamos por username y ya NO lo filtramos por CCT
        $query = "SELECT id_usuario, nombre_completo, password FROM Usuarios 
                  WHERE username = :identificador AND rol = 'Maestro' LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    }

    $stmt->execute();
    $usuario = $stmt->fetch();

    // 6. Verificamos si se encontró al usuario
    if ($usuario) {
        if ($password_input === $usuario['password']) {
            // Éxito: Todo coincide
            echo json_encode([
                "success" => true,
                "nombre_usuario" => $usuario['nombre_completo'],
                "id_usuario" => $usuario['id_usuario'] 
            ]);
        } else {
            // Error: Contraseña incorrecta
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta."]);
        }
    } else {
        // Error: Usuario no encontrado
        echo json_encode(["success" => false, "message" => "Usuario no encontrado."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al consultar la base de datos."]);
}
?>