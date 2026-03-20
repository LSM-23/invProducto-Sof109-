/* global $ */

$(document).ready(function() {
    
    // Creamos una función reutilizable que recibe los IDs específicos de cada formulario
    function validarProducto(evento, idNombre, idPrecio, idCantidad, idError) {
        // Obtenemos los valores usando los IDs que nos pasen como parámetros
        let nombre = $(idNombre).val().trim();
        let precioTexto = $(idPrecio).val().trim();
        let cantidadTexto = $(idCantidad).val().trim();
        
        let $errorDiv = $(idError); 
        
        // 1. PRIMERA VALIDACIÓN: Campos vacíos
        if (nombre === '' || precioTexto === '' || cantidadTexto === '') {
            evento.preventDefault(); 
            $errorDiv.text('Por favor, completa todos los campos obligatorios (*).').removeClass('d-none');
            return; // Detenemos la ejecución aquí
        }

        let precio = parseFloat(precioTexto);
        let cantidad = parseInt(cantidadTexto);
        
        // 2. SEGUNDA VALIDACIÓN: Números negativos
        if (precio < 0 || cantidad < 0) {
            evento.preventDefault(); 
            $errorDiv.text('El precio y la cantidad no pueden ser números negativos.').removeClass('d-none');
            return; // Detenemos la ejecución aquí
        } 
        
        // Si todo está correcto, ocultamos el error
        $errorDiv.addClass('d-none');
    }

    // ---------------------------------------------------------
    // EVENTOS DE LOS FORMULARIOS
    // ---------------------------------------------------------

    // 1. Cuando se envíe el formulario de AGREGAR
    $('#formProducto').on('submit', function(evento) {
        // Llamamos a la función pasándole los IDs del modal de Agregar
        validarProducto(evento, '#nombre', '#precio', '#cantidad', '#errorModal');
    });

    // 2. Cuando se envíe el formulario de EDITAR
    $('#formEditarProducto').on('submit', function(evento) {
        // Llamamos a la misma función, pero con los IDs del modal de Editar
        validarProducto(evento, '#editarNombre', '#editarPrecio', '#editarCantidad', '#errorModalEditar');
    });

});