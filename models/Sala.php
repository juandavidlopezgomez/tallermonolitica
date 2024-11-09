<?php
require_once __DIR__ . '/../config/conexion.php';

class Sala {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function obtenerSalasDisponibles($fecha, $horaInicio, $horaFin) {
        try {
            $sql = "SELECT * FROM salas WHERE id NOT IN (
                        SELECT idSala FROM horarios WHERE fecha = :fecha 
                        AND (horaInicio < :horaFin AND horaFin > :horaInicio)
                    )";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':fecha' => $fecha,
                ':horaInicio' => $horaInicio,
                ':horaFin' => $horaFin
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener salas disponibles: " . $e->getMessage();
            return [];
        }
    }
}
?>
