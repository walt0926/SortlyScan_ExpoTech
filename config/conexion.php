<?php
// config/conexion.php

class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        $env_path = __DIR__ . '/../.env';
        if (!file_exists($env_path)) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Error de configuración interna (ENV)"]);
            exit;
        }
        
        $env = parse_ini_file($env_path);

        $host = $env['DB_HOST'] ?? 'localhost';
        $db_name = $env['DB_NAME'] ?? 'bdsortlyscan';
        $username = $env['DB_USER'] ?? 'root';
        $password = $env['DB_PASS'] ?? '';

        try {
            $this->conn = new PDO(
                "mysql:host=$host;dbname=$db_name;charset=utf8mb4", 
                $username, 
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch(PDOException $exception) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Error de conexión a la base de datos"]);
            exit;
        }
        
        return $this->conn;
    }
}

$database = new Database();
$pdo = $database->getConnection();
?>