
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Ingreso</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Ingreso a la Sala</h2>
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
            
            <button type="submit" class="btn">Registrar Ingreso</button>
        </form>
        
        <a href="?controller=ingresos&action=listar" class="btn btn-secondary">Ver Ingresos del Día</a>
    </div>
</body>
</html>