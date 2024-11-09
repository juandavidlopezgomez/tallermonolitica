<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ingreso</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="editar-form">
            <h2>Editar Ingreso</h2>
            <form method="POST" action="?controller=ingresos&action=editar">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($datos['id']); ?>">
                
                <div class="form-group">
                    <label>Código Estudiante:</label>
                    <input type="text" name="codigo" value="<?php echo htmlspecialchars($datos['codigoEstudiante']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Nombre Estudiante:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($datos['nombreEstudiante']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Programa:</label>
                    <select name="idPrograma" required>
                        <?php foreach($programas as $programa): ?>
                            <option value="<?php echo $programa['id']; ?>" 
                                <?php echo ($programa['id'] == $datos['idPrograma']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($programa['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Sala:</label>
                    <select name="idSala" required>
                        <?php foreach($salas as $sala): ?>
                            <option value="<?php echo $sala['id']; ?>"
                                <?php echo ($sala['id'] == $datos['idSala']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($sala['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Responsable:</label>
                    <select name="idResponsable" required>
                        <?php foreach($responsables as $responsable): ?>
                            <option value="<?php echo $responsable['id']; ?>"
                                <?php echo ($responsable['id'] == $datos['idResponsable']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($responsable['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fecha de Ingreso:</label>
                    <input type="date" name="fechaIngreso" value="<?php echo htmlspecialchars($datos['fechaIngreso']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Hora de Ingreso:</label>
                    <input type="time" name="horaIngreso" value="<?php echo htmlspecialchars($datos['horaIngreso']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Hora de Salida:</label>
                    <input type="time" name="horaSalida" value="<?php echo htmlspecialchars($datos['horaSalida']); ?>" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-actualizar">Actualizar Ingreso</button>
                    <a href="?controller=ingresos&action=listar" class="btn btn-cancelar">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
