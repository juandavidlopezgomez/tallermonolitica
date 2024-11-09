<?php
require_once __DIR__ . '/../config/conexion.php';

class Responsable {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function obtenerResponsables() {
        try {
            $stmt = $this->db->query("SELECT id, nombre FROM responsables ORDER BY nombre");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener responsables: " . $e->getMessage();
            return [];
        }
    }
}
?>
