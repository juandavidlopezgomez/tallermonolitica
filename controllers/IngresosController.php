<?php
// controllers/IngresosController.php

require_once __DIR__ . '/../models/Ingreso.php';

class IngresosController {
    private $model;

    public function __construct() {
        $this->model = new Ingreso();
    }

    // Método para listar todos los ingresos
    public function listar() {
        return $this->model->obtenerTodos();
    }

    // Método para crear un nuevo ingreso
    public function crear($data) {
        $this->model->crear($data);
        header("Location: /views/ingresos/lista.php"); // Redirige a la lista de ingresos
    }

    // Método para obtener un ingreso por su ID (para ver o editar)
    public function obtenerIngreso($id) {
        return $this->model->obtenerPorId($id);
    }

    // Método para actualizar un ingreso existente
    public function actualizar($id, $data) {
        $this->model->actualizar($id, $data);
        header("Location: /views/ingresos/lista.php"); // Redirige a la lista de ingresos
    }

    // Método para eliminar un ingreso
    public function eliminar($id) {
        $this->model->eliminar($id);
        header("Location: /views/ingresos/lista.php"); // Redirige a la lista de ingresos
    }
}
?>
