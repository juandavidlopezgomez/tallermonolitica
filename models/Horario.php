<?php
require_once __DIR__ . '/../config/conexion.php';

class Horario {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->getConexion();
    }

    public function salaDisponible($idSala, $dia, $hora) {
      
        $query = "SELECT * FROM horarios_salas 
                  WHERE idSala = ? AND dia = ? 
                  AND ? BETWEEN horaInicio AND horaFin";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$idSala, $dia, $hora]);

     
        error_log("Consultando disponibilidad de la sala: ID Sala = $idSala, Día = $dia, Hora = $hora");
        $disponible = $stmt->rowCount() === 0;
        error_log("Resultado de disponibilidad: " . ($disponible ? "Disponible" : "No disponible"));

        return $disponible;
    }
}
