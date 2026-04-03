    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Mi inventario</a>
            <div class="d-flex text-white align-items-center">
                <span class="me-3">Hola, <strong><?php echo htmlspecialchars($nombreUsuario); ?></strong> (<?php echo htmlspecialchars($rol); ?>)</span>
                <a href="../controllers/LogoutController.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Buscador -->
    <form method="GET" action="dashboard.php">
    <div class="container mt-5">
        <div class="input-group mb-3">
            <input name="buscar" value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>" type="text" class="form-control" placeholder="Buscar producto" aria-label="Buscar producto" aria-describedby="basic-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="basic-addon2">Buscar</button>
        </div>
    </div>
    </form>

    <!-- Contenido de la página -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de productos</h2>

            <?php if ($rol === 'admin'): ?>
                <button class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target=#modalAgregarProducto>Agregar producto</button>
            <?php endif; ?>
        </div>

        <!-- Tabla -->
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
                        <!-- Condicionar si no hay productos -->
                        <?php if (empty($productos)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay productos en el inventario.</td>
                            </tr>
                        <?php else: ?>
                            <!-- Recorrer la tabla productos para mostrar los datos -->
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($producto['product_id']); ?></td>
                                    
                                    <td>
                                        <?php if (!empty($producto['imagen_url'])): ?>
                                            <img src="<?php echo htmlspecialchars($producto['imagen_url']); ?>" alt="Producto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Sin imagen</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                                    <td>RD$ <?php echo number_format($producto['precio'], 2); ?></td>
                                    <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                                    
                                    <!-- Boton de editar -->
                                    <?php if ($rol === 'admin'): ?>
                                        <td>
                                            <button class="btn btn-warning btn-sm btn-editar" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalEditarProducto"
                                                    data-id="<?php echo $producto['product_id']; ?>"
                                                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                                    data-precio="<?php echo $producto['precio']; ?>"
                                                    data-cantidad="<?php echo $producto['cantidad']; ?>"
                                                    data-descripcion="<?php echo htmlspecialchars($producto['descripcion']); ?>"
                                                    data-imagen="<?php echo htmlspecialchars($producto['imagen_url'] ?? ''); ?>">
                                                Editar
                                            </button>
                                            
                                            <!-- Boton de eliminar -->
                                            <button class="btn btn-danger btn-sm btn-eliminar" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalEliminarProducto"
                                                    data-id="<?php echo $producto['product_id']; ?>">
                                                Eliminar
                                            </button>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
