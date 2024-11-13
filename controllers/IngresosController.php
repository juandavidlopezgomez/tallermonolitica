<?php 

date_default_timezone_set('America/Mexico_City'); 
require_once __DIR__ . '/../models/Ingreso.php'; 
require_once __DIR__ . '/../models/Horario.php'; 
require_once __DIR__ . '/../models/Programa.php'; 
require_once __DIR__ . '/../models/Sala.php'; 
require_once __DIR__ . '/../models/Responsable.php'; 
require_once __DIR__ . '/../config/conexion.php';

class IngresosController { 
    private $ingresoModel; 
    private $horarioModel; 
    private $programaModel; 
    private $salaModel; 
    private $responsableModel; 
    private $db; 

    public function __construct() {
        $this->db = Conexion::getInstance()->getConexion(); 
        $this->ingresoModel = new Ingreso();
        $this->horarioModel = new Horario();
        $this->programaModel = new Programa();
        $this->salaModel = new Sala();
        $this->responsableModel = new Responsable();
    
        
        error_log("Conexión a la base de datos establecida correctamente.");
    }
    
    public function registrarIngreso($codigoEstudiante, $nombreEstudiante, $idPrograma, $idSala, $idResponsable, $fechaIngreso, $horaIngreso) { 
        $retries = 3; 
        $success = false;
        
        while ($retries > 0 && !$success) {
            try {
                $stmt = $this->db->prepare("INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, idSala, idResponsable, fechaIngreso, horaIngreso, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                $success = $stmt->execute([$codigoEstudiante, $nombreEstudiante, $idPrograma, $idSala, $idResponsable, $fechaIngreso, $horaIngreso]);
            } catch (PDOException $e) {
                error_log("Error al registrar ingreso: " . $e->getMessage());
                $retries--;
                if ($retries == 0) {
                    return false;
                }
            }
        }
        
        return $success; 
    }

    public function index($fecha = null) {
       
        $fecha = $fecha ?? date('Y-m-d');
        error_log("Consultando ingresos para la fecha: " . $fecha);
        
      
        return $this->ingresoModel->obtenerIngresosPorFecha($fecha);
    }

    public function obtenerProgramas() { 
        return $this->programaModel->obtenerTodos(); 
    } 

    public function obtenerSalas() { 
        return $this->salaModel->obtenerTodas(); 
    } 

    public function obtenerResponsables() { 
        return $this->responsableModel->obtenerTodos(); 
    } 

    public function guardar() {
        session_start();
        
        
        $diaActual = date('l'); 
        $horaActual = date('H:i:s');

        // Validar que no sea domingo
        if ($diaActual === 'Sunday') {
            echo "<script>alert('Día no permitido para registro de ingresos.'); window.location.href = '../views/ingresos/crear.php';</script>";
            exit;
        }
    
        // Validar que esté en horario permitido 
        $horaInicioPermitida = '08:00:00';
        $horaFinPermitida = '18:00:00';
        
        if ($horaActual < $horaInicioPermitida || $horaActual > $horaFinPermitida) {
            echo "<script>alert('Hora no permitida para registro de ingresos.'); window.location.href = '../views/ingresos/crear.php';</script>";
            exit;
        }
    
        // Verificar la disponibilidad de la sala en el horario
        $diaEspanol = $this->traducirDia($diaActual); 
        if (!$this->horarioModel->salaDisponible($_POST['idSala'], $diaEspanol, $horaActual)) { 
            echo "<script>alert('La sala no está disponible en este momento'); window.location.href = '../views/ingresos/crear.php';</script>";
            exit; 
        } 
    
       
        $datos = [
            'codigoEstudiante' => $_POST['codigoEstudiante'], 
            'nombreEstudiante' => $_POST['nombreEstudiante'], 
            'idPrograma' => $_POST['idPrograma'], 
            'fechaIngreso' => date('Y-m-d'), 
            'horaIngreso' => $horaActual, 
            'idResponsable' => $_POST['idResponsable'], 
            'idSala' => $_POST['idSala']
        ];
    
        
        if ($this->registrarIngreso($datos['codigoEstudiante'], $datos['nombreEstudiante'], $datos['idPrograma'], $datos['idSala'], $datos['idResponsable'], $datos['fechaIngreso'], $datos['horaIngreso'])) {
            echo "<script>alert('Ingreso registrado correctamente'); window.location.href = '../public/index.php?mensaje=ingreso_registrado';</script>";
            exit;
        } else {
            echo "<script>alert('Error al registrar el ingreso'); window.location.href = '../views/ingresos/crear.php';</script>";
            exit;
        }
    }

    private function traducirDia($dia) { 
        $dias = [ 
            'Sunday' => 'Domingo', 'Monday' => 'Lunes', 'Tuesday' => 'Martes', 
            'Wednesday' => 'Miércoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 
            'Saturday' => 'Sábado' 
        ]; 
        return $dias[$dia]; 
    } 

    public function registrarSalida($id) {
        $conexion = Conexion::getInstance()->getConexion();

        $sql = "UPDATE ingresos SET horaSalida = NOW() WHERE id = :id AND horaSalida IS NULL";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        return $this->ingresoModel->obtenerIngresoPorId($id);
    }

    public function actualizarIngreso($id, $codigoEstudiante, $nombreEstudiante) {
        return $this->ingresoModel->modificarIngreso($id, $codigoEstudiante, $nombreEstudiante);
    }
}