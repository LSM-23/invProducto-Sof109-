<div class="position-fixed top-0 end-5 p-4 mt-5" style="z-index: 1055;">
<?php if (isset($_SESSION['mensaje_error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                    echo $_SESSION['mensaje_error']; 
                    unset($_SESSION['mensaje_error']); // Borramos el mensaje para que no vuelva a salir al recargar
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensaje_exito'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php 
                    echo $_SESSION['mensaje_exito']; 
                    unset($_SESSION['mensaje_exito']); // Borramos el mensaje de éxito
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
</div>