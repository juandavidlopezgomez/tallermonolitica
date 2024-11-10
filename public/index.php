<?php
require_once __DIR__ . '/../controllers/IngresosController.php';




$controller = new IngresosController();

// Ejemplo de cómo registrar un ingreso
$data = [
    'codigo' => '12345',
    'nombre' => 'Juan Perez',
    'programa' => 'Ingeniería de Sistemas',
    'fechaIngreso' => '2023-11-09',
    'horaIngreso' => '08:00',
    'idSala' => 1,
    'responsable' => 'Admin'
];
$controller->registrarIngreso($data);

// Listar ingresos del día actual
$ingresosHoy = $controller->listarIngresosDiaActual();
print_r($ingresosHoy);

// Buscar ingresos por rango de fecha
$ingresosRango = $controller->buscarPorRangoFecha('2023-11-01', '2023-11-09');
print_r($ingresosRango);

// Filtrar ingresos
$ingresosFiltrados = $controller->filtrar('programa', 'Ingeniería de Sistemas');
print_r($ingresosFiltrados);
?>
