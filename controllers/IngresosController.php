<?php
require_once __DIR__ . '/../models/Ingreso.php';

class IngresosController {
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ingreso = new Ingreso();

            $datos = [
                ':codigoEstudiante' => trim($_POST['codigo']),
                ':nombreEstudiante' => trim($_POST['nombre']),
                ':idPrograma' => trim($_POST['idPrograma']),
                ':idSala' => trim($_POST['idSala']),
                ':idResponsable' => trim($_POST['idResponsable']),
                ':fechaIngreso' => trim($_POST['fechaIngreso']),
                ':horaIngreso' => trim($_POST['horaIngreso']),
                ':horaSalida' => trim($_POST['horaSalida'])
            ];

            if ($ingreso->registrarIngreso($datos)) {
                echo "Ingreso registrado exitosamente.";
            } else {
                echo "Error al registrar el ingreso. Verifica que los IDs de programa, sala y responsable sean correctos.";
            }
        } else {
            require __DIR__ . '/../views/ingresos/crear.php';
        }
    }

    public function listar() {
        $ingreso = new Ingreso();
        $ingresosDelDia = $ingreso->obtenerIngresosDelDia();

        require __DIR__ . '/../views/ingresos/lista.php';
    }
}
?>