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
