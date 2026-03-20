// $(document).ready() espera a que todo el HTML termine de cargar
$(document).ready(function() {
        
        // Capturamos el evento de envío (submit)
        $('#formProducto').on('submit', function(evento) {

            // Guardamos el contenedor del error en una variable
            let $errorDiv = $('#errorModal');

            // Obtenemos los textos exactos de los campos y limpiamos espacios
            let nombre = $('#nombre').val().trim();
            let precioTexto = $('#precio').val().trim();
            let cantidadTexto = $('#cantidad').val().trim();
            
            //Validando campos vacíos (Required)
            if (nombre === '' || precioTexto === '' || cantidadTexto === '') {
                
                // Detenemos el envío
                evento.preventDefault(); 
                
                // Mostramos el error
                $errorDiv.text('Por favor, completa todos los campos obligatorios (*).').removeClass('d-none');
                
                // Usamos return para detener la lectura del código aquí mismo y que no siga evaluando lo demás
                return; 
            }

            // Obtenemos los valores de los campos usando .val()
            let precio = parseFloat($('#precio').val());
            let cantidad = parseInt($('#cantidad').val());
            
            // Validamos que no sean negativos
            if (precio < 0 || cantidad < 0) {
                // Prevenimos que el formulario se envíe al servidor
                evento.preventDefault(); 
                
                // Agregamos el texto del error y quitamos la clase que lo oculta (.removeClass)
                $errorDiv.text('El precio y la cantidad no pueden ser números negativos.').removeClass('d-none');
                return;
            }
            // Si todo está bien, volvemos a ocultar el error (.addClass)
            $errorDiv.addClass('d-none');
        });
});