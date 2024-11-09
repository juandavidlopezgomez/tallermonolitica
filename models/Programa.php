<?php
require_once __DIR__ . '/../config/conexion.php';

class Programa {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function obtenerProgramas() {
        try {
            $stmt = $this->db->query("SELECT id, nombre FROM programas ORDER BY nombre");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener programas: " . $e->getMessage();
            return [];
        }
    }
}
?>
