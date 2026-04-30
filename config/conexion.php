<?php
class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        $env_path = __DIR__ . '/../.env';
        if (!file_exists($env_path)) {
            die("Error: No se encontró el archivo .env en la raíz.");
        }
        
        $env = parse_ini_file($env_path);

        $host = $env['DB_HOST'];
        $db_name = $env['DB_NAME'];
        $username = $env['DB_USER'];
        $password = $env['DB_PASS'];

        try {
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8mb4", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}
?>