<?php
class Conexion {
    private static $instance = null;
    private $conexion;

    private function __construct() {
        try {
            $this->conexion = new PDO(
                "mysql:host=localhost;dbname=ingresos_salas_db",
                "root",
                "",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            error_log("Creando nueva instancia de Conexion"); 
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConexion() {
        return $this->conexion;
    }
}
?>
