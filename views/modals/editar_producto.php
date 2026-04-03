<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="../controllers/ProductoController.php?action=editar" method="POST" id="formEditarProducto">
                <div class="modal-body">
                    <!-- Mostrar los errores de validación -->
                    <div id="errorModalEditar" class="alert alert-danger d-none" role="alert"></div>
                    <!-- Almacenar el ID y ocultarlo -->
                    <input type="hidden" id="editarId" name="id">
                    <!-- Campo para editar el nombre -->
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre del producto *</label>
                        <input type="text" class="form-control" id="editarNombre" name="nombre">
                    </div>
                    <!-- Campo para editar precio-->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editarPrecio" class="form-label">Precio *</label>
                            <input type="number" step="0.01" id="editarPrecio" name="precio">
                        </div>
                        <!-- Campo para editar cantidad -->
                        <div class="col-md-6 mb-3">
                            <label for="editarCantidad" class="form-label">Cantidad *</label>
                            <input type="number" class="form-control" id="editarCantidad" name="cantidad">
                        </div>
                        <!-- Campo para editar descripción -->
                        <div class="mb-3">
                            <label for="editarDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editarDescripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <!-- Campo para editar imagen -->
                         <div class="mb-3">
                            <label for="edit_imagen_url" class="form-label">URL de la Imagen (Opcional)</label>
                            <input type="url" class="form-control" id="edit_imagen_url" name="imagen_url">
                        </div>
                    </div>
                </div>
                <!-- Botones para cancelar o guardar cambios -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>