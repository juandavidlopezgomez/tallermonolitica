<?php
// models/Ingreso.php
require_once __DIR__ . '/../config/conexion.php';

class Ingreso {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexion())->conectar();
    }

    // Listar todos los ingresos de hoy
    public function obtenerHoy() {
        $sql = "SELECT * FROM ingresos WHERE DATE(fechaIngreso) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar ingresos por rango de fechas
    public function obtenerPorFecha($fechaInicio, $fechaFin) {
        $sql = "SELECT * FROM ingresos WHERE fechaIngreso BETWEEN :fechaInicio AND :fechaFin";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':fechaInicio' => $fechaInicio, ':fechaFin' => $fechaFin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   // models/Ingreso.php
public function crear($data) {
    $sql = "INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, fechaIngreso, horaIngreso, horaSalida, idResponsable, idSala, fechaCreacion) 
            VALUES (:codigo, :nombre, :programa, :fechaIngreso, :horaIngreso, :horaSalida, :responsable, :sala, NOW())";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':codigo' => $data['codigoEstudiante'],
        ':nombre' => $data['nombreEstudiante'],
        ':programa' => $data['idPrograma'],
        ':fechaIngreso' => $data['fechaIngreso'],
        ':horaIngreso' => $data['horaIngreso'],
        ':horaSalida' => $data['horaSalida'],
        ':responsable' => $data['idResponsable'],
        ':sala' => $data['idSala']
    ]);
}



    // Validar que el horario esté dentro del rango permitido
    public function esHorarioValido($fechaIngreso, $horaIngreso) {
        $dayOfWeek = date('N', strtotime($fechaIngreso));
        $time = strtotime($horaIngreso);

        $weekdayStart = strtotime("07:00");
        $weekdayEnd = strtotime("20:50");
        $saturdayStart = strtotime("07:00");
        $saturdayEnd = strtotime("16:30");

        if (($dayOfWeek >= 1 && $dayOfWeek <= 5 && $time >= $weekdayStart && $time <= $weekdayEnd) ||
            ($dayOfWeek == 6 && $time >= $saturdayStart && $time <= $saturdayEnd)) {
            return true;
        }
        return false;
    }

    // Obtener un ingreso por su ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM ingresos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un ingreso existente y registrar la fecha de modificación
    public function actualizar($id, $data) {
        $sql = "UPDATE ingresos SET codigoEstudiante = :codigo, nombreEstudiante = :nombre, idPrograma = :programa, fechaIngreso = :fecha, horaIngreso = :horaIngreso, idResponsable = :responsable, idSala = :sala, fechaModificacion = NOW() WHERE id = :id";
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
