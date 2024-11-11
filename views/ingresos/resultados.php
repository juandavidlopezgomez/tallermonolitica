<?php
// views/ingresos/resultados.php
require_once __DIR__ . '/../../controllers/ConsultasController.php';
session_start();

$controller = new ConsultasController();
$ingresos = [];

if ($_POST['tipo_consulta'] === 'rango') {
    $fechaInicio = $_POST['fechaInicio'] ?? null;
    $fechaFin = $_POST['fechaFin'] ?? null;

    if ($fechaInicio && $fechaFin) {
        $ingresos = $controller->consultarPorRango($fechaInicio, $fechaFin);
    } else {
        echo "Por favor ingrese ambas fechas.";
        exit;
    }
} elseif ($_POST['tipo_consulta'] === 'filtros') {
    $filtros = [
        'codigoEstudiante' => $_POST['codigoEstudiante'] ?? null,
        'idPrograma' => $_POST['idPrograma'] ?? null,
        'idResponsable' => $_POST['idResponsable'] ?? null
    ];
    $ingresos = $controller->consultarPorFiltros($filtros);
}

// Asegúrate de que `$ingresos` tiene datos antes de mostrar la tabla
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Resultados de la Consulta de Ingresos</h1>
        </header>

        <nav>
            <a href="consulta.php">Nueva Consulta</a> |
            <a href="lista.php">Volver a la Lista</a>
        </nav>

        <?php if (empty($ingresos)): ?>
            <p class="no-records">No se encontraron registros.</p>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Estudiante</th>
                            <th>Programa</th>
                            <th>Fecha</th>
                            <th>Hora Ingreso</th>
                            <th>Hora Salida</th>
                            <th>Sala</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ingresos as $ingreso): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?></td>
                                <td><?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?></td>
                                <td><?php echo htmlspecialchars($ingreso['programa']); ?></td>
                                <td><?php echo htmlspecialchars($ingreso['fechaIngreso']); ?></td>
                                <td><?php echo htmlspecialchars($ingreso['horaIngreso']); ?></td>
                                <td><?php echo $ingreso['horaSalida'] ? htmlspecialchars($ingreso['horaSalida']) : 'No registrada'; ?></td>
                                <td><?php echo htmlspecialchars($ingreso['sala']); ?></td>
                                <td><?php echo htmlspecialchars($ingreso['responsable']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
