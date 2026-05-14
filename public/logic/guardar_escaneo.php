<?php
// Indicamos que devolveremos una respuesta en formato JSON
header('Content-Type: application/json');

// Credenciales de tu base de datos (Actualízalas según tu entorno)
$host = 'localhost';
$dbname = 'bdsortlyscan';
$username = 'root'; 
$password = ''; 

try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // JavaScript envía los datos vía POST en formato JSON
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Validamos que se enviaron los datos correctamente
    if (isset($data['id_alumno']) && isset($data['tipo_residuo']) && isset($data['puntos_obtenidos'])) {
        
        $id_alumno = $data['id_alumno'];
        $tipo_residuo = $data['tipo_residuo'];
        $puntos_obtenidos = $data['puntos_obtenidos'];

        // Preparamos e insertamos el registro en la tabla Escaneos
        $sql = "INSERT INTO Escaneos (id_alumno, tipo_residuo, puntos_obtenidos) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_alumno, $tipo_residuo, $puntos_obtenidos]);

        // El Trigger "trigger_sumar_puntos" se encarga automáticamente
        // de actualizar la tabla "Alumnos"

        echo json_encode([
            'success' => true, 
            'message' => "Escaneo guardado correctamente en la BD."
        ]);

    } else {
        echo json_encode([
            'success' => false, 
            'error' => 'Datos incompletos enviados desde la IA.'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false, 
        'error' => 'Error de Base de Datos: ' . $e->getMessage()
    ]);
}
?>