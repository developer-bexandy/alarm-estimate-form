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
                      pagination: true,
                      search: true,
                      locale: 'es-MX',
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
     
     });

})( jQuery );
