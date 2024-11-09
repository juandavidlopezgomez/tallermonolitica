<?php
require_once __DIR__ . '/../config/conexion.php';

class Horario {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function verificarDisponibilidad($idSala, $fecha, $horaInicio, $horaFin) {
        try {
            $sql = "SELECT COUNT(*) FROM horarios WHERE idSala = :idSala 
                    AND fecha = :fecha 
                    AND (horaInicio < :horaFin AND horaFin > :horaInicio)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':idSala' => $idSala,
                ':fecha' => $fecha,
                ':horaInicio' => $horaInicio,
                ':horaFin' => $horaFin
            ]);
            return $stmt->fetchColumn() == 0;
        } catch (PDOException $e) {
            echo "Error al verificar disponibilidad: " . $e->getMessage();
            return false;
        }
    }
}
?>
