<?php
// config/conexion.php
class Conexion {
    private $host = "localhost";
    private $dbname = "ingresos_salas_db";
    private $username = "root";
    private $password = "";
    public $conn;

    // Cambia a public para permitir instancias de esta clase
    public function __construct() {
        $this->conectar();
    }

    public function conectar() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>
