<?php
class Ingreso {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=ingresos_salas_db', 'root', '');
    }

    public function registrar($data) {
        try {
            $sql = "INSERT INTO ingresos (codigo, nombre, programa, fechaIngreso, horaIngreso, idSala, responsable) 
                    VALUES (:codigo, :nombre, :programa, :fechaIngreso, :horaIngreso, :idSala, :responsable)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            echo "Error al registrar ingreso: " . $e->getMessage();
            return false;
        }
    }

    public function listarPorFecha($fecha) {
        try {
            $sql = "SELECT * FROM ingresos WHERE fechaIngreso = :fecha";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':fecha' => $fecha]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al listar ingresos del día: " . $e->getMessage();
            return [];
        }
    }

    public function buscarPorRangoFecha($fechaInicio, $fechaFin) {
        try {
            $sql = "SELECT * FROM ingresos WHERE fechaIngreso BETWEEN :fechaInicio AND :fechaFin";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':fechaInicio' => $fechaInicio, ':fechaFin' => $fechaFin]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al buscar por rango de fechas: " . $e->getMessage();
            return [];
        }
    }

    public function filtrar($filtro, $valor) {
        try {
            $sql = "SELECT * FROM ingresos WHERE $filtro LIKE :valor";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':valor' => "%$valor%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al filtrar los ingresos: " . $e->getMessage();
            return [];
        }
    }
}
?>
