<?php
// controllers/IngresosController.php

// controllers/IngresosController.php

require_once '../models/Programa.php';
require_once '../models/Responsable.php';
require_once '../models/Sala.php';
require_once '../models/Horario.php';
require_once '../models/Ingreso.php';

class IngresosController {

    private $programaModel;
    private $responsableModel;
    private $salaModel;
    private $horarioModel;
    private $ingresoModel;

    public function __construct() {
        // Instanciar los modelos de cada tabla
        $this->programaModel = new Programa();
        $this->responsableModel = new Responsable();
        $this->salaModel = new Sala();
        $this->horarioModel = new Horario();
        $this->ingresoModel = new Ingreso();
    }

    public function crear() {
        // Obtener listas de programas, responsables y salas
        $programas = $this->programaModel->obtenerTodos();
        $responsables = $this->responsableModel->obtenerTodos();
        $salas = $this->salaModel->obtenerTodos();
    
        // Cargar la vista y pasarle los datos
        require '../views/ingresos/crear.php';
    }
    
    // Método para almacenar el registro en la base de datos
    public function store($data) {
        // Validar los datos básicos
        $codigoEstudiante = $data['codigoEstudiante'];
        $nombreEstudiante = $data['nombreEstudiante'];
        $idPrograma = $data['programa'];
        $fechaIngreso = $data['fechaIngreso'];
        $horaIngreso = $data['horaIngreso'] . ' ' . $data['periodoIngreso'];
        $idSala = $data['sala'];
        $idResponsable = $data['responsable'];
        
        // Convertir hora a formato de 24 horas (AM/PM)
        $horaIngreso = date("H:i:s", strtotime($horaIngreso));

        // Verificar si la sala está disponible
        if (!$this->horarioModel->salaDisponible($idSala, $fechaIngreso, $horaIngreso)) {
            echo "Error: La sala no está disponible en este horario.";
            return;
        }

        // Crear el registro de ingreso
        $exito = $this->ingresoModel->crearIngreso(
            $codigoEstudiante,
            $nombreEstudiante,
            $idPrograma,
            $fechaIngreso,
            $horaIngreso,
            $idSala,
            $idResponsable
        );

        if ($exito) {
            echo "Ingreso registrado exitosamente.";
        } else {
            echo "Error: No se pudo registrar el ingreso.";
        }
    }
}
