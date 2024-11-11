<?php
require_once __DIR__ . '/../controllers/IngresosController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEstudiante = $_POST['codigoEstudiante'];
    $nombreEstudiante = $_POST['nombreEstudiante'];
    $idPrograma = $_POST['idPrograma'];
    $idSala = $_POST['idSala'];
    $idResponsable = $_POST['idResponsable'];
    $fechaIngreso = $_POST['fechaIngreso'];
    $horaIngreso = $_POST['horaIngreso'];
    $periodoHoraIngreso = $_POST['periodoHoraIngreso'];

    $horaIngresoFormato24 = date("H:i", strtotime("$horaIngreso $periodoHoraIngreso"));

    $controller = new IngresosController();
    $resultado = $controller->registrarIngreso($codigoEstudiante, $nombreEstudiante, $idPrograma, $idSala, $idResponsable, $fechaIngreso, $horaIngresoFormato24);

    if ($resultado) {
        header("Location: ../index.php?mensaje=ingreso_registrado");
        exit;
    } else {
        echo "Error al registrar el ingreso. Inténtelo de nuevo.";
    }
}
?>