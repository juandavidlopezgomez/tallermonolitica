<?php
require_once __DIR__ . '/../controllers/IngresosController.php';
session_start();

$controller = new IngresosController();
$ingresos = $controller->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de Ingresos</title>
    <link rel="stylesheet" href="css/styles.css?v=1">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Control de Ingresos</h1>
            <h2>Salas de Cómputo</h2>
        </header>

        <nav class="main-nav">
            <ul>
                <li><a href="../views/ingresos/crear.php">Registrar Nuevo Ingreso</a></li>
                <li><a href="../views/ingresos/consulta.php">Consultar Ingresos</a></li>
            </ul>
        </nav>

        <main>
            <section class="ingresos-actuales">
                <h2>Ingresos del Día</h2>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <?php if (empty($ingresos)): ?>
                    <p class="no-records">No hay ingresos registrados para el día de hoy.</p>
                <?php else: ?>
                    <div class="table-container">
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
                                                <form method="POST" action="../public/registrar_salida.php">
                                                <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">
                                                <button type="submit" class="btn-salida">Registrar Salida</button>
                                                 </form>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($ingreso['responsable']); ?></td>
                                        <td>
                                            <a href="../views/ingresos/modificar.php?id=<?php echo $ingreso['id']; ?>" 
                                               class="btn-modificar">Modificar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> Sistema de Control de Ingresos - Salas de Cómputo</p>
        </footer>
    </div>
</body>
</html>
