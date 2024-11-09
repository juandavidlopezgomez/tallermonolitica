<?php
require_once __DIR__ . '/../controllers/IngresosController.php';
require_once __DIR__ . '/../controllers/ConsultasController.php';

$controller = $_GET['controller'] ?? 'ingresos';
$action = $_GET['action'] ?? 'listar';

switch ($controller) {
    case 'ingresos':
        $controllerObj = new IngresosController();
        break;
    case 'consultas':
        $controllerObj = new ConsultasController();
        break;
    default:
        echo "Controlador no encontrado";
        exit;
}

if (method_exists($controllerObj, $action)) {
    $controllerObj->$action();
} else {
    echo "Acción no encontrada";
}
?>
