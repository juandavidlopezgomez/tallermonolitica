<?php
require_once __DIR__ . '/../config/conexion.php';

class Ingreso {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function registrarIngreso($datos) {
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

    public function obtenerIngresosDelDia() {
        try {
            $sql = "SELECT i.*, p.nombre as nombre_programa, s.nombre as nombre_sala, r.nombre as nombre_responsable
                    FROM ingresos i
                    LEFT JOIN programas p ON i.idPrograma = p.id
                    LEFT JOIN salas s ON i.idSala = s.id
                    LEFT JOIN responsables r ON i.idResponsable = r.id
                    WHERE DATE(i.fechaIngreso) = CURDATE()
                    ORDER BY i.horaIngreso";
            
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener ingresos del día: " . $e->getMessage();
            return [];
        }
    }
}
?>
