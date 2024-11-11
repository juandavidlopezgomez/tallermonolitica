<?php
require_once __DIR__ . '/../../controllers/ConsultasController.php';
session_start();

$controller = new ConsultasController();
$programas = $controller->obtenerProgramas();
$responsables = $controller->obtenerResponsables();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Ingresos</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Consulta de Ingresos</h1>
    
    <nav>
    <a href="../index.php">Volver al Menú Principal</a>
</nav>


    <h2>Consulta por Rango de Fechas</h2>
    <form method="POST" action="resultados.php">
        <input type="hidden" name="tipo_consulta" value="rango">
        <div>
            <label for="fechaInicio">Fecha Inicio:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" required>
        </div>
        <div>
            <label for="fechaFin">Fecha Fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" required>
        </div>
        <button type="submit">Consultar</button>
    </form>

    <h2>Filtros de Búsqueda</h2>
    <form method="POST" action="resultados.php">
        <input type="hidden" name="tipo_consulta" value="filtros">
        <div>
            <label for="codigoEstudiante">Código Estudiante:</label>
            <input type="text" id="codigoEstudiante" name="codigoEstudiante">
        </div>
        <div>
            <label for="idPrograma">Programa:</label>
            <select id="idPrograma" name="idPrograma">
                <option value="">Todos los programas</option>
                <?php foreach ($programas as $programa): ?>
                    <option value="<?php echo $programa['id']; ?>">
                        <?php echo htmlspecialchars($programa['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="idResponsable">Responsable:</label>
            <select id="idResponsable" name="idResponsable">
                <option value="">Todos los responsables</option>
                <?php foreach ($responsables as $responsable): ?>
                    <option value="<?php echo $responsable['id']; ?>">
                        <?php echo htmlspecialchars($responsable['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Buscar</button>
    </form>
</body>
</html>
