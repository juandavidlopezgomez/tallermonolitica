<?php
// models/Responsable.php
require_once __DIR__ . '/../config/conexion.php';

class Responsable {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->conectar();
    }

    // Obtener todos los responsables
    public function obtenerTodos() {
        $sql = "SELECT * FROM responsables";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

