<?php
// public/index.php
require_once __DIR__ . '/../controllers/IngresosController.php';

$controller = new IngresosController();
$ingresos = $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ingresos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Ingresos a las Salas</h1>
    <a href="../views/ingresos/crear.php">Registrar Ingreso</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Código Estudiante</th>
            <th>Nombre Estudiante</th>
            <th>Programa</th>
            <th>Fecha</th>
            <th>Hora de Ingreso</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($ingresos as $ingreso): ?>
            <tr>
                <td><?= $ingreso['id'] ?></td>
                <td><?= $ingreso['codigoEstudiante'] ?></td>
                <td><?= $ingreso['nombreEstudiante'] ?></td>
                <td><?= $ingreso['idPrograma'] ?></td>
                <td><?= $ingreso['fechaIngreso'] ?></td>
                <td><?= $ingreso['horaIngreso'] ?></td>
                <td>
                    <a href="../views/ingresos/editar.php?id=<?= $ingreso['id'] ?>">Editar</a> |
                    <a href="../views/ingresos/eliminar.php?id=<?= $ingreso['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
