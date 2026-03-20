<?php
session_start();

// Verificamos si el usuario tiene sesión activa por seguridad
if (!isset($_SESSION['rol'])) {
    header('Location: ../index.php');
    exit;
}

// Recibimos la acción desde la URL (ej: ?accion=editar). Si no hay, asumimos que es 'agregar'
$accion = $_GET['accion'] ?? 'agregar';

// Si la acción es agregar o editar, validamos los mismos campos
if ($accion === 'agregar' || $accion === 'editar') {
    
    // Recibimos los datos y usamos trim() para limpiar espacios vacíos a los lados
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $cantidad = trim($_POST['cantidad'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    // 1. VALIDACIÓN: Campos obligatorios vacíos con empty() o comparación estricta con '' para el precio y cantidad
    if (empty($nombre) || $precio === '' || $cantidad === '') {
        $_SESSION['mensaje_error'] = "Error: Todos los campos obligatorios (*) deben estar llenos.";
        header('Location: ../views/dashboard.php');
        exit;
    }

    // 2. VALIDACIÓN: Formato numérico y números positivos con is_numeric() y si es menor que 0
    if (!is_numeric($precio) || $precio < 0 || !is_numeric($cantidad) || $cantidad < 0) {
        $_SESSION['mensaje_error'] = "Error: El precio y la cantidad deben ser números válidos y no pueden ser negativos.";
        header('Location: ../views/dashboard.php');
        exit;
    }

    // --- SIMULACIÓN DE GUARDADO EN BASE DE DATOS ---
    // Si el código llega hasta aquí, significa que pasó todas las validaciones de PHP.
    // Como aún no tenemos la BD, simplemente simulamos el éxito.
    
    if ($accion === 'agregar') {
        $_SESSION['mensaje_exito'] = "¡Producto registrado correctamente!";
    } else {
        $_SESSION['mensaje_exito'] = "¡Producto actualizado correctamente!";
    }
    
    header('Location: ../views/dashboard.php');
    exit;
    } else if ($accion === 'eliminar') {
    // Para eliminar solo validamos que nos llegue un ID
    $id = $_POST['id'] ?? '';
    
    if (empty($id)) {
        $_SESSION['mensaje_error'] = "Error: No se especificó el producto a eliminar.";
    } else {
        $_SESSION['mensaje_exito'] = "¡Producto eliminado correctamente!";
    }
    
    header('Location: ../views/dashboard.php');
    exit;
}

?>