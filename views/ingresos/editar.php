<!-- views/ingresos/editar.php -->
<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: lista.php');
    exit;
}

$controller = new IngresosController();
$resultado = $controller->actualizar($_POST['id'], $_POST['codigoEstudiante'], $_POST['nombreEstudiante']);

if ($resultado) {
    $_SESSION['success'] = "Ingreso actualizado correctamente";
} else {
    $_SESSION['error'] = "Error al actualizar el ingreso";
}

header('Location: lista.php');
exit;
?>
