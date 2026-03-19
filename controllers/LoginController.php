<?php
//Recibir datos del formulario de login
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

//Simular verificación (No olvides cambiar por consulta a base de datos)
if ($usuario === 'admin' && $password === '12345') {
    //Si es correcto, redirigir al dashboard
    //Pasamos el rol por la url temporariamente (no olvidar implementar sesiones)
    header('Location: ../views/dashboard.php?rol=admin');
    exit();
} else if ($usuario === 'cliente' && $password === '1234') {
    header('Location: ../views/dashboard.php?rol=cliente');
    exit();
} else {
    //Si es incorrecto, redirigir al login con error GET
    header('Location: ../index.php?error=1');
    exit();
} 

?>