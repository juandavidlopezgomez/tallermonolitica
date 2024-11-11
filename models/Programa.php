<?php
// models/Programa.php
require_once __DIR__ . '/../config/conexion.php';

class Programa {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM programas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
