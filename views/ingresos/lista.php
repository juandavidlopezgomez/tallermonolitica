<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

$controller = new IngresosController();
$ingresos = $controller->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ingresos</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    <h1>Ingresos del Día</h1>
    
    <nav>
        <a href="crear.php">Nuevo Ingreso</a> |
        <a href="consulta.php">Consultar Ingresos</a>
    </nav>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Estudiante</th>
                <th>Programa</th>
                <th>Sala</th>
                <th>Hora Ingreso</th>
                <th>Hora Salida</th>
                <th>Responsable</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingresos as $ingreso): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['programa']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['sala']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['horaIngreso']); ?></td>
                    <td>
                        <?php if ($ingreso['horaSalida']): ?>
                            <?php echo htmlspecialchars($ingreso['horaSalida']); ?>
                        <?php else: ?>
                            <form method="POST" action="../../public/registrar_salida.php">
                                <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">
                                <button type="submit">Registrar Salida</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($ingreso['responsable']); ?></td>
                    <td>
                        <a href="modificar.php?id=<?php echo $ingreso['id']; ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
