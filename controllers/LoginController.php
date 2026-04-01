<?php
session_start(); 
require_once __DIR__ . '/../config/conexion.php'; 

$usuario_ingresado = trim($_POST['usuario'] ?? '');
$password_ingresada = trim($_POST['password'] ?? '');

if (empty($usuario_ingresado) || empty($password_ingresada)) {
    $_SESSION['mensaje_error'] = "Por favor, ingresa usuario y contraseña.";
    header('Location: ../index.php');
    exit;
}

// ---------------------------------------------------------
// BUSQUEDA EN BASE DE DATOS (Para usuarios registrados)
// ---------------------------------------------------------
try {
    $database = new conexion();
    $pdo = $database->getConexion();

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = ?");
    $stmt->execute([$usuario_ingresado]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si encontramos al usuario en la tabla y la contraseña coincide
    if ($user && password_verify($password_ingresada, $user['contrasena'])) {
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol']; // 'cliente' o 'admin' según la DB
        
        header('Location: ../views/dashboard.php');
        exit;
    }

    // Si no entró por admin ni por base de datos
    $_SESSION['mensaje_error'] = "Usuario o contraseña incorrectos.";
    header('Location: ../index.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['mensaje_error'] = "Error de conexión.";
    header('Location: ../index.php');
    exit;
}