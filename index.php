<?php
session_start();

if(isset($_SESSION['rol'])) {
    // Si ya hay una sesión activa, redirigimos al dashboard
    header('Location: views/dashboard.php');
    exit;
} else {
    // Si no hay sesión, mostramos el formulario de login
    require_once 'views/login.php';
}

?>