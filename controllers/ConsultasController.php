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

    // Mostrar formulario para la consulta
    public function mostrarFormulario() {
        $programas = $this->programaModel->obtenerTodos();
        $responsables = $this->responsableModel->obtenerTodos();
        require_once __DIR__ . '/../views/ingresos/consulta.php';
    }

    // Método para obtener todos los programas
    public function obtenerProgramas() {
        return $this->programaModel->obtenerTodos();
    }

    // Método para obtener todos los responsables
    public function obtenerResponsables() {
        return $this->responsableModel->obtenerTodos();
    }

    // Método para obtener todas las salas
    public function obtenerSalas() {
        return $this->salaModel->obtenerTodas();
    }

    // Método para consultar ingresos por rango de fechas
    public function consultarPorRango($fechaInicio, $fechaFin) {
        return $this->ingresoModel->obtenerIngresosPorRango($fechaInicio, $fechaFin);
    }

    // Método para consultar ingresos con filtros específicos
    public function consultarPorFiltros($filtros) {
        return $this->ingresoModel->buscarPorFiltros($filtros);
    }
}
