<?php
if (!isset($resultados)) {
    echo "No hay resultados para mostrar.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta</title>
</head>
<body>
    <h1>Resultados de la Consulta</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Código Estudiante</th>
            <th>Nombre Estudiante</th>
            <th>Programa</th>
            <th>Fecha</th>
            <th>Hora de Ingreso</th>
        </tr>
        <?php foreach ($resultados as $ingreso): ?>
            <tr>
                <td><?= $ingreso['id'] ?></td>
                <td><?= $ingreso['codigoEstudiante'] ?></td>
                <td><?= $ingreso['nombreEstudiante'] ?></td>
                <td><?= $ingreso['idPrograma'] ?></td>
                <td><?= $ingreso['fechaIngreso'] ?></td>
                <td><?= $ingreso['horaIngreso'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
