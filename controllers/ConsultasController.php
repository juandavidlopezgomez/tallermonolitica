<?php
require_once __DIR__ . '/../models/Ingreso.php';
require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/Responsable.php';
require_once __DIR__ . '/../models/Sala.php';

class ConsultasController {
    private $ingresoModel;
    private $programaModel;
    private $responsableModel;
    private $salaModel;

    public function __construct() {
        $this->ingresoModel = new Ingreso();
        $this->programaModel = new Programa();
        $this->responsableModel = new Responsable();
        $this->salaModel = new Sala();
    }

   
    public function mostrarFormulario() {
        $programas = $this->programaModel->obtenerTodos();
        $responsables = $this->responsableModel->obtenerTodos();
        require_once __DIR__ . '/../views/ingresos/consulta.php';
    }

    
    public function obtenerProgramas() {
        return $this->programaModel->obtenerTodos();
    }


    public function obtenerResponsables() {
        return $this->responsableModel->obtenerTodos();
    }

  
    public function obtenerSalas() {
        return $this->salaModel->obtenerTodas();
    }


    public function consultarPorRango($fechaInicio, $fechaFin) {
        return $this->ingresoModel->obtenerIngresosPorRango($fechaInicio, $fechaFin);
    }

    
    public function consultarPorFiltros($filtros) {
        return $this->ingresoModel->buscarPorFiltros($filtros);
    }
}
