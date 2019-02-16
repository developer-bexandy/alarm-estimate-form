(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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
	 	var checkHogar = $('.calculator__question #checkHogar');
        var checkNegocio = $('.calculator__question #checkNegocio');
        var divHogar = $('.calculator__question--hogar');
        var divNegocio = $('.calculator__question--negocio');
        var divFirstQuestion = $('.calculator__question--first');
        var allQuestionsCheckboxes = $('.calculator__question--hogar input[type=checkbox].checkbox-question-next, .calculator__question--negocio input[type=checkbox].checkbox-question-next');
        var questionButtonVivienda = $('#questionButtontVivienda, #postalNegocioButton');
        var questionInputVivienda = $('#questionInputVivienda, #postalNegocioInput');
        var requestVerification = $('#request_verification');
        var tab1 = $('.calculator__tab--first');
        var tab2 = $('.calculator__tab--second');
        var tab3 = $('.calculator__tab--third');
        var checkTab2Hogar = $('#checkAlarmaSi, #checkAlarmaNo');
        var checkTab3Negocio = $('#checkTieneNegocioSi, #checkTieneNegocioNo');
        var checkTab3Hogar = $('#checkPiso, #checkMas180, #checkMenos180');
        var CalculaHogar = $('#tab3HorarCalcula');
        var CalculaNegocio = $('#tab3NegocioCalcula');
        var checkPiso = $('.calculator__question--hogar #checkPiso');
        var checkCodigoPostal = $('.calculator__question--hogar #questionInputVivienda');

        checkHogar.on( "click", function() {
            tab1.addClass('calculator__tab--active');
            setTimeout(function () {
                divFirstQuestion.fadeOut('slow', function () {
                    divHogar.fadeIn();
                });
            },300 );

        });

        checkNegocio.on( "click", function() {
            tab1.addClass('calculator__tab--active');
            tab1.children()[1].innerHTML = "Datos del Negocio";
            tab2.children()[1].innerHTML = "Tipo de Negocio";
            setTimeout(function () {
                divFirstQuestion.fadeOut('slow', function () {
                    divNegocio.fadeIn();
                });
            },300 );

        });

        checkPiso.on('click', function () {
            var self = this;
            setTimeout(function () {
                $(self).parent().parent().fadeOut('slow', function () {
                    checkCodigoPostal.parent().parent().fadeIn();
                });
            },300 );
        });

        allQuestionsCheckboxes.on('click', function () {
            var self = this;
            setTimeout(function () {
                $(self).parent().parent().fadeOut('slow', function () {
                    $(self).parent().parent().next().fadeIn();
                });
            },300 );
        });

        $('#questionButtontVivienda').on("click", function () {

            var questionInputVivienda = $('#questionInputVivienda');
            var inputValue = questionInputVivienda.val();
            if (isValidZipCode(inputValue)) {
                var self = this;
                setTimeout(function () {
                    $(self).parent().parent().fadeOut('slow', function () {
                        $(self).parent().parent().next().fadeIn();
                    });
                },300 );
            } else {
                questionInputVivienda.css('border-color','red');
                questionInputVivienda.focus();
            }
        });

        $('#postalNegocioButton').on("click", function () {
            var questionInputVivienda = $('#postalNegocioInput');
            var inputValue = questionInputVivienda.val();
            if (isValidZipCode(inputValue)) {
                var self = this;
                setTimeout(function () {
                    $(self).parent().parent().fadeOut('slow', function () {
                        $(self).parent().parent().next().fadeIn();
                    });
                },300 );
            } else {
                questionInputVivienda.css('border-color','red');
                questionInputVivienda.focus();
            }
        });

        checkTab2Hogar.on('click', function () {
            tab1.removeClass('calculator__tab--active');
            tab1.addClass('calculator__tab--done');
            tab2.addClass('calculator__tab--active');
        });

        checkTab3Negocio.on('click', function () {
            tab2.removeClass('calculator__tab--active');
            tab2.addClass('calculator__tab--done');
            tab3.addClass('calculator__tab--active');
        });

        checkTab3Hogar.on('click', function () {
            tab2.removeClass('calculator__tab--active');
            tab2.addClass('calculator__tab--done');
            tab3.addClass('calculator__tab--active');
        });

        function submitForm(id){

            var data_object = $('#'+id+'Form').serialize();


            var data = {
                action: 'alarm_email_results',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object
            };

            CalculaNegocio.text('Solicitud de envío ...');
            CalculaHogar.text('Solicitud de envío ...');
            $.post( alarm_estimate_form_ajax_obj.ajax_url, data, function(response) {
               CalculaHogar.text('Solicitud enviada');
               CalculaNegocio.text('Solicitud enviada');
              //  document.location.href = 'https://alarmas.plus/respuesta-calcula/';
               setTimeout(function(){
                   CalculaHogar.text('Calcula tu precio ya');
                   CalculaNegocio.text('Calcula tu precio ya');
               },3500);

            });
        }

        requestVerification.on('click', function () {
            var self = this;
            var data = {
                action: 'alarm_email_results',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object
            };
            $.post( alarm_estimate_form_ajax_obj.ajax_url, data, function(response) {
               CalculaHogar.text('Solicitud enviada');
               CalculaNegocio.text('Solicitud enviada');
               setTimeout(function(){
                   CalculaHogar.text('Calcula tu precio ya');
                   CalculaNegocio.text('Calcula tu precio ya');
               },3500);

            });
        });

        CalculaHogar.on('click', function () {
            var nombre = $('#tab3HorarNombre').val(),
                phone = $('#tab3HorarInputTel').val(),
                email = $('#tab3HorarInputEmail').val(),
                acepto = $('#checkTab3HorarAcepto');
            if(isValidNombre(nombre)){
                if (isValidTel(phone)){
                    if (isValidEmail(email)){
                        if(acepto.is(':checked')){
                            submitForm('hogar');
                            acepto.siblings('label').removeClass('invalid');
                        }else{
                            acepto.siblings('label').addClass('invalid');
                            $('#tab3HorarInputEmail').css('border-color','black');
                        }
                    } else {
                        $('#tab3HorarInputTel').css('border-color','black');
                        $('#tab3HorarInputEmail').css('border-color','red');
                        $('#tab3HorarInputEmail').focus();
                    }
                }   else {
                    $('#tab3HorarNombre').css('border-color','black');
                    $('#tab3HorarInputTel').css('border-color','red');
                    $('#tab3HorarInputTel').focus();
                }
            } else {
                $('#tab3HorarNombre').css('border-color','red');
                $('#tab3HorarNombre').focus();
            }
        });

        CalculaNegocio.on('click', function () {
            var nombre = $('#tab3NegacioNombre').val(),
                phone = $('#tab3NegacioTel').val(),
                email = $('#tab3NegacioEmail').val(),
                acepto = $('#checkTab3AceptoNegocio');
            if(isValidNombre(nombre)){
                if (isValidTel(phone)){
                    if (isValidEmail(email)){
                        if(acepto.is(':checked')){
                            submitForm('negocio');
                            acepto.siblings('label').removeClass('invalid');
                        }else{
                            acepto.siblings('label').addClass('invalid');
                            $('#tab3NegacioEmail').css('border-color','black');
                        }
                    } else {
                        $('#tab3NegacioTel').css('border-color','black');
                        $('#tab3NegacioEmail').css('border-color','red');
                        $('#tab3NegacioEmail').focus();
                    }
                }   else {
                    $('#tab3NegacioNombre').css('border-color','black');
                    $('#tab3NegacioTel').css('border-color','red');
                    $('#tab3NegacioTel').focus();
                }
            } else {
                $('#tab3NegacioNombre').css('border-color','red');
                $('#tab3NegacioNombre').focus();
            }
        });

        function isValidZipCode(zip) {
            return /^[0-9]{5}(?:-[0-9]{4})?$/.test(zip);
        }

        function isValidTel(tel) {
            return /^\+?[0-9]{9}$/.test(tel);
        }

        function isValidNombre(Nombre) {
            return /^[0-9a-zA-Z\-\s]{1,25}$/.test(Nombre);
        }

        function isValidEmail(Email) {
            if (Email !== ''){
                return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email);
            }
            return true;

        }


	 });

})( jQuery );

