<?php
require_once __DIR__ . '/../models/Ingreso.php';
require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/Responsable.php';

class ConsultasController {
    private $ingresoModel;
    private $programaModel;
    private $responsableModel;

    public function __construct() {
        $this->ingresoModel = new Ingreso();
        $this->programaModel = new Programa();
        $this->responsableModel = new Responsable();
    }

    public function mostrarFormulario() {
        $programas = $this->programaModel->obtenerTodos();
        $responsables = $this->responsableModel->obtenerTodos();
        require_once __DIR__ . '/../views/ingresos/consulta.php';
    }

    public function consultarPorRango() {
        $fechaInicio = $_POST['fechaInicio'] ?? date('Y-m-d');
        $fechaFin = $_POST['fechaFin'] ?? date('Y-m-d');
        
        $ingresos = $this->ingresoModel->obtenerIngresosPorRango($fechaInicio, $fechaFin);
        require_once __DIR__ . '/../views/ingresos/resultados.php';
    }

    public function consultarPorFiltros() {
        $filtros = [
            'codigoEstudiante' => $_POST['codigoEstudiante'] ?? '',
            'idPrograma' => $_POST['idPrograma'] ?? '',
            'idResponsable' => $_POST['idResponsable'] ?? ''
        ];
        
        $ingresos = $this->ingresoModel->buscarPorFiltros($filtros);
        require_once __DIR__ . '/../views/ingresos/resultados.php';
    }

    public function obtenerProgramas() {
        return $this->programaModel->obtenerTodos();
    }

    public function obtenerResponsables() {
        return $this->responsableModel->obtenerTodos();
    }
}
?>
