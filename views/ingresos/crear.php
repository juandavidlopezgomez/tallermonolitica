<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Ingreso</title>
    <style>
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-link {
            margin-top: 20px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Registrar Ingreso a la Sala</h2>
    <?php
        $db = new Conexion();
        $conn = $db->getConnection();
        
        $programas = $conn->query("SELECT id, nombre FROM programas")->fetchAll();
        $salas = $conn->query("SELECT id, nombre FROM salas")->fetchAll();
        $responsables = $conn->query("SELECT id, nombre FROM responsables")->fetchAll();
    ?>
    
    <form method="POST" action="?controller=ingresos&action=crear">
        <div class="form-group">
            <label>Código Estudiante:</label>
            <input type="text" name="codigo" required>
        </div>

        <div class="form-group">
            <label>Nombre Estudiante:</label>
            <input type="text" name="nombre" required>
        </div>
        
        <div class="form-group">
            <label>Programa:</label>
            <select name="idPrograma" required>
                <option value="">Seleccione un programa</option>
                <?php foreach($programas as $programa): ?>
                    <option value="<?= $programa['id'] ?>"><?= $programa['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Sala:</label>
            <select name="idSala" required>
                <option value="">Seleccione una sala</option>
                <?php foreach($salas as $sala): ?>
                    <option value="<?= $sala['id'] ?>"><?= $sala['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Responsable:</label>
            <select name="idResponsable" required>
                <option value="">Seleccione un responsable</option>
                <?php foreach($responsables as $responsable): ?>
                    <option value="<?= $responsable['id'] ?>"><?= $responsable['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Fecha de Ingreso:</label>
            <input type="date" name="fechaIngreso" required>
        </div>

        <div class="form-group">
            <label>Hora de Ingreso:</label>
            <input type="time" name="horaIngreso" required>
        </div>

        <div class="form-group">
            <label>Hora de Salida:</label>
            <input type="time" name="horaSalida" required>
        </div>
        
        <button type="submit">Registrar Ingreso</button>
    </form>
    
    <a href="?controller=ingresos&action=listar" class="back-link">Ver Ingresos del Día</a>
</body>
</html>