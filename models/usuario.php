<?php
require_once '../config/conexion.php';

class Usuario {
    private $conn;

    public function __construct() {
        $baseDeDatos = new Conexion();
        $this->conn = $baseDeDatos->getConexion();
    }

    //------------------------
    //Modelo de Registrar usuario
    //------------------------

    public function crear($usuario, $password_hash, $rol) {
    try {
        // Iniciamos la transacción (pausamos el autoguardado de MySQL)
        $this->conn->beginTransaction();

        $query = "INSERT INTO usuario (usuario, contrasena, rol) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$usuario, $password_hash, $rol]);
        
        // Confirmamos y guardamos todo definitivamente
        $this->conn->commit();
        return true;
    } catch (Exception $e) {
        // Si algo falló, deshacemos cualquier cambio
        $this->conn->rollBack();
        return false;
    }
}
}

?>