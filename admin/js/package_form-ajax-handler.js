(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
     $(function() { 

        var imgPreview = $('#imgPaqueteA, #imgPaqueteB, #imgPaqueteC, #imgPaqueteD, #imgPaqueteE');

        var refresh_data = {
                action: 'get_package_form_data',
                package_form_nonce: params.nonce,
            };

          $.post( 
              params.ajaxurl, 
              refresh_data, 
              function(response) {
                if (response.success) {
                    refrescarDatos(response.data);
                } else {
                    alertError('Algo salió mal!');
                }
          })
          .fail(function(response) {
              alertError('Algo salió mal!'); 
          });


        $( '#package_form_ajax' ).submit( function( event ) {
            
            event.preventDefault(); // Prevent the default form submit.            
            
            // serialize the form data
            var ajax_form_data = $("#package_form_ajax").serialize();
            
            //add our own ajax check as X-Requested-With is not always reliable
            ajax_form_data = ajax_form_data+'&ajaxrequest=true&submit=Submit+Form';

            var data = new FormData();
            data.append("action", "save_package_form");
            data.append("package_form_nonce", params.nonce);
            data.append("datos", ajax_form_data);
            data.append('imgPaqueteA', $('#imgPaqueteA')[0].files[0]);
            data.append('imgPaqueteB', $('#imgPaqueteB')[0].files[0]);
            data.append('imgPaqueteC', $('#imgPaqueteC')[0].files[0]);
            data.append('imgPaqueteD', $('#imgPaqueteD')[0].files[0]);
            data.append('imgPaqueteE', $('#imgPaqueteE')[0].files[0]);

            $.ajax({
                url: params.ajaxurl,
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false, // Don't proccess the files
                contentType: false, // Set content type to false as JQuery will tell the server its a query string request
                success: function(response, textStatus, jqXHR) {
                    if (response.success) {
                        refrescarDatos(response.data);
                        alertSuccess('Datos han sido guardados!');
                    } else {
                        alertError('Algo salió mal!');
                    }
                }
            });

        });

        
        function refrescarDatos(datos) {
            $('#nombrePaqueteA').val(datos[0].nombre);
            $('#descripcionPaqueteA').val(datos[0].descripcion);
            $('img#previewPaqueteA').attr('src',datos[0].img_url);
            $('#nombrePaqueteB').val(datos[1].nombre);
            $('#descripcionPaqueteB').val(datos[1].descripcion);
            $('img#previewPaqueteB').attr('src',datos[1].img_url);
            $('#nombrePaqueteC').val(datos[2].nombre);
            $('#descripcionPaqueteC').val(datos[2].descripcion);
            $('img#previewPaqueteC').attr('src',datos[2].img_url);
            $('#nombrePaqueteD').val(datos[3].nombre);
            $('#descripcionPaqueteD').val(datos[3].descripcion);
            $('img#previewPaqueteD').attr('src',datos[3].img_url);
            $('#nombrePaqueteE').val(datos[4].nombre);
            $('#descripcionPaqueteE').val(datos[4].descripcion);
            $('img#previewPaqueteE').attr('src',datos[4].img_url);
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var self = input;
                var reader = new FileReader();                

                reader.onload = function (e) {
                    $(self).parent().children('img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);

            }

        }

        imgPreview.change(function(){
            readURL(this);
        });

        function alertSuccess(message){
            $('#package_form_feedback').get(0).innerHTML = '<div class="alert alert-success" role="alert">'+message+'</div>';
            setTimeout(function(){
                $('#package_form_feedback').get(0).innerHTML = '';
            },5000);                
        }

        function alertError(message){
            $('#package_form_feedback').get(0).innerHTML = '<div class="alert alert-danger" role="alert">'+message+'</div>';
            setTimeout(function(){
                $('#package_form_feedback').get(0).innerHTML = '';
            },5000);                
        }
    });

    $(document).ajaxStart(function() { 
        console.log("ajax start");
        $('#waiting').addClass("loading"); 
        $('#waiting').show();    
    });

    $(document).ajaxStop(function() { 
        console.log("ajax stop");
        $('#waiting').removeClass("loading");    
        $('#waiting').hide(); 
    });

})( jQuery );