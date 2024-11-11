<?php
require_once __DIR__ . '/../models/Ingreso.php';
require_once __DIR__ . '/../models/Horario.php';
require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/Sala.php';
require_once __DIR__ . '/../models/Responsable.php';

class IngresosController {
    private $ingresoModel;
    private $horarioModel;
    private $programaModel;
    private $salaModel;
    private $responsableModel;

    public function __construct() {
        $this->ingresoModel = new Ingreso();
        $this->horarioModel = new Horario();
        $this->programaModel = new Programa();
        $this->salaModel = new Sala();
        $this->responsableModel = new Responsable();
    }

    public function index() {
        return $this->ingresoModel->obtenerIngresosPorFecha(date('Y-m-d'));
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

    public function obtenerPorId($id) {
        return $this->ingresoModel->obtenerPorId($id);
    }

    private function validarHorarioAtencion($diaActual, $horaActual) {
        // Convertir día a español
        $diasSemana = [
            'Sunday' => 'Domingo',
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado'
        ];
        
        $dia = $diasSemana[$diaActual];
        
        // Convertir hora a objeto DateTime para comparación
        $hora = DateTime::createFromFormat('H:i:s', $horaActual);
        $horaInicio = DateTime::createFromFormat('H:i', '07:00');
        $horaFinLV = DateTime::createFromFormat('H:i', '20:50');
        $horaFinS = DateTime::createFromFormat('H:i', '16:30');
        
        // Verificar si es día hábil
        if ($dia === 'Domingo') {
            return false;
        }
        
        // Verificar horarios según el día
        if ($dia === 'Sábado') {
            return $hora >= $horaInicio && $hora <= $horaFinS;
        } else {
            return $hora >= $horaInicio && $hora <= $horaFinLV;
        }
    }

    public function guardar() {
        session_start();
        
        // Obtener día y hora actual
        $diaActual = date('l'); // Devuelve el nombre del día en inglés
        $horaActual = date('H:i:s');
        
        // Validar horario de atención
        if (!$this->validarHorarioAtencion($diaActual, $horaActual)) {
            $_SESSION['error'] = "Fuera del horario de atención";
            header('Location: views/ingresos/crear.php');
            return false;
        }

        // Validar disponibilidad de sala
        $diasEspanol = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado'
        ];
        
        $diaEspanol = $diasEspanol[$diaActual];
        
        if (!$this->horarioModel->salaDisponible($_POST['idSala'], $diaEspanol, $horaActual)) {
            $_SESSION['error'] = "La sala no está disponible en este momento";
            header('Location: views/ingresos/crear.php');
            return false;
        }

        // Preparar datos para el registro
        $datos = [
            'codigoEstudiante' => $_POST['codigoEstudiante'],
            'nombreEstudiante' => $_POST['nombreEstudiante'],
            'idPrograma' => $_POST['idPrograma'],
            'fechaIngreso' => date('Y-m-d'),
            'horaIngreso' => $horaActual,
            'idResponsable' => $_POST['idResponsable'],
            'idSala' => $_POST['idSala']
        ];

        // Intentar registrar el ingreso
        if ($this->ingresoModel->registrarIngreso($datos)) {
            $_SESSION['success'] = "Ingreso registrado correctamente";
            header('Location: views/ingresos/lista.php');
            return true;
        } else {
            $_SESSION['error'] = "Error al registrar el ingreso";
            header('Location: views/ingresos/crear.php');
            return false;
        }
    }

    public function registrarSalida() {
        session_start();
        
        if (!isset($_POST['id'])) {
            $_SESSION['error'] = "ID de ingreso no proporcionado";
            header('Location: views/ingresos/lista.php');
            return false;
        }

        $horaSalida = date('H:i:s');
        
        // Validar que la salida sea en horario de atención
        if (!$this->validarHorarioAtencion(date('l'), $horaSalida)) {
            $_SESSION['error'] = "No se puede registrar salida fuera del horario de atención";
            header('Location: views/ingresos/lista.php');
            return false;
        }

        if ($this->ingresoModel->registrarSalida($_POST['id'], $horaSalida)) {
            $_SESSION['success'] = "Salida registrada correctamente";
        } else {
            $_SESSION['error'] = "Error al registrar la salida";
        }

        header('Location: views/ingresos/lista.php');
        return true;
    }

    public function actualizar($id, $codigoEstudiante, $nombreEstudiante) {
        session_start();
        
        // Validar que el ingreso existe
        $ingreso = $this->ingresoModel->obtenerPorId($id);
        if (!$ingreso) {
            $_SESSION['error'] = "El ingreso no existe";
            return false;
        }

        // Intentar modificar el ingreso
        if ($this->ingresoModel->modificarIngreso($id, $codigoEstudiante, $nombreEstudiante)) {
            $_SESSION['success'] = "Ingreso modificado correctamente";
            return true;
        } else {
            $_SESSION['error'] = "Error al modificar el ingreso";
            return false;
        }
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
}
?>