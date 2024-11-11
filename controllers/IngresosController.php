<?php

require_once __DIR__ . '/../models/Ingreso.php';
require_once __DIR__ . '/../models/Horario.php';
require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/Sala.php';
require_once __DIR__ . '/../models/Responsable.php';
require_once __DIR__ . '/../config/conexion.php'; // Asegúrate de incluir la conexión

class IngresosController {
    private $ingresoModel;
    private $horarioModel;
    private $programaModel;
    private $salaModel;
    private $responsableModel;
    private $db; // Propiedad para la conexión de la base de datos

    public function __construct() {
        $this->db = Conexion::getInstance()->getConexion(); // Inicializa la conexión
        $this->ingresoModel = new Ingreso();
        $this->horarioModel = new Horario();
        $this->programaModel = new Programa();
        $this->salaModel = new Sala();
        $this->responsableModel = new Responsable();
    }

    public function registrarIngreso($codigoEstudiante, $nombreEstudiante, $idPrograma, $idSala, $idResponsable, $fechaIngreso, $horaIngreso) {
        $stmt = $this->db->prepare("INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, idSala, idResponsable, fechaIngreso, horaIngreso, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        return $stmt->execute([$codigoEstudiante, $nombreEstudiante, $idPrograma, $idSala, $idResponsable, $fechaIngreso, $horaIngreso]);
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

    public function guardar() {
        session_start();
        $diaActual = date('l');
        $horaActual = date('H:i:s');

        if (!$this->validarHorarioAtencion($diaActual, $horaActual)) {
            $_SESSION['error'] = "Fuera del horario de atención";
            header('Location: ../views/ingresos/crear.php');
            exit;
        }

        $diaEspanol = $this->traducirDia($diaActual);
        if (!$this->horarioModel->salaDisponible($_POST['idSala'], $diaEspanol, $horaActual)) {
            $_SESSION['error'] = "La sala no está disponible en este momento";
            header('Location: ../views/ingresos/crear.php');
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

        if ($this->ingresoModel->registrarIngreso($datos)) {
            $_SESSION['success'] = "Ingreso registrado correctamente";
            header('Location: ../public/index.php?mensaje=ingreso_registrado'); // Cambiado para redirigir a la carpeta public
            exit;
        } else {
            $_SESSION['error'] = "Error al registrar el ingreso";
            header('Location: ../views/ingresos/crear.php');
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

    public function registrarSalida() {
        session_start();

        if (!isset($_POST['id'])) {
            $_SESSION['error'] = "ID de ingreso no proporcionado";
            header('Location: ../views/ingresos/lista.php');
            exit;
        }

        $horaSalida = date('H:i:s');
        if (!$this->validarHorarioAtencion(date('l'), $horaSalida)) {
            $_SESSION['error'] = "No se puede registrar salida fuera del horario de atención";
            header('Location: ../views/ingresos/lista.php');
            exit;
        }

        if ($this->ingresoModel->registrarSalida($_POST['id'], $horaSalida)) {
            $_SESSION['success'] = "Salida registrada correctamente";
        } else {
            $_SESSION['error'] = "Error al registrar la salida";
        }

        header('Location: ../views/ingresos/lista.php');
        exit;
    }

    public function obtenerPorId($id) {
        return $this->ingresoModel->obtenerIngresoPorId($id);
    }
}
