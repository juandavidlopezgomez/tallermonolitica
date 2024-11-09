<?php
require_once __DIR__ . '/../models/Ingreso.php';

class ConsultasController {
    private $ingreso;

    public function __construct() {
        $this->ingreso = new Ingreso();
    }

    public function index() {
        require __DIR__ . '/../views/ingresos/consulta.php';
    }

    public function buscarPorFecha() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fechaInicio = $_POST['fecha_inicio'];
            $fechaFin = $_POST['fecha_fin'];
            
            $resultados = $this->ingreso->buscarPorRangoFecha($fechaInicio, $fechaFin);
            require __DIR__ . '/../views/ingresos/resultados.php';
        } else {
            require __DIR__ . '/../views/ingresos/consulta.php';
        }
    }
    
    public function filtrar() {
        $filtro = $_GET['filtro'] ?? '';
        $valor = $_GET['valor'] ?? '';
        
        $resultados = $this->ingreso->filtrar($filtro, $valor);
        require __DIR__ . '/../views/ingresos/resultados.php';
    }
}
?>