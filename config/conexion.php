<?php
// config/conexion.php

class Conexion {
    private static $host = 'localhost';  // Cambia esto por tu host de base de datos
    private static $dbName = 'ingresos_salas_db';  // Cambia esto por el nombre de tu base de datos
    private static $username = 'root';  // Cambia esto por tu usuario de base de datos
    private static $password = '';  // Cambia esto por tu contraseña de base de datos
    private static $conn = null;

    public static function conectar() {
        // Si la conexión no ha sido establecida aún
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8mb4",
                    self::$username,
                    self::$password
                );
                // Configurar el modo de error de PDO para lanzar excepciones
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Si ocurre un error, muestra el mensaje y detiene la ejecución
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>
