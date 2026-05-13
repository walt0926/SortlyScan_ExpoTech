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
$cct = $_POST['cct'] ?? ''; // El id_mined de la institución

// 4. Validación de campos vacíos
if (empty($identificador) || empty($password_input) || empty($rol) || empty($cct)) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios, incluyendo el CCT de la institución."]);
    exit;
}

try {
    // 5. Preparamos la consulta SQL
    // APLICAMOS EL FILTRO: Buscamos al usuario según su rol y ASEGURANDO que pertenezca a la escuela actual ($cct)
    
    if ($rol === 'director') {
        // Los directores ingresan con email
        $query = "SELECT id_usuario, nombre_completo, password FROM Usuarios 
                  WHERE email = :identificador AND rol = 'Director' AND id_mined = :cct LIMIT 1";
    } else {
        // Los maestros ingresan con username (número de nómina u otro usuario)
        $query = "SELECT id_usuario, nombre_completo, password FROM Usuarios 
                  WHERE username = :identificador AND rol = 'Maestro' AND id_mined = :cct LIMIT 1";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':identificador', $identificador, PDO::PARAM_STR);
    $stmt->bindParam(':cct', $cct, PDO::PARAM_STR);
    $stmt->execute();

    $usuario = $stmt->fetch();

    // 6. Verificamos si se encontró al usuario
    if ($usuario) {
        // ATENCIÓN: Esta verificación depende de cómo guardes las contraseñas en tu BD.
        // Si usas password_hash() en PHP para crear usuarios, debes usar password_verify() aquí.
        // Asumiendo que las contraseñas están en texto plano por ahora (para pruebas):
        
        if ($password_input === $usuario['password']) {
            
            // Si usas contraseñas encriptadas, comenta el IF de arriba y descomenta este:
            // if (password_verify($password_input, $usuario['password'])) {
            
            // Éxito: Todo coincide
            echo json_encode([
                "success" => true,
                "nombre_usuario" => $usuario['nombre_completo'],
                "id_usuario" => $usuario['id_usuario'] // Útil para guardarlo en el localStorage si lo necesitas luego
            ]);
        } else {
            // Error: Contraseña incorrecta
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta."]);
        }
    } else {
        // Error: Usuario no encontrado (o no pertenece a esa escuela)
        echo json_encode(["success" => false, "message" => "Usuario no encontrado en esta institución."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al consultar la base de datos."]);
}
?>