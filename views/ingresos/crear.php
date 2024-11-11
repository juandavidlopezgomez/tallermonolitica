<!-- views/ingresos/crear.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Ingreso</title>
    <link rel="stylesheet" href="../../public/css/styles.css"> <!-- Link to the main CSS file -->
</head>
<body>
    <div class="container">
        <h1>Registrar Nuevo Ingreso</h1>
        <a href="../../public/index.php" class="back-link">Volver al Menú Principal</a> <!-- Back to Main Menu link -->

        <form action="../../public/guardar_ingreso.php" method="POST">
            <label for="codigoEstudiante">Código Estudiante:</label>
            <input type="text" name="codigoEstudiante" id="codigoEstudiante" required>

            <label for="nombreEstudiante">Nombre Estudiante:</label>
            <input type="text" name="nombreEstudiante" id="nombreEstudiante" required>

            <label for="idPrograma">Programa:</label>
            <select name="idPrograma" id="idPrograma" required>
                <option value="">Seleccione un programa</option>
                <!-- Add your options here -->
            </select>

            <label for="idSala">Sala:</label>
            <select name="idSala" id="idSala" required>
                <option value="">Seleccione una sala</option>
                <!-- Add your options here -->
            </select>

            <label for="idResponsable">Responsable:</label>
            <select name="idResponsable" id="idResponsable" required>
                <option value="">Seleccione un responsable</option>
                <!-- Add your options here -->
            </select>

            <label for="fechaIngreso">Fecha de Ingreso:</label>
            <input type="date" name="fechaIngreso" id="fechaIngreso" required>

            <label for="horaIngreso">Hora de Ingreso:</label>
            <input type="time" name="horaIngreso" id="horaIngreso" required>
            <select name="periodoHoraIngreso">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>

            <input type="submit" value="Registrar Ingreso">
        </form>
    </div>
</body>
</html>
