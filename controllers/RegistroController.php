<?php
// session_start() es obligatorio en la primera línea para poder usar sesiones
session_start();

//Controlador para el registro de usuarios
$usuario = trim($_POST['usuario'] ?? '');
$password = trim($_POST['password'] ?? '');
$rol = trim($_POST['rol'] ?? '');

//VALIDACIÓN PHP: Verificamos que no envíen campos vacíos
if ($usuario === ''|| $password === '') {
    $_SESSION['mensaje_error'] = "Por favor, ingresa tu usuario y contraseña.";
    header('Location: ../views/registro.php');
    exit;
}

if(!empty($rol) && $rol == '554786') {
    $rol = 'admin';
} else {
    $rol = 'cliente';
}


//---------------------------------------------------
//Insertamos en base de datos con la contraseña hash
//---------------------------------------------------
$password_hash = password_hash($password, PASSWORD_ARGON2ID);

require_once '../models/usuario.php';

$usuarioModel = new Usuario();

$exito = $usuarioModel->crear($usuario, $password_hash, $rol);

if ($exito) {
    $_SESSION['mensaje_exito'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
} else {
    $_SESSION['mensaje_error'] = "Error interno: No se pudo registrar el usuario.";
}

header('Location: ../index.php');
exit;