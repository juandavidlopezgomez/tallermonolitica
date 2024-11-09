<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Ingresos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: inline-block;
            width: 120px;
        }
        input[type="date"], select {
            padding: 5px;
            margin: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
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
            <button type="submit">Buscar</button>
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
            <button type="submit">Filtrar</button>
        </form>
    </div>
</body>
</html>