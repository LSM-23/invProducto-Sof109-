<div class="modal fade" id="modalEliminarProducto" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="../controllers/ProductoController.php?accion=eliminar" method="POST" id="formEliminarProducto">
                <div class="modal-body">
                    <p class="fs-5 text-center mt-3">¿Estás seguro de que deseas eliminar este producto?</p>
                    <p class="text-muted text-center"><small>Esta acción no se puede deshacer.</small></p>
                    
                    <input type="hidden" id="delete_id" name="id">
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>