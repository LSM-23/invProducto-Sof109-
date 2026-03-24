<?php
// config/conexion.php

class Conexion {
    private $host = "localhost";
    private $db_name = "inventario_db";
    private $username = "root"; 
    private $password = ""; 
    public $conn;

    public function getConexion() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            // Configuramos para que nos muestre los errores de base de datos de forma clara
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>