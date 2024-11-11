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
        $ingresos = $this->ingresoModel->obtenerIngresosPorFecha(date('Y-m-d'));
        require_once __DIR__ . '/../views/ingresos/lista.php';
    }

    public function crear() {
        $programas = $this->programaModel->obtenerTodos();
        $salas = $this->salaModel->obtenerTodas();
        $responsables = $this->responsableModel->obtenerTodos();
        require_once __DIR__ . '/../views/ingresos/crear.php';
    }

    public function guardar() {
        $horaActual = date('H:i:s');
        $diaActual = date('l');
        
        // Validar horario de atención
        if (!$this->validarHorarioAtencion($diaActual, $horaActual)) {
            $_SESSION['error'] = "Fuera del horario de atención";
            header('Location: index.php?controller=ingresos&action=crear');
            return;
        }

        // Validar disponibilidad de sala
        if (!$this->horarioModel->salaDisponible($_POST['idSala'], $diaActual, $horaActual)) {
            $_SESSION['error'] = "La sala no está disponible en este momento";
            header('Location: index.php?controller=ingresos&action=crear');
            return;
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
            $_SESSION['success'] = "Ingreso registra