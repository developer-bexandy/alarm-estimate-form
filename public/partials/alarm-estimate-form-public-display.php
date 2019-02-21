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
        <div class="calculator__tab calculator__tab--active calculator__tab--first calculator__tab--triangle">
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

    <div class="calculator__question calculator__question--hogar">
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
            </div>

            <div class="question--horar">
                <p class="question-descr">¿Han robado alguna vez o cerca suya?</p>
                <div class="question">
                    <input type="checkbox" id="checkRobabadoAlgunaSi" name="historial_robos" value="true" class="checkbox-question-next"/>
                    <label for="checkRobabadoAlgunaSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkRobabadoAlgunaNo" name="historial_robos" value="false" class="checkbox-question-next"/>
                    <label for="checkRobabadoAlgunaNo">No</label>
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
            <div class="question--horar">
                <p class="question-descr">Número Telefónico Movil</p>
                <div class="question__input-wrapper">
                    <input type="hidden" id="country_code" name="country_code" value="+58" />
                    <div id="verify-country-code" class="input-group-addon">+58</div>
                    <input type="text" id="phone_number" name="phone_number"  placeholder="987654321" required class="question__input"/>
                    <input type="hidden" id="via" name="via" value="sms" />
                    <div class="question__button" id="request_verification">Verificar</div>
                </div>
                <div class="center_text">
                    <span class="request_leyenda"><?php esc_attr_e( 'Nos pondremos en contacto con usted en el número de arriba con un código de verificación', 'alarm-estimate-form' ) ?></span>
                </div>                
            </div>      

            <div class="question--horar">
                <p class="question-descr" id="desc_verify_token">Por favor, escriba el código de verificación enviado a</p>
                <div class="question__input-wrapper">

                    <input type="text" id="verification_code" placeholder="Código de Verificación" class="question__input" value="" />
                    <div class="question__button" id="verify_token">Enviar</div>
                </div>                
                <div class="phone-verification-code-links">
                    <p id="change_via" class="change_via"><a> Desea verificar con una llamada en lugar de SMS?</a></p>

                    <div class="dont_receive_code">
                        <p>No ha recibido un código?</p>
                        <ul id="verification-resend-code" class="list-unstyled">
                            <li id="resend_counter" class="resend_counter">Reenviar código (15)</li>
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
                <p class="question-descr">¿Cuantos empleados tiene habitualmente el negocio?</p>
                <div class="question">
                    <input type="checkbox" id="checkSolo" name="cantidad_empleados_negocio" value="solo yo" class="checkbox-question-next"/>
                    <label for="checkSolo">Solo estoy yo</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkEmpleados2" name="cantidad_empleados_negocio" value="2 a 4" class="checkbox-question-next"/>
                    <label for="checkEmpleados2">De 2 a 4 empleados</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkEmpleados4" name="cantidad_empleados_negocio" value="mas de 4" class="checkbox-question-next"/>
                    <label for="checkEmpleados4">Más de 4 empleados‎</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Cuando esta abierto su negocio?</p>
                <div class="question">
                    <input type="checkbox" id="checkPorLaManana" name="horario_negocio" value="mañana" class="checkbox-question-next"/>
                    <label for="checkPorLaManana">Por la mañana</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkPorLaTarde" name="horario_negocio" value="tarde" class="checkbox-question-next"/>
                    <label for="checkPorLaTarde">Por la tarde</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkMañanaYTarde‎" name="horario_negocio" value="mañana y tarde" class="checkbox-question-next"/>
                    <label for="checkMañanaYTarde‎">Mañana y tarde‎‎</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkPorlanoche‎" name="horario_negocio" value="noche" class="checkbox-question-next"/>
                    <label for="checkPorlanoche‎">Por la noche‎‎</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkLas24hHoras‎" name="horario_negocio" value="24 horas" class="checkbox-question-next"/>
                    <label for="checkLas24hHoras‎">Las 24 horas‎‎</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Han robado con anterioridad en su negocio o a negocios cercanos?</p>
                <div class="question">
                    <input type="checkbox" id="checkHanRobadoSi" name="historial_robos" value="true" class="checkbox-question-next"/>
                    <label for="checkHanRobadoSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkcheckHanRobadoNo" name="historial_robos" value="false" class="checkbox-question-next"/>
                    <label for="checkcheckHanRobadoNo">No</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Tienes internet en el negocio?</p>
                <div class="question">
                    <input type="checkbox" id="checkInternetNegocioSi" name="internet" value="true" class="checkbox-question-next"/>
                    <label for="checkInternetNegocioSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkInternetNegocioNo" name="internet" value="false" class="checkbox-question-next"/>
                    <label for="checkInternetNegocioNo">No</label>
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
            </div>
            
            <!-------------------tab2--------------------->
            
            <div class="question--negocio">
                <p class="question-descr">¿El propietario del negocio es una empresa o un autonomo?</p>
                <div class="question">
                    <input type="checkbox" id="checkNegocioEmpresa" name="tipo_negocio" value="empresa" class="checkbox-question-next"/>
                    <label for="checkNegocioEmpresa">Empresa</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkNegocioAutonomo" name="tipo_negocio" value="autonomo" class="checkbox-question-next"/>
                    <label for="checkNegocioAutonomo">Autónomo</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">Seleccione el tipo de negocio</p>
                <div class="question">
                    <input type="checkbox" id="checkNegocioEmpresa" name="checkNegocioEmpresa" class="checkbox-question-next"/>
                    <select id="selectTipoNegocio" name="rama_negocio" class="checkbox-question-next">
                        <option value="salud">Salud</option>
                        <option value="hosteleria">Hosteleria</option>
                        <option value="peluqueria">Peluquería</option>                        
                        <option value="informatica">Tienda Informática</option>
                        <option value="gimnasio">Gimnasio</option>
                        <option value="colegio">Colegio</option>
                        <option value="bazar">Bazar</option>
                        <option value="alimentacion">Alimentación</option>
                        <option value="otros" selected="selected">Resto de Negocios</option>
                    </select>
                    <label for="selectTipoNegocio">Oferta válida para negocios de grado 2 de seguridad. No válido para negocios grado 3 joyerías, armerías, compro oro, etc</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Es una nave de más de 1500 metros cuadrados? </p>
                <div class="question">
                    <input type="checkbox" id="checkNegocioMas1500" name="nave_mayor_1500mts" value="true" class="checkbox-question-next"/>
                    <label for="checkNegocioMas1500">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkNegocioMenos1500" name="nave_mayor_1500mts" value="false" class="checkbox-question-next"/>
                    <label for="checkNegocioMenos1500">No</label>
                </div>
            </div>

            
            <!----------------tab3--------------->
            
            <div class="question--negocio">
                <p class="question-descr">Número Telefónico Movil</p>
                <div class="question__input-wrapper">
                    <input type="hidden" id="country_code_business" name="country_code" value="+58" />
                    <div id="verify-country-code" class="input-group-addon">+58</div>
                    <input type="text" id="phone_number_business" name="phone_number"  placeholder="+2348059794251" required class="question__input"/>
                    <input type="hidden" id="via_business" name="via" value="sms" />
                    <div class="question__button" id="request_verification_business">Verificar</div>
                </div>
                <div class="center_text">
                    <span class="request_leyenda"><?php esc_attr_e( 'Nos pondremos en contacto con usted en el número de arriba con un código de verificación', 'alarm-estimate-form' ) ?></span>
                </div>                
            </div>      

            <div class="question--negocio">
                <p class="question-descr" id="desc_verify_token_business">Por favor, escriba el código de verificación enviado a</p>
                <div class="question__input-wrapper">

                    <input type="text" id="verification_code_business" placeholder="Código de Verificación" class="question__input" value="" />
                    <div class="question__button" id="verify_token_business">Enviar</div>
                </div>                
                <div class="phone-verification-code-links">
                    <p id="change_via_business" class="change_via"><a> Desea verificar con una llamada en lugar de SMS?</a></p>

                    <div class="dont_receive_code">
                        <p>No ha recibido un código?</p>
                        <ul id="verification-resend-code_business" class="list-unstyled">
                            <li id="resend_counter_business" class="resend_counter">Reenviar código (15)</li>
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
                        <input type="text" class="question__input" id="postalNegocioInput" name="codigo_postal">
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