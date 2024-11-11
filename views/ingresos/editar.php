<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';

$controller = new IngresosController();
$ingreso = $controller->obtenerIngreso($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizar($_GET['id'], $_POST);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ingreso</title>
</head>
<body>
    <h1>Editar Ingreso</h1>
    <form action="editar.php?id=<?= $ingreso['id'] ?>" method="POST">
        <label for="codigoEstudiante">Código Estudiante:</label>
        <input type="text" name="codigoEstudiante" value="<?= $ingreso['codigoEstudiante'] ?>" required>
        
        <label for="nombreEstudiante">Nombre Estudiante:</label>
        <input type="text" name="nombreEstudiante" value="<?= $ingreso['nombreEstudiante'] ?>" required>
        
        <label for="idPrograma">Programa:</label>
        <input type="number" name="idPrograma" value="<?= $ingreso['idPrograma'] ?>" required>
        
        <label for="fechaIngreso">Fecha de Ingreso:</label>
        <input type="date" name="fechaIngreso" value="<?= $ingreso['fechaIngreso'] ?>" required>
        
        <label for="horaIngreso">Hora de Ingreso:</label>
        <input type="time" name="horaIngreso" value="<?= $ingreso['horaIngreso'] ?>" required>
        
        <label for="idResponsable">Responsable:</label>
        <input type="number" name="idResponsable" value="<?= $ingreso['idResponsable'] ?>" required>
        
        <label for="idSala">Sala:</label>
        <input type="number" name="idSala" value="<?= $ingreso['idSala'] ?>" required>
        
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
