<!-- views/ingresos/crear.php -->
<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

$controller = new IngresosController();
$programas = $controller->obtenerProgramas();
$salas = $controller->obtenerSalas();
$responsables = $controller->obtenerResponsables();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Ingreso</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Registrar Nuevo Ingreso</h1>
    
    <nav>
        <a href="lista.php">Volver a la Lista</a>
    </nav>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="guardar.php">
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
                    <option value="<?php echo $programa['id']; ?>">
                        <?php echo htmlspecialchars($programa['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label for="idSala">Sala:</label>
            <select id="idSala" name="idSala" required>
                <option value="">Seleccione una sala</option>
                <?php foreach ($salas as $sala): ?>
                    <option value="<?php echo $sala['id']; ?>">
                        <?php echo htmlspecialchars($sala['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label for="idResponsable">Responsable:</label>
            <select id="idResponsable" name="idResponsable" required>
                <option value="">Seleccione un responsable</option>
                <?php foreach ($responsables as $responsable): ?>
                    <option value="<?php echo $responsable['id']; ?>">
                        <?php echo htmlspecialchars($responsable['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Registrar Ingreso</button>
    </form>
</body>
</html>
