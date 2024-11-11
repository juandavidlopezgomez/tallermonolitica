<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

$controller = new IngresosController();
$programas = $controller->obtenerProgramas();
$salas = $controller->obtenerSalas();
$responsables = $controller->obtenerResponsables();

$diaActual = date('Y-m-d');
$horaActual = date('h:i'); // Formato 12 horas sin AM/PM
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Ingreso</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Registrar Nuevo Ingreso</h1>

    <nav>
        <a href="../../index.php">Volver al Menú Principal</a>
    </nav>

    <form method="POST" action="../../public/guardar_ingreso.php">
        <div>
            <label for="codigoEstudiante">Código Estudiante:</label>
            <input type="text" id="codigoEstudiante" name="codigoEstudiante" required maxlength="10">
        </div>

        <div>
            <label for="nombreEstudiante">Nombre Estudiante:</label>
            <input type="text" id="nombreEstudiante" name="nombreEstudiante" required>
        </div>

        <div>
            <label for="idPrograma">Programa:</label>
            <select id="idPrograma" name="idPrograma" required>
                <option value="">Seleccione un programa</option>
                <?php foreach ($programas as $programa): ?>
                    <option value="<?php echo $programa['id']; ?>"><?php echo htmlspecialchars($programa['nombre']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="idSala">Sala:</label>
            <select id="idSala" name="idSala" required>
                <option value="">Seleccione una sala</option>
                <?php foreach ($salas as $sala): ?>
                    <option value="<?php echo $sala['id']; ?>"><?php echo htmlspecialchars($sala['nombre']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="idResponsable">Responsable:</label>
            <select id="idResponsable" name="idResponsable" required>
                <option value="">Seleccione un responsable</option>
                <?php foreach ($responsables as $responsable): ?>
                    <option value="<?php echo $responsable['id']; ?>"><?php echo htmlspecialchars($responsable['nombre']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="fechaIngreso">Fecha de Ingreso:</label>
            <input type="date" id="fechaIngreso" name="fechaIngreso" value="<?php echo $diaActual; ?>" required>
        </div>

        <div>
            <label for="horaIngreso">Hora de Ingreso:</label>
            <input type="text" id="horaIngreso" name="horaIngreso" value="<?php echo $horaActual; ?>" placeholder="HH:MM" required>
            <select name="periodoHoraIngreso">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>
        </div>

        <div>
            <button type="submit">Registrar Ingreso</button>
        </div>
    </form>
</body>
</html>
