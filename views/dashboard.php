<?php
session_start();

// Si no existe la variable de sesión 'rol' (es decir, si alguien intenta entrar directo por la URL)
if (!isset($_SESSION['rol'])) {
    // Lo expulsamos de vuelta al login
    header('Location: ../index.php');
    exit;
}

// Leemos el rol y el nombre directamente desde la sesión segura
$rol = $_SESSION['rol'];
$nombreUsuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include_once 'alertas.php'; ?>
<?php include_once 'inventario.php'; ?>
<?php include_once 'modals/agregar_producto.php'; ?>
<?php include_once 'modals/editar_producto.php'; ?>
<?php include_once 'modals/eliminar_producto.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Validaciones de Javascrip -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../assets/js/validaciones.js"></script>
</body>