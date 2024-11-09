<?php 
class  Conexion {
    private $host = 'localhost';
    private $dbname = 'ingresos_salas_db';
    private $username = 'root';
    private $password = '';  // Sin contraseña
    public $conexion;

    public function getConnection() {
        $this->conexion = null;
        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
        return $this->conexion;
    }
}
?>
