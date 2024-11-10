<?php
require_once __DIR__ . '/../models/Ingreso.php';
require_once __DIR__ . '/../models/Horario.php';

class IngresosController {
    private $model;
    private $horarioModel;

    public function __construct() {
        $this->model = new Ingreso();
        $this->horarioModel = new Horario();
    }

    public function registrarIngreso($data) {
        // Verificar disponibilidad de la sala antes de registrar el ingreso
        if (!$this->horarioModel->verificarDisponibilidad($data['idSala'], $data['fechaIngreso'], $data['horaIngreso'], $data['horaSalida'])) {
            echo "La sala no está disponible en el horario seleccionado.";
            return;
        }

        if ($this->model->registrar($data)) {
            echo "Ingreso registrado exitosamente.";
        } else {
            echo "Error al registrar el ingreso.";
        }
    }

    public function listarIngresosDiaActual() {
        $fechaHoy = date("Y-m-d");
        return $this->model->listarPorFecha($fechaHoy);
    }

    public function buscarPorRangoFecha($fechaInicio, $fechaFin) {
        return $this->model->buscarPorRangoFecha($fechaInicio, $fechaFin);
    }

    public function filtrar($filtro, $valor) {
        return $this->model->filtrar($filtro, $valor);
    }
}
?>
