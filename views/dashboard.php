<?php
//Reciviendo rol temporariamente por GET (no olvidar implementar sesiones)
$rol = $_GET['rol'] ?? 'cliente';
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
                <span class="me-3">Rol: <strong><?php echo htmlspecialchars($rol); ?></strong></span>
                <a href="../index.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
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
                                    <button class="btn btn-sm btn-warning btn-sm">Editar</button>
                                    <button class="btn btn-sm btn-warning btn-sm">Eliminar</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para agregar producto (solo visible para admin) -->
     <div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Agregar producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="../controllers/ProductoController.php" method="POST" id="formProducto">
                    <div class="modal-body">
                        <div id="errorModal" class="alert alert-danger d-none"></div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del producto *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="precio" class="form-label">Precio *</label>
                                    <input type="number" step="0.01" id="precio" name="precio">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad *</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar producto</button>
                        </div>
                </form> 
            </div>
        </div>
     </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Validaciones de Javascrip -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../assets/js/validaciones.js"></script>
</body>