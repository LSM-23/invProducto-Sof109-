<?php
session_start();

// Limpiamos todas las variables de sesión actuales
session_unset();

// Destruimos la sesión en el servidor
session_destroy();

// Redirigimos al usuario a la pantalla de inicio (login)
header('Location: ../index.php');
exit;
?>