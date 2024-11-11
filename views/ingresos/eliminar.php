<?php
require_once '../../config/conexion.php';
require_once '../../controllers/IngresosController.php';

$ingresosController = new IngresosController($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Aquí deberías implementar la lógica para eliminar el ingreso
    // Por ejemplo, podrías agregar un método en IngresosController para manejar la eliminación
    // $ingresosController->eliminarIngreso($id);
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
    <p>¿Estás seguro de que deseas eliminar este ingreso?</p>
    <a href="lista.php">Cancelar</a>
</body>
</html>
