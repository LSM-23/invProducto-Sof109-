<?php
// session_start() es obligatorio en la primera línea para poder usar sesiones
session_start(); 

// Recibiendo datos del formulario de login
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Simulamos la verificación
if ($usuario === 'admin' && $password === '1234') {
    
    // Guardamos los datos en la sesión del servidor de forma segura
    $_SESSION['usuario'] = 'Administrador';
    $_SESSION['rol'] = 'admin';
    
    // Redirigimos al dashboard sin enviar variables por la URL
    header('Location: ../views/dashboard.php');
    exit;

} else if ($usuario === 'cliente' && $password === '1234') {
    
    $_SESSION['usuario'] = 'Cliente Invitado';
    $_SESSION['rol'] = 'cliente';
    
    header('Location: ../views/dashboard.php');
    exit;

} else {
    header('Location: ../index.php?error=1');
    exit;
}
?>