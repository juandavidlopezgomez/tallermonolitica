<?php
require_once __DIR__ . '/../../controllers/ConsultasController.php';
session_start();

$controller = new ConsultasController();

if ($_POST['tipo_consulta'] === 'rango') {
    // Obtenemos las fechas de inicio y fin del formulario
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    // Realizamos la consulta por rango de fechas
    $ingresos = $controller->consultarPorRango($fechaInicio, $fechaFin);
} else {
    // Obtenemos los filtros específicos del formulario
    $filtros = [
        'codigoEstudiante' => $_POST['codigoEstudiante'] ?? null,
        'idPrograma' => $_POST['idPrograma'] ?? null,
        'idResponsable' => $_POST['idResponsable'] ?? null,
    ];
    // Realizamos la consulta por filtros
    $ingresos = $controller->consultarPorFiltros($filtros);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    <h1>Resultados de la Consulta</h1>
    
    <nav>
        <a href="consulta.php">Nueva Consulta</a> |
        <a href="../../public/index.php">Volver al Menú Principal</a>
    </nav>

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
            <?php if (!empty($ingresos)): ?>
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
            <?php else: ?>
                <tr>
                    <td colspan="8">No se encontraron resultados para esta consulta.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
