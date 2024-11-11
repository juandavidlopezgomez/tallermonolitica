<?php
require_once 'models/Programa.php';

$programaModel = new Programa();
$programas = $programaModel->obtenerTodos();

echo "<pre>";
print_r($programas);
echo "</pre>";
