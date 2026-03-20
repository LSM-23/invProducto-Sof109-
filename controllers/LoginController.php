<?php
// session_start() es obligatorio en la primera línea para poder usar sesiones
session_start(); 

// Recibiendo datos del formulario de login
$usuario = $_POST['usuario'] ?? '';
$password_ingresada = $_POST['password'] ?? '';

//------------------------------------------------------------------------------------
//Preparando hash de la contraseña (en un caso real, esto buscaría en la base de datos)
//-------------------------------------------------------------------------------------

$password_hash_admin = password_hash($password_ingresada, PASSWORD_DEFAULT);
$password_hash_user = password_hash($password_ingresada, PASSWORD_DEFAULT);

// Simulamos la verificación
if ($usuario === 'admin' && password_verify($password_ingresada, $password_hash_admin)) {
    
    // Guardamos los datos en la sesión del servidor de forma segura
    $_SESSION['usuario'] = 'Administrador';
    $_SESSION['rol'] = 'admin';
    
    // Redirigimos al dashboard sin enviar variables por la URL
    header('Location: ../views/dashboard.php');
    exit;

} else if ($usuario === 'cliente' && password_verify($password_ingresada, $password_hash_user)) {
    
    $_SESSION['usuario'] = 'Cliente Invitado';
    $_SESSION['rol'] = 'cliente';
    
    header('Location: ../views/dashboard.php');
    exit;

} else {
    header('Location: ../index.php?error=1');
    exit;
}
?>