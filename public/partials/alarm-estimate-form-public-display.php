<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="calculator__wrapper">

    <div class="calculator__tabs-wrapper ">
        <div class="calculator__tab calculator__tab--first calculator__tab--triangle calculator__tab--active">
            <span class="tab__circle">1</span>
            <span class="tab__descr">Datos de la Vivienda</span>
        </div>

        <div class="calculator__tab calculator__tab--second calculator__tab--triangle">
            <span class="tab__circle">2</span>
            <span class="tab__descr">Tipo de Vivienda</span>
        </div>

        <div class="calculator__tab calculator__tab--third calculator__tab--last">
            <span class="tab__circle">3</span>
            <span class="tab__descr">Datos Personales</span>
        </div>
    </div>

    <div id="notificationes"></div>

    <div id="questionFirst" class="calculator__question calculator__question--first">
        <p class="question-descr">¿Necesitar proteger un hogar o un negocio?</p>
        <div class="question">
            <input type="checkbox" id="checkHogar" name="rama_alarma" value="hogar" class="checkbox-question-next"/>
            <label for="checkHogar">Hogar</label>
        </div>
        <div class="question">
            <input type="checkbox" id="checkNegocio" name="rama_alarma" value="negocio" class="checkbox-question-next"/>
            <label for="checkNegocio">Negocio</label>
        </div>
    </div>

    <div class="calculator__question calculator__question--hogar" >
        <form id="hogarForm">
            <div class="question--horar" style="display: block">
                <p class="question-descr">¿Es una vivienda habitual o suele estar vacía?</p>
                <div class="question">
                    <input type="checkbox" id="checkHabitual" name="residencia_habitual" value="true" class="checkbox-question-next"/>
                    <label for="checkHabitual">Habitual</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkVacia" name="residencia_habitual" value="false" class="checkbox-question-next"/>
                    <label for="checkVacia">Vacía</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">
                        Tyco te ayuda a proteger tu vivienda contra el robo y a proteger tu segunda residencia contra los intentos de ocupación y robo.
                    </span>
                </div> 
            </div>
            
            <div class="question--horar">
                <p class="question-descr">¿tienes rejas en la vivienda?</p>
                <div class="question">
                    <input type="checkbox" id="checkRejasSi" name="rejas" value="true" class="checkbox-question-next"/>
                    <label for="checkRejasSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkRejasNo" name="rejas" value="false" class="checkbox-question-next"/>
                    <label for="checkRejasNo">No</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Instalar rejas en una vivienda es siempre una buena opción y facilita la configuración del sistema de alarma.</span>
                </div> 
            </div>

            <div class="question--horar">
                <p class="question-descr">¿Tienes internet en el domicilio?</p>
                <div class="question">
                    <input type="checkbox" id="checkInternetSi" name="internet" value="true" class="checkbox-question-next"/>
                    <label for="checkInternetSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkInternetNo" name="internet" value="false" class="checkbox-question-next"/>
                    <label for="checkInternetNo">No</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Si tienes Internet en tu domicilio Tyco realizará la conexión mediante cable al router, lo que se denomina conexión multivía, no es necesario pero si se puede optar por esa opción es un plus de seguridad para tu alarma.</span>
                </div> 
            </div>

            <div class="question--horar">
                <p class="question-descr">¿Tienes alarma con otra empresa?</p>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaSi" name="alarma_competencia" value="true" class="checkbox-question-next"/>
                    <label for="checkAlarmaSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaNo" name="alarma_competencia" value="false" class="checkbox-question-next"/>
                    <label for="checkAlarmaNo">No</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Te asesoramos en el proceso de baja con tu empresa actual para que no tengas problemas a la hora de gestionar el trámite de baja.</span>
                </div>
            </div>

            <!----------------tab2--------------->

            <div class="question--horar">
                <p class="question-descr">¿Que tipo de hogar?</p>
                <div class="question">
                    <input type="checkbox" id="checkPiso" name="tipo_vivienda" value="piso" />
                    <label for="checkPiso">Piso</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkChalet" name="tipo_vivienda" value="casa" class="checkbox-question-next" />
                    <label for="checkChalet">Casa</label>
                </div>
            </div>

            <div class="question--horar">
                <p class="question-descr">¿Su casa mide más de 180 mts cuadrados?</p>
                <div class="question">
                    <input type="checkbox" id="checkMas180" name="casa_mayor_180mts" value="true" class="checkbox-question-next"/>
                    <label for="checkMas180">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkMenos180" name="casa_mayor_180mts" value="false" class="checkbox-question-next"/>
                    <label for="checkMenos180">No</label>
                </div>
            </div>

            <!----------------tab3--------------->      
            <div class="question--horar" >
                <p class="question-descr">Número Telefónico Movil</p>
                <div class="question__input-wrapper">
                    <input type="text" id="country_code" name="country_code" value="+34" class="input-group-addon" />
                    <!--
                    <div id="verify-country-code" class="input-group-addon">+58</div>
                    -->
                    <input type="text" id="phone_number" name="phone_number"  placeholder="987654321" required class="question__input"/>
                    <input type="hidden" id="via" name="via" value="sms" />
                    <input type="hidden" id="request_id" name="request_id" value="" />
                    <div class="question__button" id="request_verification">Verificar</div>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Te mandaremos un código a tu teléfono móvil para confirmar que es un número correcto, te mandaremos tu precio de oferta cerrado al mismo número mediante un mensaje de Whatsapp. Al realizar ésta acción aceptas la comunicación con alarmas.plus a través de éste medio.</span>
                </div>                
            </div>      

            <div class="question--horar">
                <p class="question-descr" id="desc_verify_token">Por favor, escriba el código de verificación enviado a</p>
                <div class="question__input-wrapper">

                    <input type="text" id="verification_code" placeholder="Código de Verificación" class="question__input" value="" />
                    <div class="question__button" id="verify_token">Enviar</div>
                </div>                
                <div class="phone-verification-code-links">
                    <div class="dont_receive_code">
                        <p>No ha recibido un código?</p>
                        <ul id="verification-resend-code" class="list-unstyled">
                            <li id="resend_counter" class="resend_counter">Enviando código de verificación por SMS (125)</li>
                            <li><a id="verification-resend-link" class="verification-resend-link oculto">Reenviar Código</a></li>
                            <li><a id="verification-change-link" class="verification-change-link oculto">Cambiar número telefónico</a></li>
                        </ul>
                    </div>
                </div>                
            </div>
                
            <!----------------Datos Personales---------------> 

            <div id="tab3" class="question--horar tab3">
                <div class="tab3__row">
                    <div class="tab3__descr">Nombre <small>*</small></div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3HorarNombre" name="nombre">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Email</div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3HorarInputEmail" name="correo">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Código postal de tu vivienda</div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3HorarInputCodigoPostal" name="codigo_postal">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">He leido y acepto la politica de privacidad<small>*</small></div>
                    <div class="tab3__input">
                        <input type="checkbox" id="checkTab3HorarAcepto" name="checkTab3HorarAcepto"/>
                        <label for="checkTab3HorarAcepto">Acepto
                            <a href="https://alarmas.plus/politica-de-privacidad" class="tab3__link">
                                https://alarmas.plus/politica-de-privacidad
                            </a>
                        </label>
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="calcula-button question__button" id="tab3HorarCalcula">Calcula tu precio ya</div>
                </div>
            </div>
        </form>
    </div>

    <div class="calculator__question calculator__question--negocio">
        <form id="negocioForm">
            
            <div class="question--negocio" style="display: block">
                <p class="question-descr">¿Tienes internet en el negocio?</p>
                <div class="question">
                    <input type="checkbox" id="checkInternetNegocioSi" name="internet" value="true" class="checkbox-question-next"/>
                    <label for="checkInternetNegocioSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkInternetNegocioNo" name="internet" value="false" class="checkbox-question-next"/>
                    <label for="checkInternetNegocioNo">No</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Si tienes Internet en tu negocio Tyco realizará la conexión mediante cable al router, lo que se denomina conexión multivía, no es necesario pero si se puede optar por esa opción es un plus de seguridad para tu alarma.</span>
                </div> 
            </div>
                
            <div class="question--negocio">
                <p class="question-descr">¿Tiene rejas u otra medida de seguridad en el local?</p>
                <div class="question">
                    <input type="checkbox" id="checkTieneNegocioSi" name="rejas" value="true" class="checkbox-question-next"/>
                    <label for="checkTieneNegocioSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkTieneNegocioNo" name="rejas" value="false" class="checkbox-question-next"/>
                    <label for="checkTieneNegocioNo">No</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Instalar rejas o persianas de seguridad en un negocio es siempre una buena opción y facilita la configuración del sistema de alarma.</span>
                </div> 
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Tienes alarma con otra empresa?</p>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaSiNegocio" name="alarma_competencia" value="true" class="checkbox-question-next"/>
                    <label for="checkAlarmaSiNegocio">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaNoNegocio" name="alarma_competencia" value="false" class="checkbox-question-next"/>
                    <label for="checkAlarmaNoNegocio">No</label>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Te asesoramos en el proceso de baja con tu empresa actual para que no tengas problemas a la hora de gestionar el trámite de baja.</span>
                </div>
            </div>
            
            <!-------------------tab2--------------------->
            
            <div class="question--negocio">
                <p class="question-descr">Seleccione el tipo de negocio</p>
                <div class="question">
                    <input type="checkbox" id="checkNegocioEmpresa" name="checkNegocioEmpresa" class="checkbox-question-next"/>
                    <select id="selectTipoNegocio" name="rama_negocio" class="checkbox-question-next">
                        <option value="no_option" selected="selected">Seleccione una opción</option>
                        <option value="salud">Sector Salud</option>
                        <option value="estancos">Estancos</option>
                        <option value="naves_peq">Naves de menos de 1500 metros</option>
                        <option value="hosteleria">Hostelería</option>
                        <option value="otros">Resto de Negocios</option>
                    </select>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Oferta válida para negocios de grado 2 de seguridad. No válido para negocios grado 3 joyerías, armerías, compro oro, etc.</span>
                </div>
            </div>

            
            <!----------------tab3--------------->
            
            <div class="question--negocio">
                <p class="question-descr">Número Telefónico Movil</p>
                <div class="question__input-wrapper">
                    <input type="text" id="country_code_business" name="country_code" value="+34" class="input-group-addon" />
                    <!--
                    <div id="verify-country-code" class="input-group-addon">+34</div>
                    -->
                    <input type="text" id="phone_number_business" name="phone_number"  placeholder="987654321" required class="question__input"/>
                    <input type="hidden" id="via_business" name="via" value="sms" />
                    <div class="question__button" id="request_verification_business">Verificar</div>
                </div>
                <div class="center_text">
                    <span class="request_leyenda">Te mandaremos un código a tu teléfono móvil para confirmar que es un número correcto, te mandaremos tu precio de oferta cerrado al mismo número mediante un mensaje de Whatsapp. Al realizar ésta acción aceptas la comunicación con alarmas.plus a través de éste medio.</span>
                </div>                 
            </div>      

            <div class="question--negocio">
                <p class="question-descr" id="desc_verify_token_business">Por favor, escriba el código de verificación enviado a</p>
                <div class="question__input-wrapper">

                    <input type="text" id="verification_code_business" placeholder="Código de Verificación" class="question__input" value="" />
                    <div class="question__button" id="verify_token_business">Enviar</div>
                </div>                
                <div class="phone-verification-code-links">

                    <div class="dont_receive_code">
                        <p>No ha recibido un código?</p>
                        <ul id="verification-resend-code_business" class="list-unstyled">
                            <li id="resend_counter_business" class="resend_counter">Enviando código de verificación por SMS (125)</li>
                            <li><a id="verification-resend-link_business" class="verification-resend-link oculto">Reenviar Código</a></li>
                            <li><a id="verification-change-link_business" class="verification-change-link oculto">Cambiar número telefónico</a></li>
                        </ul>
                    </div>
                </div>                
            </div>

            <!----------------Datos Personales--------------->

            <div id="tab3_business" class="question--negocio tab3">
                <div class="tab3__row">
                    <div class="tab3__descr">Nombre <small>*</small></div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3NegacioNombre" name="nombre">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Email</div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3NegacioEmail" name="correo">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">¿Código postal de tu negocio?</div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3NegocioInputCodigoPostal" name="codigo_postal">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">He leido y acepto la politica de privacidad<small>*</small></div>
                    <div class="tab3__input">
                        <input type="checkbox" id="checkTab3AceptoNegocio" name="checkTab3AceptoNegocio"/>
                        <label for="checkTab3AceptoNegocio">Acepto
                            <a href="https://alarmas.plus/politica-de-privacidad" class="tab3__link">
                                https://alarmas.plus/politica-de-privacidad
                            </a>
                        </label>
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="calcula-button question__button" id="tab3NegocioCalcula">Calcula tu precio ya</div>
                </div>

            </div>
        </form>
    </div>

    <div id="waiting" class="waiting"><!-- Place at bottom of page --></div>

</div>