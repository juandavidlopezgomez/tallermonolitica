
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
            <div class="form-group">
                <label>Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label>Fecha Fin:</label>
                <input type="date" name="fecha_fin" required>
            </div>
            <button type="submit" class="btn">Buscar</button>
        </form>

        <h2>Filtrar por:</h2>
        <form method="GET" action="?controller=consultas&action=filtrar">
            <input type="hidden" name="controller" value="consultas">
            <input type="hidden" name="action" value="filtrar">
            <div class="form-group">
                <label>Tipo de Filtro:</label>
                <select name="filtro">
                    <option value="codigo">Código Estudiante</option>
                    <option value="nombre">Nombre Estudiante</option>
                    <option value="programa">Programa</option>
                    <option value="sala">Sala</option>
                </select>
            </div>
            <div class="form-group">
                <label>Valor:</label>
                <input type="text" name="valor" required>
            </div>
            <button type="submit" class="btn">Filtrar</button>
        </form>
    </div>
</body>
</html>