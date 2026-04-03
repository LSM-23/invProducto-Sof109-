<?php
require_once '../config/conexion.php';

class Producto {
    private $conn;

    public function __construct() {
        $baseDeDatos = new Conexion();
        $this->conn = $baseDeDatos->getConexion();
    }

    // ----------------------------
    // CREAR: llenamos ambas tablas
    // ----------------------------
    public function crear($nombre, $precio, $cantidad, $descripcion, $imagen_url) {
        try {

            // Si la URL está vacía, sera nula
            $img = empty($imagen_url) ? null : $imagen_url;

            // Iniciamos la transacción (pausamos el autoguardado de MySQL)
            $this->conn->beginTransaction();

            // 1. Guardamos primero en la tabla Productos
            $queryProducto = "INSERT INTO Productos (nombre, precio, descripcion, imagen_url) VALUES (?, ?, ?, ?)";
            $stmt1 = $this->conn->prepare($queryProducto);
            $stmt1->execute([$nombre, $precio, $descripcion, $img]);

            // Obtenemos el ID que MySQL le acaba de asignar automáticamente a ese producto
            $nuevo_producto_id = $this->conn->lastInsertId();

            // 2. Guardamos en la tabla Inventario usando ese mismo ID
            $queryInventario = "INSERT INTO Inventario (cantidad, product_id) VALUES (?, ?)";
            $stmt2 = $this->conn->prepare($queryInventario);
            $stmt2->execute([$cantidad, $nuevo_producto_id]);

            // Confirmamos y guardamos todo definitivamente
            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            // Si algo falló, deshacemos cualquier cambio
            $this->conn->rollBack();
            return false;
        }
    }

    // ---------------------------------------------------
    // LEER: Usamos JOIN para traer todo como una sola tabla
    // ---------------------------------------------------
    public function leerTodos() {
        // Condicional del buscador
        if (!empty($_GET['buscar'])) {
            $buscar = $_GET['buscar'];
            $query = "SELECT p.product_id, p.nombre, p.precio, p.descripcion, p.imagen_url, i.cantidad
                  FROM Productos p 
                  JOIN Inventario i ON p.product_id = i.product_id
                  WHERE p.nombre LIKE ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(["%$buscar%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        // Unimos Productos (p) con Inventario (i) basándonos en el product_id
        $query = "SELECT p.product_id, p.nombre, p.precio, p.descripcion, p.imagen_url, i.cantidad 
                  FROM Productos p 
                  JOIN Inventario i ON p.product_id = i.product_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // fetchAll devuelve todos los resultados en forma de arreglo (lista)
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // -----------------------------------------------------------------------------
    // ACTUALIZAR: Usamos un JOIN en el UPDATE para modificar ambas tablas a la vez
    // -----------------------------------------------------------------------------
    public function actualizar($id, $nombre, $precio, $cantidad, $descripcion, $imagen_url) {
        $img = empty($imagen_url) ? null : $imagen_url;

        $query = "UPDATE Productos p 
                  JOIN Inventario i ON p.product_id = i.product_id 
                  SET p.nombre = ?, p.precio = ?, p.descripcion = ?, i.cantidad = ?, p.imagen_url = ?
                  WHERE p.product_id = ?";
                  
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nombre, $precio, $descripcion, $cantidad, $img, $id]);
    }

    // -------------------------------------------------------------------
    // ELIMINAR es cascada para que borre de ambas tablas automáticamente
    // -------------------------------------------------------------------
    public function eliminar($id) {
      
        $query = "DELETE FROM Productos WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>