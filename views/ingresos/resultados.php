<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta</title>
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
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Resultados de la Búsqueda</h2>
    
    <?php if (!empty($resultados)): ?>
        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Programa</th>
                <th>Sala</th>
                <th>Responsable</th>
                <th>Fecha Ingreso</th>
                <th>Hora Ingreso</th>
                <th>Hora Salida</th>
            </tr>
            <?php foreach ($resultados as $resultado): ?>
                <tr>
                    <td><?php echo htmlspecialchars($resultado['codigoEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['nombreEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['nombre_programa']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['nombre_sala']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['nombre_responsable']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['fechaIngreso']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['horaIngreso']); ?></td>
                    <td><?php echo htmlspecialchars($resultado['horaSalida']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>

    <a href="?controller=consultas&action=index" class="back-link">Volver a la consulta</a>
</body>
</html>