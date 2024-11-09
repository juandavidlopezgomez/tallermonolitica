<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Ingresos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .add-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .add-link:hover {
            background-color: #45a049;
        }
        .total-registros {
            margin-top: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Listado de Todos los Ingresos</h2>
    <?php if (!empty($ingresosDelDia)): ?>
        <p class="total-registros">Total de registros: <?php echo count($ingresosDelDia); ?></p>
        <table>
            <tr>
                <th>Código Estudiante</th>
                <th>Nombre Estudiante</th>
                <th>Programa</th>
                <th>Sala</th>
                <th>Responsable</th>
                <th>Fecha de Ingreso</th>
                <th>Hora de Ingreso</th>
                <th>Hora de Salida</th>
            </tr>
            <?php foreach ($ingresosDelDia as $ingreso): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombre_programa']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombre_sala']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombre_responsable']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['fechaIngreso']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['horaIngreso']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['horaSalida']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay ingresos registrados en la base de datos.</p>
    <?php endif; ?>

    <br>
    <a href="?controller=ingresos&action=crear" class="add-link">Registrar Nuevo Ingreso</a>
</body>
</html>