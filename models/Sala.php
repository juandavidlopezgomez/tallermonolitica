<?php
// models/Sala.php
require_once __DIR__ . '/../config/conexion.php';

class Sala {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->conectar();
    }

    // Obtener todas las salas
    public function obtenerTodos() {
        $sql = "SELECT * FROM salas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

