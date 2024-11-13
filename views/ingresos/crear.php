<!-- views/ingresos/crear.php -->
<?php
require_once __DIR__ . '/../../controllers/ConsultasController.php';
session_start();

$controller = new ConsultasController();
$programas = $controller->obtenerProgramas();
$responsables = $controller->obtenerResponsables();
$salas = $controller->obtenerSalas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Ingreso</title>
    <link rel="stylesheet" href="../../public/css/styles.css">

</head>
<body>
    <div class="container">
        <h1>Registrar Nuevo Ingreso</h1>
        <a href="../../public/index.php" class="back-link">Volver al Menú Principal</a>

        <form action="../../public/guardar_ingreso.php" method="POST" class="form-grid">
            <div class="form-group">
                <label for="codigoEstudiante">Código Estudiante:</label>
                <input type="text" name="codigoEstudiante" id="codigoEstudiante" required>
            </div>

            <div class="form-group">
                <label for="nombreEstudiante">Nombre Estudiante:</label>
                <input type="text" name="nombreEstudiante" id="nombreEstudiante" required>
            </div>

            <div class="form-group">
                <label for="idPrograma">Programa:</label>
                <select name="idPrograma" id="idPrograma" required>
                    <option value="">Seleccione un programa</option>
                    <?php foreach ($programas as $programa): ?>
                        <option value="<?php echo $programa['id']; ?>">
                            <?php echo htmlspecialchars($programa['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idSala">Sala:</label>
                <select name="idSala" id="idSala" required>
                    <option value="">Seleccione una sala</option>
                    <?php foreach ($salas as $sala): ?>
                        <option value="<?php echo $sala['id']; ?>">
                            <?php echo htmlspecialchars($sala['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idResponsable">Responsable:</label>
                <select name="idResponsable" id="idResponsable" required>
                    <option value="">Seleccione un responsable</option>
                    <?php foreach ($responsables as $responsable): ?>
                        <option value="<?php echo $responsable['id']; ?>">
                            <?php echo htmlspecialchars($responsable['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fechaIngreso">Fecha de Ingreso:</label>
                <input type="date" name="fechaIngreso" id="fechaIngreso" required>
            </div>

            <div class="form-group">
                <label for="horaIngreso">Hora de Ingreso:</label>
                <input type="time" name="horaIngreso" id="horaIngreso" required>
                <select name="periodoHoraIngreso">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>

            <div class="form-group full-width">
                <input type="submit" value="Registrar Ingreso">
            </div>
        </form>
    </div>
</body>
</html>
