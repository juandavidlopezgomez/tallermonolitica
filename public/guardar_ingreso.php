<?php

// public/guardar_ingreso.php
require_once __DIR__ . '/../controllers/IngresosController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEstudiante = trim($_POST['codigoEstudiante']);
    $nombreEstudiante = trim($_POST['nombreEstudiante']);
    $idPrograma = (int) $_POST['idPrograma'];
    $idSala = (int) $_POST['idSala'];
    $idResponsable = (int) $_POST['idResponsable'];
    $fechaIngreso = $_POST['fechaIngreso'];
    $horaIngreso = $_POST['horaIngreso'];
    $periodoHoraIngreso = $_POST['periodoHoraIngreso'];

    // Convert the 12-hour format to 24-hour
    $horaIngresoFormato24 = date("H:i", strtotime("$horaIngreso $periodoHoraIngreso"));

    // Validation: Check for required fields
    if (!$codigoEstudiante || !$nombreEstudiante || !$idPrograma || !$idSala || !$idResponsable || !$fechaIngreso) {
        echo "<script>alert('Todos los campos son obligatorios. Verifique los datos.'); window.history.back();</script>";
        exit;
    }

    // Process registration
    $controller = new IngresosController();
    $resultado = $controller->registrarIngreso(
        $codigoEstudiante, 
        $nombreEstudiante, 
        $idPrograma, 
        $idSala, 
        $idResponsable, 
        $fechaIngreso, 
        $horaIngresoFormato24
    );

    if ($resultado) {
        // Success alert
        echo "<script>alert('Registro guardado con éxito.'); window.location.href = 'index.php';</script>";
    } else {
        // Error alert
        echo "<script>alert('Error al registrar el ingreso. Inténtelo de nuevo.'); window.history.back();</script>";
    }
}
