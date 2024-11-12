<?php
require_once __DIR__ . '/../config/conexion.php';

class Horario {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->getConexion();
    }

    public function obtenerHorarioSala($idSala, $dia) {
        $query = "SELECT * FROM horarios_salas WHERE idSala = ? AND dia = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$idSala, $dia]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salaDisponible($idSala, $dia, $hora) {
        $query = "SELECT * FROM horarios_salas 
                 WHERE idSala = ? AND dia = ? 
                 AND ? BETWEEN horaInicio AND horaFin";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$idSala, $dia, $hora]);
        return $stmt->rowCount() === 0;
    }

    public function agregarHorario($dia, $materia, $horaInicio, $horaFin, $idPrograma, $idSala) {
        $query = "INSERT INTO horarios_salas (dia, materia, horaInicio, horaFin, idPrograma, idSala) 
                 VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$dia, $materia, $horaInicio, $horaFin, $idPrograma, $idSala]);
    }
}
?>