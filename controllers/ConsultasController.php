<?php
// controllers/ConsultasController.php

require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/Responsable.php';
require_once __DIR__ . '/../models/Sala.php';

class ConsultasController {
    private $programaModel;
    private $responsableModel;
    private $salaModel;

    public function __construct() {
        $this->programaModel = new Programa();
        $this->responsableModel = new Responsable();
        $this->salaModel = new Sala();
    }

    // Obtener todos los programas
    public function obtenerProgramas() {
        return $this->programaModel->obtenerTodos();
    }

    // Obtener todos los responsables
    public function obtenerResponsables() {
        return $this->responsableModel->obtenerTodos();
    }

    // Obtener todas las salas
    public function obtenerSalas() {
        return $this->salaModel->obtenerTodos();
    }
}
?>
