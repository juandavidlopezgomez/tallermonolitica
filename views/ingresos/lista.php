<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Ingresos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="listado-ingresos">
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
                        <th>Acciones</th>
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
                            <td class="acciones">
                                <a href="?controller=ingresos&action=editar&id=<?php echo $ingreso['id']; ?>" 
                                   class="btn btn-edit">Editar</a>
                                <a href="?controller=ingresos&action=eliminar&id=<?php echo $ingreso['id']; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="no-results">No hay ingresos registrados en la base de datos.</p>
            <?php endif; ?>
            <a href="?controller=ingresos&action=crear" class="btn btn-new">Registrar Nuevo Ingreso</a>
        </div>
    </div>
</body>
</html>