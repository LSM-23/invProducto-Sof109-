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

    // ---------------------------------------------------------
    // EVENTO PARA CARGAR LOS DATOS EN EL MODAL DE EDITAR
    // ---------------------------------------------------------
    $('.btn-editar').on('click', function() {
        
        //Usamos this para obtener los datos del botón que se ha pulsado.
        let id = $(this).data('id');
        let nombre = $(this).data('nombre');
        let precio = $(this).data('precio');
        let cantidad = $(this).data('cantidad');
        let descripcion = $(this).data('descripcion');

        // Tomamos esa información y rellenamos (.val) los campos del modal de Editar
        $('#editarId').val(id);
        $('#editarNombre').val(nombre);
        $('#editarPrecio').val(precio);
        $('#editarCantidad').val(cantidad);
        $('#editarDescripcion').val(descripcion);
    });

    // --------------------------------
    // EVENTO PARA ELIMINAR UN PRODUCTO
    // --------------------------------

    $('.btn-eliminar').on('click', function() {
        let id = $(this).data('id');
        $('#delete_id').val(id);
    });



    //-----------------------------
    // Pulsas Enter, saltas de campo
    //-----------------------------
    $('form input').on('keydown', function(evento) {
        if (evento.key === 'Enter') {
            evento.preventDefault(); // Evita que el formulario se envíe al pulsar Enter
            
            // Encuentra el siguiente campo de entrada dentro del mismo formulario
            let campos = $(this).closest('form').find('input');
            let posicion_actual = campos.index(this);
            if (posicion_actual < campos.length - 1) {
                campos.eq(posicion_actual + 1).focus(); // Mueve el foco al siguiente campo
            } else {
                 $(this).closest('form').submit();
            }
        }
    });
    //------------------------
    // Validaciones del Registro
    //------------------------
    $('#registroForm').on('submit', function(evento) {
        let usuario = $('#usuario').val().trim();
        let password = $('#password').val().trim();
        let $errorDiv = $('#errorModalRegistro');
        
        if (usuario === '') {
            evento.preventDefault();
            $errorDiv.text('Por favor, introduce un nombre de usuario.').removeClass('d-none');
            return;
        } else if (password === '') {
            evento.preventDefault();
            $errorDiv.text('Por favor, introduce una contraseña.').removeClass('d-none');
            return;
        }
        $errorDiv.addClass('d-none');
    });


    
    //-------------------------
    // Validaciones de Registro
    //-------------------------
    $('#loginForm').on('submit', function(evento) {
        let usuario = $('#usuario').val().trim();
        let password = $('#password').val().trim();
        let $errorDiv = $('#errorModalRegistro');
        
        if (usuario === '') {
            evento.preventDefault();
            $errorDiv.text('Por favor, introduce un nombre de usuario.').removeClass('d-none');
            return;
        } else if (password === '') {
            evento.preventDefault();
            $errorDiv.text('Por favor, introduce una contraseña.').removeClass('d-none');
            return;
        }
        $errorDiv.addClass('d-none');
    });
    
});