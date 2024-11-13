<?php
// archivo: public/registrar_salida.php

require_once __DIR__ . '/../controllers/IngresosController.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $controller = new IngresosController();

    // Llama al método registrarSalida y verifica el resultado
    if ($controller->registrarSalida($id)) {
        $_SESSION['success'] = 'Hora de salida registrada con éxito.';
    } else {
        $_SESSION['error'] = 'Error al registrar la hora de salida.';
    }

    // Redirige de vuelta a la lista después de la operación
    header('Location: ../views/ingresos/lista.php');
    exit;
} else {
    $_SESSION['error'] = 'Solicitud inválida.';
    header('Location: ../views/ingresos/lista.php');
    exit;
}
