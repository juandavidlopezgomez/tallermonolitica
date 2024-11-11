<?php
require_once __DIR__ . '/../config/conexion.php';

class Sala {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->getConexion();
    }

    public function obtenerTodas() {
        $query = "SELECT * FROM salas";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM salas WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
