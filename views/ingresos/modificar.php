<!-- views/ingresos/modificar.php -->
<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: lista.php');
    exit;
}

$controller = new IngresosController();
$ingreso = $controller->obtenerPorId($_GET['id']);

if (!$ingreso) {
    header('Location: lista.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Ingreso</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modificar Ingreso</h1>
    
    <nav>
    <a href="../index.php">Volver al Menú Principal</a>
</nav>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">
        
        <div>
            <label for="codigoEstudiante">Código Estudiante:</label>
            <input type="text" id="codigoEstudiante" name="codigoEstudiante" 
                   value="<?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?>" 
                   required maxlength="10">
        </div>
        
        <div>
            <label for="nombreEstudiante">Nombre Estudiante:</label>
            <input type="text" id="nombreEstudiante" name="nombreEstudiante" 
                   value="<?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?>" 
                   required>
        </div>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
