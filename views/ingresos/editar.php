<?php
require_once __DIR__ . '/../../controllers/IngresosController.php';
session_start();

$controller = new IngresosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $codigoEstudiante = $_POST['codigoEstudiante'];
    $nombreEstudiante = $_POST['nombreEstudiante'];

   
    $resultado = $controller->actualizarIngreso($id, $codigoEstudiante, $nombreEstudiante);

    if ($resultado) {
        $_SESSION['mensaje'] = "Modificación exitosa";
    } else {
        $_SESSION['mensaje'] = "Error al modificar";
    }


    header('Location: lista.php');
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "ID de ingreso no proporcionado";
    header('Location: lista.php');
    exit;
}

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
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    <h1>Modificar Ingreso</h1>
    <form method="POST" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $ingreso['id']; ?>">
        
        <div>
            <label for="codigoEstudiante">Código Estudiante:</label>
            <input type="text" id="codigoEstudiante" name="codigoEstudiante" value="<?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?>" required>
        </div>
        
        <div>
            <label for="nombreEstudiante">Nombre Estudiante:</label>
            <input type="text" id="nombreEstudiante" name="nombreEstudiante" value="<?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?>" required>
        </div>

        <button type="submit">Guardar Cambios</button>
    </form>

 
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="popup">
            <p><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
            <button onclick="cerrarPopup()">Cerrar</button>
        </div>
    <?php endif; ?>
</body>
<script>
    function cerrarPopup() {
        document.querySelector('.popup').style.display = 'none';
    }
</script>
</html>