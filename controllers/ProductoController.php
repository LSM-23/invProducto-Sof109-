<?php
session_start();

// Verificamos si el usuario tiene sesión activa por seguridad
if (!isset($_SESSION['rol'])) {
    header('Location: ../index.php');
    exit;
}

// Verificamos que sea admin por seguridad
if ($_SESSION['rol'] !== 'admin') {
    header('Location: ../views/dashboard.php');
    exit;
}

require_once '../models/Producto.php';

//Instanciamos el modelo para poder usar sus métodos
$productoModel = new Producto();

// Recibimos la acción desde la URL con agregar por defecto
$accion = $_GET['accion'] ?? 'agregar';

// Descubrimos si es editar buscando si existe id
if (!empty($_POST['id']) && $accion !== 'eliminar') {
    $accion = 'editar';
}

// -------------------------------------------------------------------
// LÓGICA PARA AGREGAR O EDITAR
// -------------------------------------------------------------------
if ($accion === 'agregar' || $accion === 'editar') {
    
    // Recibimos los datos y limpiamos los espacios
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $cantidad = trim($_POST['cantidad'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $imagen_url = trim($_POST['imagen_url'] ?? '');

    // --- VALIDACIONES DE PHP ---
    if (empty($nombre) || $precio === '' || $cantidad === '') {
        $_SESSION['mensaje_error'] = "Error: Todos los campos obligatorios (*) deben estar llenos.";
        header('Location: ../views/dashboard.php');
        exit;
    }

    if (!is_numeric($precio) || $precio < 0 || !is_numeric($cantidad) || $cantidad < 0) {
        $_SESSION['mensaje_error'] = "Error: El precio y la cantidad deben ser números válidos y no pueden ser negativos.";
        header('Location: ../views/dashboard.php');
        exit;
    }

    // --- CONEXIÓN CON LA BASE DE DATOS ---
    if ($accion === 'agregar') {
        
        // Llamamos a la función crear()
        $exito = $productoModel->crear($nombre, $precio, $cantidad, $descripcion, $imagen_url);
        
        if ($exito) {
            $_SESSION['mensaje_exito'] = "¡Producto registrado correctamente en ambas tablas!";
        } else {
            $_SESSION['mensaje_error'] = "Error interno: No se pudo guardar el producto en la base de datos.";
        }

    } else if ($accion === 'editar') {
        
        $id = trim($_POST['id'] ?? '');
        
        if (empty($id)) {
            $_SESSION['mensaje_error'] = "Error: Faltan datos para identificar el producto a editar.";
        } else {
            // Llamamos a la función actualizar()
            $exito = $productoModel->actualizar($id, $nombre, $precio, $cantidad, $descripcion, $imagen_url);
            
            if ($exito) {
                $_SESSION['mensaje_exito'] = "¡Producto y cantidad actualizados correctamente!";
            } else {
                $_SESSION['mensaje_error'] = "Error interno: No se pudo actualizar el producto.";
            }
        }
    }
    
    header('Location: ../views/dashboard.php');
    exit;

// -------------------------------------------------------------------
// LÓGICA PARA ELIMINAR
// -------------------------------------------------------------------
} else if ($accion === 'eliminar') {
    
    $id = trim($_POST['id'] ?? '');
    
    if (empty($id)) {
        $_SESSION['mensaje_error'] = "Error: No se especificó el producto a eliminar.";
    } else {
        $exito = $productoModel->eliminar($id);
        
        if ($exito) {
            $_SESSION['mensaje_exito'] = "¡Producto eliminado correctamente!";
        } else {
            $_SESSION['mensaje_error'] = "Error interno: No se pudo eliminar el producto.";
        }
    }
    
    header('Location: ../views/dashboard.php');
    exit;
}
?>