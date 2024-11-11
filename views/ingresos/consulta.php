<?php
// views/ingresos/consulta.php
require_once __DIR__ . '/../../controllers/IngresosController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new IngresosController();
    $resultados = $controller->listar(); // Aquí podrías aplicar criterios de búsqueda
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Ingresos</title>
</head>
<body>
    <h1>Consultar Ingresos</h1>
    <form action="consulta.php" method="POST">
        <label for="codigoEstudiante">Código de Estudiante:</label>
        <input type="text" name="codigoEstudiante">
        
        <button type="submit">Buscar</button>
    </form>

    <?php if (isset($resultados)): ?>
        <h2>Resultados de la Consulta</h2>
        <ul>
            <?php foreach ($resultados as $ingreso): ?>
                <li><?= $ingreso['codigoEstudiante'] ?> - <?= $ingreso['nombreEstudiante'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
