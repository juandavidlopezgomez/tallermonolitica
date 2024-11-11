<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "ID de ingreso no proporcionado";
    header('Location: lista.php');
    exit;
}

$controller = new IngresosController();
$ingreso = $controller->obtenerPorId($_GET['id']);

if (!$ingreso) {
    $_SESSION['error'] = "Ingreso no encontrado";
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
        <a href="../menu_principal.php">Volver al Menú Principal</a>
    </nav>

    <form method="POST" action="../../public/actualizar.php">
        <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">
        
        <div>
            <label for="codigoEstudiante">Código Estudiante:</label>
            <input type="text" id="codigoEstudiante" name="codigoEstudiante" value="<?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?>" required>
        </div>
        
        <div>
            <label for="nombreEstudiante">Nombre Estudiante:</label>
            <input type="text" id="nombreEstudiante" name="nombreEstudiante" value="<?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?>" required>
        </div>

        <div>
            <label for="horaSalida">Hora de Salida:</label>
            <input type="time" id="horaSalida" name="horaSalida" value="<?php echo htmlspecialchars($ingreso['horaSalida']); ?>">
        </div>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>


