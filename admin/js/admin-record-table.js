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

          var data = {
                action: 'get_data_table',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
            };

          $.post( 
              alarm_estimate_form_ajax_obj.ajax_url, 
              data, 
              function(response) {
                if (response.success) {
                    $('#table').bootstrapTable({
                      mobileResponsive: false,
                    minWidth: 562,
                        pagination: true,
                        search: true,
                        showRefresh: true,
                        detailView: true,
                        detailFormatter: function (index, row) {
                          var personalArray = ['nombre', 'correo', 'codigo_postal', 'codigo_area', 'telefono']
                          var businessArray = ['rama_alarma', 'residencia_habitual', 'rejas', 'internet', 'historial_robos', 'alarma_competencia', 'tipo_vivienda', 'casa_mayor_180mts', 'cantidad_empleados_negocio', 'horario_negocio', 'tipo_negocio', 'rama_negocio', 'nave_mayor_1500mts']
                          var html = []
                          var html_personal = []
                          var html_inmueble = []
                                
                          $.each(row, function (key, value) {
                            if (jQuery.inArray(key, personalArray) !== -1) {
                              html_personal.push('<p class="card-text"><b>' + key + ':</b> ' + value + '</p>')
                            }

                            if (jQuery.inArray(key, businessArray) !== -1) {
                              html_inmueble.push('<p class="card-text"><b>' + key + ':</b> ' + value + '</p>')
                            }
                            
                          })

                          var encabezado_personal = '\
                            <div class="row">\
                            <div class="col-sm-6">\
                            <div class="card">\
                            <div class="card-body">\
                            <h5 class="card-title">\
                            Información Personal</h5>'
                          html.push(encabezado_personal)

                          html.push(html_personal.join(''))

                          var encabezado_inmueble ='\
                            </div>\
                            </div>\
                            </div>\
                            <div class="col-sm-6">\
                            <div class="card">\
                            <div class="card-body">\
                            <h5 class="card-title">\
                            Información del Hogar|Negocio\
                            </h5>'
                          html.push(encabezado_inmueble)

                          html.push(html_inmueble.join(''))

                          var footer ='\
                            </div>\
                            </div>\
                            </div>\
                            </div>'
                          html.push(footer)

                          return html.join('')
                        },
                        classes: 'table table-hover',
                        theadClasses: 'thead-light',
                        data: response.data,
                        columns: [{
                            field: 'id',
                            title: 'ID'
                        }, {
                            field: 'fecha',
                            title: 'Fecha'
                        }, {
                            field: 'nombre',
                            title: 'Nombre'
                        }, {
                            field: 'telefono',
                            title: 'Telefono'
                        }, {
                            field: 'paquete',
                            title: 'Paquete'
                        }],
                    });
                } else {
                    alert( 'Error: '+response.data );
                }
          })
          .fail(function(response) {
              alert( "error" );
          });


        function detailFormatter(index, row) {
          var html = []
          $.each(row, function (key, value) {
            html.push('<p><b>' + key + ':</b> ' + value + '</p>')
          })
          return html.join('')
        }

     
     });

})( jQuery );
