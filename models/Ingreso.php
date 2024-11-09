<?php
require_once __DIR__ . '/../config/conexion.php';

class Ingreso {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function registrarIngreso($datos) {
        if (!$this->validarClavesForaneas($datos[':idPrograma'], $datos[':idSala'], $datos[':idResponsable'])) {
            echo "Error: Una de las claves foráneas no es válida.<br>";
            echo "Verifica los siguientes detalles:<br>";
            echo "ID Programa: {$datos[':idPrograma']}<br>";
            echo "ID Sala: {$datos[':idSala']}<br>";
            echo "ID Responsable: {$datos[':idResponsable']}<br>";
            return false;
        }

        try {
            $sql = "INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, idSala, idResponsable, fechaIngreso, horaIngreso, horaSalida)
                    VALUES (:codigoEstudiante, :nombreEstudiante, :idPrograma, :idSala, :idResponsable, :fechaIngreso, :horaIngreso, :horaSalida)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($datos);
        } catch (PDOException $e) {
            echo "Error al registrar el ingreso: " . $e->getMessage();
            return false;
        }
    }

    private function validarClavesForaneas($idPrograma, $idSala, $idResponsable) {
        $validPrograma = $this->existeEnTabla('programas', 'id', $idPrograma);
        $validSala = $this->existeEnTabla('salas', 'id', $idSala);
        $validResponsable = $this->existeEnTabla('responsables', 'id', $idResponsable);

        if (!$validPrograma) {
            echo "Error: El ID Programa {$idPrograma} no existe en la tabla programas.<br>";
        }
        if (!$validSala) {
            echo "Error: El ID Sala {$idSala} no existe en la tabla salas.<br>";
        }
        if (!$validResponsable) {
            echo "Error: El ID Responsable {$idResponsable} no existe en la tabla responsables.<br>";
        }

        return $validPrograma && $validSala && $validResponsable;
    }

    private function existeEnTabla($tabla, $columna, $valor) {
        $sql = "SELECT COUNT(*) FROM $tabla WHERE $columna = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchColumn() > 0;
    }

    public function obtenerTodosLosIngresos() {
        try {
            $sql = "SELECT i.*, 
                    p.nombre as nombre_programa,
                    s.nombre as nombre_sala,
                    r.nombre as nombre_responsable
                    FROM ingresos i
                    LEFT JOIN programas p ON i.idPrograma = p.id
                    LEFT JOIN salas s ON i.idSala = s.id
                    LEFT JOIN responsables r ON i.idResponsable = r.id
                    ORDER BY i.fechaIngreso DESC, i.horaIngreso DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener los ingresos: " . $e->getMessage();
            return [];
        }
    }

    // Este método ahora usa obtenerTodosLosIngresos
    public function obtenerIngresosDelDia() {
        return $this->obtenerTodosLosIngresos();
    }

    public function buscarPorRangoFecha($fechaInicio, $fechaFin) {
        try {
            $sql = "SELECT i.*, 
                    p.nombre as nombre_programa,
                    s.nombre as nombre_sala,
                    r.nombre as nombre_responsable
                    FROM ingresos i
                    LEFT JOIN programas p ON i.idPrograma = p.id
                    LEFT JOIN salas s ON i.idSala = s.id
                    LEFT JOIN responsables r ON i.idResponsable = r.id
                    WHERE DATE(i.fechaIngreso) BETWEEN :fechaInicio AND :fechaFin
                    ORDER BY i.fechaIngreso DESC, i.horaIngreso DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':fechaInicio' => $fechaInicio,
                ':fechaFin' => $fechaFin
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al buscar por rango de fecha: " . $e->getMessage();
            return [];
        }
    }

    public function filtrar($filtro, $valor) {
        try {
            $sql = "SELECT i.*, 
                    p.nombre as nombre_programa,
                    s.nombre as nombre_sala,
                    r.nombre as nombre_responsable
                    FROM ingresos i
                    LEFT JOIN programas p ON i.idPrograma = p.id
                    LEFT JOIN salas s ON i.idSala = s.id
                    LEFT JOIN responsables r ON i.idResponsable = r.id
                    WHERE ";

            switch($filtro) {
                case 'codigo':
                    $sql .= "i.codigoEstudiante LIKE :valor";
                    break;
                case 'nombre':
                    $sql .= "i.nombreEstudiante LIKE :valor";
                    break;
                case 'programa':
                    $sql .= "p.nombre LIKE :valor";
                    break;
                case 'sala':
                    $sql .= "s.nombre LIKE :valor";
                    break;
                default:
                    $sql .= "1=1";
            }
            
            $sql .= " ORDER BY i.fechaIngreso DESC, i.horaIngreso DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':valor' => "%$valor%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al filtrar registros: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerProgramas() {
        try {
            $stmt = $this->db->query("SELECT id, nombre FROM programas ORDER BY nombre");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener programas: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerSalas() {
        try {
            $stmt = $this->db->query("SELECT id, nombre FROM salas ORDER BY nombre");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener salas: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerResponsables() {
        try {
            $stmt = $this->db->query("SELECT id, nombre FROM responsables ORDER BY nombre");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener responsables: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerDetalleIngreso($id) {
        try {
            $sql = "SELECT i.*, 
                    p.nombre as nombre_programa,
                    s.nombre as nombre_sala,
                    r.nombre as nombre_responsable
                    FROM ingresos i
                    LEFT JOIN programas p ON i.idPrograma = p.id
                    LEFT JOIN salas s ON i.idSala = s.id
                    LEFT JOIN responsables r ON i.idResponsable = r.id
                    WHERE i.id = :id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener detalle del ingreso: " . $e->getMessage();
            return null;
        }
    }

    public function eliminarIngreso($id) {
        try {
            $sql = "DELETE FROM ingresos WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Error al eliminar el ingreso: " . $e->getMessage();
            return false;
        }
    }
}
?>