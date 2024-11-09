<?php
require_once __DIR__ . '/../controllers/IngresosController.php';
require_once __DIR__ . '/../controllers/ConsultasController.php';

// Activar la visualización de errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Enrutador simple
$controller = $_GET['controller'] ?? 'ingresos';
$action = $_GET['action'] ?? 'listar';

switch($controller) {
    case 'ingresos':
        $controllerObj = new IngresosController();
        break;
    case 'consultas':
        $controllerObj = new ConsultasController();
        break;
    default:
        echo "Controlador no encontrado: " . htmlspecialchars($controller);
        exit;
}

if (method_exists($controllerObj, $action)) {
    $controllerObj->$action();
} else {
    echo "Acción no encontrada: " . htmlspecialchars($action);
}
?>