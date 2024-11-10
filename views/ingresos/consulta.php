<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Ingresos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Consulta por Rango de Fechas</h2>
        <form method="POST" action="?controller=consultas&action=buscarPorFecha">
            <label>Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" required>
            <label>Fecha Fin:</label>
            <input type="date" name="fecha_fin" required>
            <button type="submit">Buscar</button>
        </form>
    </div>
</body>
</html>
