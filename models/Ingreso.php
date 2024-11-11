<?php
require_once __DIR__ . '/../config/conexion.php';

class Ingreso {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getInstance()->getConexion();
    }

    // Método para registrar un ingreso
    public function registrarIngreso($datos) {
        $query = "INSERT INTO ingresos 
                  (codigoEstudiante, nombreEstudiante, idPrograma, fechaIngreso, 
                   horaIngreso, idResponsable, idSala, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        
        try {
            $stmt = $this->conexion->prepare($query);
            $result = $stmt->execute([
                $datos['codigoEstudiante'],
                $datos['nombreEstudiante'],
                $datos['idPrograma'],
                $datos['fechaIngreso'],
                $datos['horaIngreso'],
                $datos['idResponsable'],
                $datos['idSala']
            ]);

            // Return success or failure
            return $result;
        } catch (PDOException $e) {
            error_log("Error al registrar el ingreso: " . $e->getMessage());
            return false;
        }
    }

    // Método para registrar la salida de un ingreso
    public function registrarSalida($id, $horaSalida) {
        $query = "UPDATE ingresos SET horaSalida = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$horaSalida, $id]);
    }

    public function obtenerIngresosPorFecha($fecha) {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                  FROM ingresos i 
                  JOIN programas p ON i.idPrograma = p.id 
                  JOIN salas s ON i.idSala = s.id 
                  JOIN responsables r ON i.idResponsable = r.id 
                  WHERE i.fechaIngreso = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$fecha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Método para obtener ingresos por rango de fechas
    public function obtenerIngresosPorRango($fechaInicio, $fechaFin) {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                  FROM ingresos i 
                  JOIN programas p ON i.idPrograma = p.id 
                  JOIN salas s ON i.idSala = s.id 
                  JOIN responsables r ON i.idResponsable = r.id 
                  WHERE i.fechaIngreso BETWEEN ? AND ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$fechaInicio, $fechaFin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para modificar datos de un ingreso
    public function modificarIngreso($id, $codigoEstudiante, $nombreEstudiante) {
        $query = "UPDATE ingresos 
                  SET codigoEstudiante = ?, nombreEstudiante = ?, updated_at = NOW() 
                  WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        return $stmt->execute([$codigoEstudiante, $nombreEstudiante, $id]);
    }

    // Método para buscar ingresos por filtros
    public function buscarPorFiltros($filtros) {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                  FROM ingresos i 
                  JOIN programas p ON i.idPrograma = p.id 
                  JOIN salas s ON i.idSala = s.id 
                  JOIN responsables r ON i.idResponsable = r.id 
                  WHERE 1=1";
        $params = [];

        if (!empty($filtros['codigoEstudiante'])) {
            $query .= " AND i.codigoEstudiante = ?";
            $params[] = $filtros['codigoEstudiante'];
        }
        if (!empty($filtros['idPrograma'])) {
            $query .= " AND i.idPrograma = ?";
            $params[] = $filtros['idPrograma'];
        }
        if (!empty($filtros['idResponsable'])) {
            $query .= " AND i.idResponsable = ?";
            $params[] = $filtros['idResponsable'];
        }

        $stmt = $this->conexion->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerIngresoPorId($id) {
        $query = "SELECT i.*, p.nombre as programa, s.nombre as sala, r.nombre as responsable 
                  FROM ingresos i
                  JOIN programas p ON i.idPrograma = p.id
                  JOIN salas s ON i.idSala = s.id
                  JOIN responsables r ON i.idResponsable = r.id
                  WHERE i.id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    

}
