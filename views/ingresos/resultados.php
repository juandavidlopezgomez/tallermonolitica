<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
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
            <p class="no-results">No se encontraron resultados.</p>
        <?php endif; ?>

        <a href="?controller=consultas&action=index" class="btn btn-secondary">Volver a la consulta</a>
    </div>
</body>
</html>

