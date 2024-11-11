<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';

$controller = new IngresosController();
$ingreso = $controller->obtenerIngreso($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->eliminar($_GET['id']);
    header("Location: lista.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Ingreso</title>
</head>
<body>
    <h1>Eliminar Ingreso</h1>
    <p>¿Estás seguro de que deseas eliminar el ingreso de <?= $ingreso['nombreEstudiante'] ?>?</p>
    <form method="POST">
        <button type="submit">Confirmar Eliminación</button>
        <a href="lista.php">Cancelar</a>
    </form>
</body>
</html>
