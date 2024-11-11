<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../controllers/IngresosController.php';
    $controller = new IngresosController();
    $controller->crear($_POST);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Ingreso</title>
</head>
<body>
    <h1>Registrar Nuevo Ingreso</h1>
    <form action="crear.php" method="POST">
        <label for="codigoEstudiante">Código Estudiante:</label>
        <input type="text" name="codigoEstudiante" required>
        
        <label for="nombreEstudiante">Nombre Estudiante:</label>
        <input type="text" name="nombreEstudiante" required>
        
        <label for="idPrograma">Programa:</label>
        <input type="number" name="idPrograma" required>
        
        <label for="fechaIngreso">Fecha de Ingreso:</label>
        <input type="date" name="fechaIngreso" required>
        
        <label for="horaIngreso">Hora de Ingreso:</label>
        <input type="time" name="horaIngreso" required>
        
        <label for="idResponsable">Responsable:</label>
        <input type="number" name="idResponsable" required>
        
        <label for="idSala">Sala:</label>
        <input type="number" name="idSala" required>
        
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
