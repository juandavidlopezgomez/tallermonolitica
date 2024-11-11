<!-- views/ingresos/crear.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nuevo Ingreso</title>
</head>
<body>
    <div class="container">
        <h1>Registrar Nuevo Ingreso</h1>
        <form action="procesar_crear.php" method="POST">
            <div class="form-group">
                <label for="codigoEstudiante">Código Estudiante:</label>
                <input type="text" name="codigoEstudiante" required>
            </div>
            <div class="form-group">
                <label for="nombreEstudiante">Nombre Estudiante:</label>
                <input type="text" name="nombreEstudiante" required>
            </div>
            <div class="form-group">
                <label for="programa">Programa:</label>
                <select name="programa" required>
                    <option value="">Seleccione un programa</option>
                    <?php foreach ($programas as $programa): ?>
                        <option value="<?= $programa['id'] ?>"><?= htmlspecialchars($programa['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fechaIngreso">Fecha de Ingreso:</label>
                <input type="date" name="fechaIngreso" required>
            </div>
            <div class="form-group">
                <label for="horaIngreso">Hora de Ingreso:</label>
                <input type="time" name="horaIngreso" required>
                <select name="periodoIngreso">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="horaSalida">Hora de Salida:</label>
                <input type="time" name="horaSalida" required>
                <select name="periodoSalida">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sala">Sala:</label>
                <select name="sala" required>
                    <option value="">Seleccione una sala</option>
                    <?php foreach ($salas as $sala): ?>
                        <option value="<?= $sala['id'] ?>"><?= htmlspecialchars($sala['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable:</label>
                <select name="responsable" required>
                    <option value="">Seleccione un responsable</option>
                    <?php foreach ($responsables as $responsable): ?>
                        <option value="<?= $responsable['id'] ?>"><?= htmlspecialchars($responsable['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="justify-content: center;">
                <button type="submit">Registrar</button>
            </div>
        </form>
    </div>
</body>
</html>
