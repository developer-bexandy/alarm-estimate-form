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
        var mensajeVerificarCode = $('#desc_verify_token');
        var verificationCode = $('#verification_code');
        var tab1 = $('.calculator__tab--first');
        var tab2 = $('.calculator__tab--second');
        var tab3 = $('.calculator__tab--third');
        var checkTab2Hogar = $('#checkAlarmaSi, #checkAlarmaNo');
        var checkTab2Negocio = $('#checkAlarmaSiNegocio, #checkAlarmaNoNegocio');
        var checkTab3Negocio = $('#checkNegocioMas1500, #checkNegocioMenos1500');
        var checkTab3Hogar = $('#checkPiso, #checkMas180, #checkMenos180');
        var CalculaHogar = $('#tab3HorarCalcula');
        var CalculaNegocio = $('#tab3NegocioCalcula');
        var checkPiso = $('.calculator__question--hogar #checkPiso');
        var checkCodigoPostal = $('.calculator__question--hogar #questionInputVivienda');
        var requestVerificationBusiness = $('#request_verification_business');
        var mensajeVerificarCodeBusiness = $('#desc_verify_token_business');
        var verificationCodeBusiness = $('#verification_code_business');
        var timer_via, timer_request;

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
                    requestVerification.parent().parent().fadeIn();
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

        checkTab2Negocio.on('click', function () {
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
                action: 'alarm_estimate_form_submit',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object,
                rama_alarma: $('#questionFirst').find('input[name="rama_alarma"]').val()

            };

            CalculaNegocio.text('Solicitud de envío ...');
            CalculaHogar.text('Solicitud de envío ...');
            $.post( alarm_estimate_form_ajax_obj.ajax_url, data, function(response) {
               CalculaHogar.text('Solicitud enviada');
               CalculaNegocio.text('Solicitud enviada');
               alertSuccess('Solicitud enviada!');
               alert('Solicitud enviada!');
              //  document.location.href = 'https://alarmas.plus/respuesta-calcula/';
               setTimeout(function(){
                document.location.href = '/';
                   //CalculaHogar.text('Calcula tu precio ya');
                   //CalculaNegocio.text('Calcula tu precio ya');
               },3500);

            });
        }

        function alertSuccess(message){
            $('div#notificationes').get(0).innerHTML = '<div class="alert alert-success" role="alert">'+message+'</div>';
            setTimeout(function(){
                $('div#notificationes').get(0).innerHTML = '';
            },3000);                
        }

        function alertError(message){
            $('div#notificationes').get(0).innerHTML = '<div class="alert alert-danger" role="alert">'+message+'</div>';
            setTimeout(function(){
                $('div#notificationes').get(0).innerHTML = '';
            },3000);                
        }

        requestVerification.on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code').val(),
                'phone_number': $('#phone_number').val(),
                'via': $('#via').val(),
                'request_verification' : true
            };

            if (isValidTel(data_object.phone_number)) {
                var data = {
                    action: 'request_phone_verification',
                    nonce_code: alarm_estimate_form_ajax_obj.nonce,
                    data: data_object
                };
                alertSuccess('Procesando!');
                //$('#waiting').addClass("loading");
                //$('#waiting').show();
                $.post( 
                    alarm_estimate_form_ajax_obj.ajax_url, 
                    data, 
                    function(response) {
                        //$('#waiting').removeClass("loading");
                        //$('#waiting').hide();
                        if (response.success) {
                            alertSuccess('Código de verificación enviado!');
                            mensajeVerificarCode[0].innerHTML = "Por favor, escriba el código de verificación enviado a <" +response.data.phone_number +">"
                            setTimeout(function () {
                                $(self).parent().parent().fadeOut('slow', function () {
                                    verificationCode.parent().parent().fadeIn(400, function() {
                                        var contador = 14;
                                        var contadorElem = $('#resend_counter');
                                        timer_request = setInterval(function() {
                                            contadorElem.text('Reenviar código (' + contador + ')');
                                            if (contador-- == 0) {
                                                $('#resend_counter').addClass('oculto');
                                                $('#verification-resend-link').removeClass('oculto');
                                                $('#verification-change-link').removeClass('oculto');
                                                clearInterval(timer_request);
                                            }
                                        }, 1000);
                                    });
                                });
                            },300 );
                        } else {
                            alertError( 'Error: '+response.data.message );
                        }
                        
                })
                .fail(function(response) {
                    alert( "error" );
                });
            } else {
                alertError('Formato no válido!');                
                $('input#phone_number').css('border-color','red');
                $('input#phone_number').focus();
            }
        });


        $('#verify_token').on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code').val(),
                'phone_number': $('#phone_number').val(),
                'via': $('#via').val(),
                'verification_code' : $('#verification_code').val(),
                'verify_token' : true
            };

            if (isValidTel(data_object.phone_number)) {
                var data = {
                    action: 'verify_token',
                    nonce_code: alarm_estimate_form_ajax_obj.nonce,
                    data: data_object
                };
                $.post( 
                    alarm_estimate_form_ajax_obj.ajax_url, 
                    data, 
                    function(response) {
                        if (response.success) {
                            alertSuccess(response.data.message);
                            setTimeout(function () {
                                $(self).parent().parent().fadeOut('slow', function () {
                                    $('#tab3').fadeIn();
                                });
                            },300 );
                        } else {
                            alertError( 'Error: '+response.data.message );
                        }
                        
                })
                .fail(function(response) {
                    alert( "error" );
                });
            } else {
                alertError('Formato no válido!');                
                $('input#phone_number').css('border-color','red');
                $('input#phone_number').focus();
            }
        });

        $('#verification-resend-link').on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code').val(),
                'phone_number': $('#phone_number').val(),
                'via': $('#via').val(),
                'request_verification' : true
            };
            var data = {
                action: 'request_phone_verification',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object
            };
            $.post( 
                alarm_estimate_form_ajax_obj.ajax_url, 
                data, 
                function(response) {
                    if (response.success) {
                        alertSuccess('Código de verificación reenviado!');
                        mensajeVerificarCode[0].innerHTML = "Por favor, escriba el código de verificación enviado a <" +response.data.phone_number +">"
                        setTimeout(function () {
                            verificationCode.parent().parent().fadeIn(400, function() {
                                $('#resend_counter').text('Reenviar código (15)');
                                $('#resend_counter').removeClass('oculto');
                                $('#verification-resend-link').addClass('oculto');
                                $('#verification-change-link').addClass('oculto');
                                var contador = 14;
                                var contadorElem = $('#resend_counter');
                                var timer_resend = setInterval(function() {
                                    contadorElem.text('Reenviar código (' + contador + ')');
                                    if (contador-- == 0) {
                                        $('#resend_counter').addClass('oculto');
                                        $('#verification-resend-link').removeClass('oculto');
                                        $('#verification-change-link').removeClass('oculto');
                                        clearInterval(timer_resend);
                                    }
                                }, 1000);
                            });
                        },300 );
                    } else {
                        alertError('Error: '+response.data.message);
                    }
                    
                })
                .fail(function(response) {
                alert( "error" );
              });
        });

        $('#change_via').on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code').val(),
                'phone_number': $('#phone_number').val(),
                'via': 'call',
                'request_verification' : true
            };
            var data = {
                action: 'request_phone_verification',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object
            };
            $.post( 
                alarm_estimate_form_ajax_obj.ajax_url, 
                data, 
                function(response) {
                    if (response.success) {
                        alertSuccess('Recibirá una llamada con su código!');
                        mensajeVerificarCode[0].innerHTML = "Por favor, escriba el código de verificación enviado a <" +response.data.phone_number +">"
                        setTimeout(function () {
                            verificationCode.parent().parent().fadeIn(400, function() {
                                $('#resend_counter').text('Reenviar código (4000)');
                                $('#resend_counter').removeClass('oculto');
                                $('#verification-resend-link').addClass('oculto');
                                $('#verification-change-link').addClass('oculto');
                                $('#change_via').addClass('oculto');
                                var contador = 3999;
                                var contadorElem = $('#resend_counter');
                                if (typeof timer_request !== 'undefined') {
                                        clearInterval(timer_request);
                                    }
                                timer_via = setInterval(function() {
                                    contadorElem.text('Reenviar código (' + contador + ')');
                                    if (contador-- == 0) {
                                        $('#resend_counter').addClass('oculto');
                                        $('#verification-resend-link').removeClass('oculto');
                                        $('#verification-change-link').removeClass('oculto');
                                        $('#change_via').removeClass('oculto');
                                        clearInterval(timer_via);
                                    }
                                }, 1000);
                            });
                        },300 );
                    } else {
                        alertError('Error: '+response.data.message);
                    }
                    
                })
                .fail(function(response) {
                alert( "error" );
              });
        });

        $('#verification-change-link').on('click', function () {
            var self = this;
            $('#phone_number').val('');

            setTimeout(function () {
                $(self).parent().parent().parent().parent().parent().fadeOut('slow', function () {
                    requestVerification.parent().parent().fadeIn(400, function() {
                        $('#resend_counter').removeClass('oculto');
                        $('#verification-resend-link').addClass('oculto');
                        $('#verification-change-link').addClass('oculto');
                        $('#phone_number').focus();
                    })
                })
            });
        });

        CalculaHogar.on('click', function () {
            var nombre = $('#tab3HorarNombre').val(),
                codigoPostal = $('#tab3HorarInputCodigoPostal').val(),
                email = $('#tab3HorarInputEmail').val(),
                acepto = $('#checkTab3HorarAcepto');
            if(isValidNombre(nombre)){
                if (isValidZipCode(codigoPostal)){
                    if (isValidEmail(email)){
                        if(acepto.is(':checked')){
                            submitForm('hogar');
                            acepto.siblings('label').removeClass('invalid');
                        }else{
                            acepto.siblings('label').addClass('invalid');
                            $('#tab3HorarInputEmail').css('border-color','black');
                        }
                    } else {
                        $('#tab3HorarInputCodigoPostal').css('border-color','black');
                        $('#tab3HorarInputEmail').css('border-color','red');
                        $('#tab3HorarInputEmail').focus();
                    }
                }   else {
                    $('#tab3HorarNombre').css('border-color','black');
                    $('#tab3HorarInputCodigoPostal').css('border-color','red');
                    $('#tab3HorarInputCodigoPostal').focus();
                }
            } else {
                $('#tab3HorarNombre').css('border-color','red');
                $('#tab3HorarNombre').focus();
            }
        });

        requestVerificationBusiness.on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code_business').val(),
                'phone_number': $('#phone_number_business').val(),
                'via': $('#via_business').val(),
                'request_verification' : true
            };

            if (isValidTel(data_object.phone_number)) {
                var data = {
                    action: 'request_phone_verification',
                    nonce_code: alarm_estimate_form_ajax_obj.nonce,
                    data: data_object
                };
                $.post( 
                    alarm_estimate_form_ajax_obj.ajax_url, 
                    data, 
                    function(response) {
                        if (response.success) {
                            alertSuccess('Código de verificación enviado!');
                            mensajeVerificarCodeBusiness[0].innerHTML = "Por favor, escriba el código de verificación enviado a <" +response.data.phone_number +">"
                            setTimeout(function () {
                                $(self).parent().parent().fadeOut('slow', function () {
                                    verificationCodeBusiness.parent().parent().fadeIn(400, function() {
                                        var contador = 14;
                                        var contadorElem = $('#resend_counter_business');
                                        timer_request = setInterval(function() {
                                            contadorElem.text('Reenviar código (' + contador + ')');
                                            if (contador-- == 0) {
                                                $('#resend_counter_business').addClass('oculto');
                                                $('#verification-resend-link_business').removeClass('oculto');
                                                $('#verification-change-link_business').removeClass('oculto');
                                                clearInterval(timer_request);
                                            }
                                        }, 1000);
                                    });
                                });
                            },300 );
                        } else {
                            alert( 'Error: '+response.data.message );
                        }
                        
                })
                .fail(function(response) {
                    alert( "error" );
                });
            } else {
                alertError('Formato no válido!');                
                $('input#phone_number').css('border-color','red');
                $('input#phone_number').focus();
            }
        });

        $('#verify_token_business').on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code_business').val(),
                'phone_number': $('#phone_number_business').val(),
                'via': $('#via_business').val(),
                'verify_token' : true
            };

            if (isValidTel(data_object.phone_number)) {
                var data = {
                    action: 'verify_token',
                    nonce_code: alarm_estimate_form_ajax_obj.nonce,
                    data: data_object
                };
                $.post( 
                    alarm_estimate_form_ajax_obj.ajax_url, 
                    data, 
                    function(response) {
                        if (response.success) {
                            alertSuccess(response.data.message);
                            setTimeout(function () {
                                $(self).parent().parent().fadeOut('slow', function () {
                                    $('#tab3_business').fadeIn();
                                });
                            },300 );
                        } else {
                            alertError( 'Error: '+response.data.message );
                        }
                        
                })
                .fail(function(response) {
                    alert( "error" );
                });
            } else {
                alertError('Formato no válido!');                
                $('input#phone_number_business').css('border-color','red');
                $('input#phone_number_business').focus();
            }
        });

        $('#verification-resend-link_business').on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code_business').val(),
                'phone_number': $('#phone_number_business').val(),
                'via': $('#via_business').val(),
                'request_verification' : true
            };
            var data = {
                action: 'request_phone_verification',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object
            };
            $.post( 
                alarm_estimate_form_ajax_obj.ajax_url, 
                data, 
                function(response) {
                    if (response.success) {
                        alertSuccess('Código de verificación reenviado!');
                        mensajeVerificarCodeBusiness[0].innerHTML = "Por favor, escriba el código de verificación enviado a <" +response.data.phone_number +">"
                        setTimeout(function () {
                            verificationCodeBusiness.parent().parent().fadeIn(400, function() {
                                $('#resend_counter_business').text('Reenviar código (15)');
                                $('#resend_counter_business').removeClass('oculto');
                                $('#verification-resend-link_business').addClass('oculto');
                                $('#verification-change-link_business').addClass('oculto');
                                var contador = 14;
                                var contadorElem = $('#resend_counter_business');
                                var timer_resend = setInterval(function() {
                                    contadorElem.text('Reenviar código (' + contador + ')');
                                    if (contador-- == 0) {
                                        $('#resend_counter_business').addClass('oculto');
                                        $('#verification-resend-link_business').removeClass('oculto');
                                        $('#verification-change-link_business').removeClass('oculto');
                                        clearInterval(timer_resend);
                                    }
                                }, 1000);
                            });
                        },300 );
                    } else {
                        alertError('Error: '+response.data.message);
                    }
                    
                })
                .fail(function(response) {
                alert( "error" );
              });
        });

        $('#change_via_business').on('click', function () {
            var self = this;
            var data_object = {
                'country_code' : $('#country_code_business').val(),
                'phone_number': $('#phone_number_business').val(),
                'via': 'call',
                'request_verification' : true
            };
            var data = {
                action: 'request_phone_verification',
                nonce_code: alarm_estimate_form_ajax_obj.nonce,
                data: data_object
            };
            $.post( 
                alarm_estimate_form_ajax_obj.ajax_url, 
                data, 
                function(response) {
                    if (response.success) {
                        alertSuccess('Recibirá una llamada con su código!');
                        mensajeVerificarCodeBusiness[0].innerHTML = "Por favor, escriba el código de verificación enviado a <" +response.data.phone_number +">"
                        setTimeout(function () {
                            verificationCodeBusiness.parent().parent().fadeIn(400, function() {
                                $('#resend_counter_business').text('Reenviar código (4000)');
                                $('#resend_counter_business').removeClass('oculto');
                                $('#verification-resend-link_business').addClass('oculto');
                                $('#verification-change-link_business').addClass('oculto');
                                $('#change_via_business').addClass('oculto');
                                var contador = 3999;
                                var contadorElem = $('#resend_counter_business');
                                if (typeof timer_request !== 'undefined') {
                                        clearInterval(timer_request);
                                    }
                                timer_via = setInterval(function() {
                                    contadorElem.text('Reenviar código (' + contador + ')');
                                    if (contador-- == 0) {
                                        $('#resend_counter_business').addClass('oculto');
                                        $('#verification-resend-link_business').removeClass('oculto');
                                        $('#verification-change-link_business').removeClass('oculto');
                                        $('#change_via_business').removeClass('oculto');
                                        clearInterval(timer_via);
                                    }
                                }, 1000);
                            });
                        },300 );
                    } else {
                        alertError('Error: '+response.data.message);
                    }
                    
                })
                .fail(function(response) {
                alert( "error" );
              });
        });

        $('#verification-change-link_business').on('click', function () {
            var self = this;
            $('#phone_number_business').val('');

            setTimeout(function () {
                $(self).parent().parent().parent().parent().parent().fadeOut('slow', function () {
                    requestVerificationBusiness.parent().parent().fadeIn(400, function() {
                        $('#resend_counter_business').removeClass('oculto');
                        $('#verification-resend-link_business').addClass('oculto');
                        $('#verification-change-link_business').addClass('oculto');
                        $('#phone_number_business').focus();
                    })
                })
            });
        });

        $('#selectTipoNegocio').on('change', function () {
            var self = this;
            setTimeout(function () {
                $(self).parent().parent().fadeOut('slow', function () {
                    $(self).parent().parent().next().fadeIn();
                });
            },300 );
        });

        CalculaNegocio.on('click', function () {
            var nombre = $('#tab3NegacioNombre').val(),
                codigoPostal = $('#tab3NegocioInputCodigoPostal').val(),
                email = $('#tab3NegacioEmail').val(),
                acepto = $('#checkTab3AceptoNegocio');
            if(isValidNombre(nombre)){
                if (isValidZipCode(codigoPostal)){
                    if (isValidEmail(email)){
                        if(acepto.is(':checked')){
                            submitForm('negocio');
                            acepto.siblings('label').removeClass('invalid');
                        }else{
                            acepto.siblings('label').addClass('invalid');
                            $('#tab3NegacioEmail').css('border-color','black');
                        }
                    } else {
                        $('#tab3NegocioInputCodigoPostal').css('border-color','black');
                        $('#tab3NegacioEmail').css('border-color','red');
                        $('#tab3NegacioEmail').focus();
                    }
                }   else {
                    $('#tab3NegacioNombre').css('border-color','black');
                    $('#tab3NegocioInputCodigoPostal').css('border-color','red');
                    $('#tab3NegocioInputCodigoPostal').focus();
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
            return /^\+?[0-9]{8,11}$/.test(tel);
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

    $(document).ajaxStart(function() { 
        //console.log("ajax start");
        $('#waiting').addClass("loading"); 
        $('#waiting').show();    
    });

    $(document).ajaxStop(function() { 
        //console.log("ajax stop");
        $('#waiting').removeClass("loading");    
        $('#waiting').hide(); 
    });

})( jQuery );

