<?php
// models/Ingreso.php
require_once __DIR__ . '/../config/conexion.php';

class Ingreso {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->conectar();
    }

    // Obtener todos los ingresos
    public function obtenerTodos() {
        $sql = "SELECT * FROM ingresos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo ingreso
    public function crear($data) {
        $sql = "INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, fechaIngreso, horaIngreso, idResponsable, idSala) 
                VALUES (:codigo, :nombre, :programa, :fecha, :horaIngreso, :responsable, :sala)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':codigo' => $data['codigoEstudiante'],
            ':nombre' => $data['nombreEstudiante'],
            ':programa' => $data['idPrograma'],
            ':fecha' => $data['fechaIngreso'],
            ':horaIngreso' => $data['horaIngreso'],
            ':responsable' => $data['idResponsable'],
            ':sala' => $data['idSala']
        ]);
    }

    // Obtener un ingreso por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM ingresos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un ingreso existente
    public function actualizar($id, $data) {
        $sql = "UPDATE ingresos SET codigoEstudiante = :codigo, nombreEstudiante = :nombre, idPrograma = :programa, fechaIngreso = :fecha, horaIngreso = :horaIngreso, idResponsable = :responsable, idSala = :sala WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':codigo' => $data['codigoEstudiante'],
            ':nombre' => $data['nombreEstudiante'],
            ':programa' => $data['idPrograma'],
            ':fecha' => $data['fechaIngreso'],
            ':horaIngreso' => $data['horaIngreso'],
            ':responsable' => $data['idResponsable'],
            ':sala' => $data['idSala']
        ]);
    }

    // Eliminar un ingreso por ID
    public function eliminar($id) {
        $sql = "DELETE FROM ingresos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
