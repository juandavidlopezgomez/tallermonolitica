<?php
class Horario {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=ingresos_salas_db', 'root', '');
    }

    public function verificarDisponibilidad($idSala, $fecha, $horaInicio, $horaFin) {
        try {
            $sql = "SELECT COUNT(*) FROM horarios_salas WHERE idSala = :idSala 
                    AND dia = :fecha 
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
