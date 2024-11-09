<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Ingreso</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Modificar Ingreso</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="?controller=ingresos&action=modificar">
            <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
            
            <div class="form-group">
                <label>Código Estudiante:</label>
                <input type="text" name="codigo" value="<?php echo htmlspecialchars($datos['codigoEstudiante']); ?>" required>
            </div>

            <div class="form-group">
                <label>Nombre Estudiante:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($datos['nombreEstudiante']); ?>" required>
            </div>
            
            <!-- Campos de solo lectura -->
            <div class="form-group">
                <label>Programa:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['nombre_programa']); ?>" readonly>
            </div>
            
            <div class="form-group">
                <label>Sala:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['nombre_sala']); ?>" readonly>
            </div>
            
            <div class="form-group">
                <label>Fecha de Ingreso:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['fechaIngreso']); ?>" readonly>
            </div>

            <div class="form-group">
                <label>Hora de Ingreso:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['horaIngreso']); ?>" readonly>
            </div>

            <div class="form-group">
                <label>Hora de Salida:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['horaSalida']); ?>" readonly>
            </div>

            <div class="form-group">
                <label>Fecha de Creación:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['fecha_creacion']); ?>" readonly>
            </div>

            <?php if (!empty($datos['fecha_modificacion'])): ?>
            <div class="form-group">
                <label>Última Modificación:</label>
                <input type="text" value="<?php echo htmlspecialchars($datos['fecha_modificacion']); ?>" readonly>
            </div>
            <?php endif; ?>

            <button type="submit" class="btn">Guardar Cambios</button>
            <a href="?controller=ingresos&action=listar" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>