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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Mi inventario</a>
            <div class="d-flex text-white align-items-center">
                <span class="me-3">Hola, <strong><?php echo htmlspecialchars($nombreUsuario); ?></strong> (<?php echo htmlspecialchars($rol); ?>)</span>
                <a href="../controllers/LogoutController.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de productos</h2>

            <?php if ($rol === 'admin'): ?>
                <button class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target=#modalAgregarProducto>Agregar producto</button>
            <?php endif; ?>
        </div>

        <div class="card shadow mb-3">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descripción</th>
                            <?php if ($rol === 'admin'): ?>
                                <th>Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ejemplo de producto (reemplazar con datos reales de la base de datos) -->
                        <tr>
                            <td>1</td>
                            <td>Laptop</td>
                            <td>$1500.00</td>
                            <td>10</td>
                            <td>Laptop de alta gama</td>
                            <?php if ($rol === 'admin'): ?>
                                <td>
                                <button class="btn btn-warning btn-sm btn-editar" data-bs-toggle="modal" data-bs-target="#modalEditarProducto"
                                        data-id="1"
                                        data-nombre="Laptop Gamer"
                                        data-precio="1500.00"
                                        data-cantidad="10"
                                        data-descripcion="Laptop de alto rendimiento">
                                Editar</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminarProducto" data-id="1">Eliminar</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include_once 'modals/agregar_producto.php'; ?>
<?php include_once 'modals/editar_producto.php'; ?>
<?php include_once 'modals/eliminar_producto.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Validaciones de Javascrip -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../assets/js/validaciones.js"></script>
</body>