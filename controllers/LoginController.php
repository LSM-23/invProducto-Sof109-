<?php
// session_start() es obligatorio en la primera línea para poder usar sesiones
session_start(); 

// Recibiendo datos del formulario de login
$usuario = trim($_POST['usuario'] ?? '');
$password_ingresada = trim($_POST['password'] ?? '');

//VALIDACIÓN PHP: Verificamos que no envíen campos vacíos
if (empty($usuario) || empty($password_ingresada)) {
    $_SESSION['mensaje_error'] = "Por favor, ingresa tu usuario y contraseña.";
    header('Location: ../index.php');
    exit;
}

//------------------------------------------------------------------------------------
//Preparando hash de la contraseña (en un caso real, esto buscaría en la base de datos)
//-------------------------------------------------------------------------------------

$password_hash_admin = password_hash('1234', PASSWORD_ARGON2ID);
$password_hash_user = password_hash('1234', PASSWORD_ARGON2ID);

// Simulamos la verificación
if ($usuario === 'admin' ) {
// Verificamos la contraseña usando password_verify()
if ( password_verify($password_ingresada, $password_hash_admin)) {
    
    // Guardamos los datos en la sesión del servidor de forma segura
    $_SESSION['usuario'] = 'Administrador';
    $_SESSION['rol'] = 'admin';
    
    // Redirigimos al dashboard sin enviar variables por la URL
    header('Location: ../views/dashboard.php');
    exit;
    } else {
        // La contraseña falló
        $_SESSION['mensaje_error'] = "Usuario o contraseña incorrectos.";
        header('Location: ../index.php');
        exit;
    }
} else if ($usuario === 'cliente') {
    if (password_verify($password_ingresada, $password_hash_user)) {
    
    $_SESSION['usuario'] = 'Cliente Invitado';
    $_SESSION['rol'] = 'cliente';
    
    header('Location: ../views/dashboard.php');
    exit;
    } else {
        // La contraseña falló
        $_SESSION['mensaje_error'] = "Usuario o contraseña incorrectos.";
        header('Location: ../index.php');
        exit;
    }

} else {
    //NUEVO MANEJO DE ERROR: Usamos nuestra alerta flotante en vez de ?error=1
    $_SESSION['mensaje_error'] = "Usuario o contraseña incorrectos.";
    header('Location: ../index.php');
    exit;
}
?>