<?php
// models/Horario.php
require_once __DIR__ . '/../config/conexion.php';

class Horario {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->conectar();
    }

    // Obtener todos los horarios de salas
    public function obtenerTodos() {
        $sql = "SELECT * FROM horarios_salas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener horario por sala
    public function obtenerPorSala($idSala) {
        $sql = "SELECT * FROM horarios_salas WHERE idSala = :idSala";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idSala', $idSala);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // models/Horario.php
// models/Horario.php
public function salaDisponible($idSala, $fechaIngreso, $horaIngreso) {
    $sql = "SELECT * FROM horarios_salas 
            WHERE idSala = :idSala 
            AND fechaIngreso = :fechaIngreso 
            AND :horaIngreso BETWEEN horaInicio AND horaFin";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':idSala' => $idSala, ':fechaIngreso' => $fechaIngreso, ':horaIngreso' => $horaIngreso]);
    return $stmt->rowCount() == 0; // True if no class is scheduled
}

}
?>
