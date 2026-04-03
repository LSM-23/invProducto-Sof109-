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
                        <!-- Mostrar los errores de validación -->
                        <div id="errorModal" class="alert alert-danger d-none"></div>

                        <!-- Campos para agregar producto -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del producto *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">

                            <!-- Campos para agregar precio -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="precio" class="form-label">Precio *</label>
                                    <input type="number" step="0.01" id="precio" name="precio">
                                </div>
                                <!-- Campo para agregar cantidad -->
                                <div class="col-md-6 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad *</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                                </div>
                            </div>
                            <!-- Campo para agregar descripción -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                            <!-- Campo para agregar imagen -->
                            <div class="mb-3">
                                <label for="imagen_url" class="form-label">URL de la Imagen (Opcional)</label>
                                <input type="url" class="form-control" id="imagen_url" name="imagen_url" placeholder="https://ejemplo.com/imagen.jpg">
                            </div>
                        </div>
                    </div>

                    <!-- Botones para cancelar o guardar producto -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar producto</button>
                        </div>
                </form> 
            </div>
        </div>
     </div>