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
            <span class="tab__descr">¿Que necesitas?</span>
        </div>

        <div class="calculator__tab calculator__tab--second calculator__tab--triangle">
            <span class="tab__circle">2</span>
            <span class="tab__descr">Seguridad actual</span>
        </div>

        <div class="calculator__tab calculator__tab--third calculator__tab--last">
            <span class="tab__circle">3</span>
            <span class="tab__descr">Precio de de tu alarma</span>
        </div>
    </div>

    <div class="calculator__question calculator__question--first">
        <p class="question-descr">¿Necesitar proteger un hogar o un negocio?</p>
        <div class="question">
            <input type="checkbox" id="checkHogar" name="checkHogar" class="checkbox-question-next"/>
            <label for="checkHogar">Hogar</label>
        </div>
        <div class="question">
            <input type="checkbox" id="checkNegocio" name="checkNegocio" class="checkbox-question-next"/>
            <label for="checkNegocio">Negocio</label>
        </div>
    </div>

    <div class="calculator__question calculator__question--hogar">
            <form id="hogarForm">
            <div class="question--horar" style="display: block">
                <p class="question-descr">¿Que tipo de hogar?</p>
                <div class="question">
                    <input type="checkbox" id="checkPiso" name="checkPiso" class="checkbox-question-next"/>
                    <label for="checkPiso">Piso</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkChalet" name="checkChalet" class="checkbox-question-next"/>
                    <label for="checkChalet">Chalet</label>
                </div>
            </div>

            <div class="question--horar ">
                <p class="question-descr">¿Donde esta la vivienda?</p>
                <div class="question">
                    <input type="checkbox" id="checkEn" name="checkEn" class="checkbox-question-next"/>
                    <label for="checkEn">En núcleo urbano</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkFuera" name="checkFuera" class="checkbox-question-next"/>
                    <label for="checkFuera">Fuera de núcleo urbano</label>
                </div>
            </div>

            <div class="question--horar">
                <p class="question-descr">¿Es una vivienda habitual o suele estar vaciá?</p>
                <div class="question">
                    <input type="checkbox" id="checkHabitual" name="checkHabitual" class="checkbox-question-next"/>
                    <label for="checkHabitual">Habitual</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkVacia" name="checkVacia" class="checkbox-question-next"/>
                    <label for="checkVacia">Vaciá</label>
                </div>
            </div>

            <!----------------tab2--------------->

            <div class="question--horar">
                <p class="question-descr">¿Tienes alarma con otra empresa?</p>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaSi" name="checkAlarmaSi" class="checkbox-question-next"/>
                    <label for="checkAlarmaSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaNo" name="checkAlarmaNo" class="checkbox-question-next"/>
                    <label for="checkAlarmaNo">No</label>
                </div>
            </div>

            <div class="question--horar">
                <p class="question-descr">¿tienes rejas en la vivienda?</p>
                <div class="question">
                    <input type="checkbox" id="checkRejasSi" name="checkRejasSi" class="checkbox-question-next"/>
                    <label for="checkRejasSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkRejasNo" name="checkRejasNo" class="checkbox-question-next"/>
                    <label for="checkRejasNo">No</label>
                </div>
            </div>

            <div class="question--horar">
                <p class="question-descr">¿Tienes internet en el domicilio?</p>
                <div class="question">
                    <input type="checkbox" id="checkInternetSi" name="checkInternetSi" class="checkbox-question-next"/>
                    <label for="checkInternetSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkInternetNo" name="checkInternetNo" class="checkbox-question-next"/>
                    <label for="checkInternetNo">No</label>
                </div>
            </div>

            <div class="question--horar">
                <p class="question-descr">Código postal de tu vivienda</p>
                <div class="question__input-wrapper">
                    <input type="text" id="questionInputVivienda" name="questionInputVivienda" class="question__input" >
                    <div class="question__button" id="questionButtontVivienda">Continuar</div>
                </div>
            </div>
                <div class="question--negocio">
                    <p class="question-descr">¿Han robabado alguna vez o cerca suya?</p>
                    <div class="question">
                        <input type="checkbox" id="checkRobabadoAlgunaSi" name="checkRobabadoAlgunaSi" class="checkbox-question-next"/>
                        <label for="checkRobabadoAlgunaSi">Si</label>
                    </div>
                    <div class="question">
                        <input type="checkbox" id="checkRobabadoAlgunaNo" name="checkRobabadoAlgunaNo" class="checkbox-question-next"/>
                        <label for="checkRobabadoAlgunaNo">No</label>
                    </div>
                </div>
            <!----------------tab3--------------->

            <div class="question--horar tab3">
                <div class="tab3__row">
                    <div class="tab3__descr">Nombre <small>*</small></div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3HorarNombre" name="tab3HorarNombre">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Teléfono <small>*</small></div>
                    <div class="tab3__input tab3__input--telefono">
                        <input type="text" class="question__input" id="tab3HorarInputTel" name="tab3HorarInputTel">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Email</div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3HorarInputEmail" name="tab3HorarInputEmail">
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
                    <input type="checkbox" id="checkSolo" name="checkSolo" class="checkbox-question-next"/>
                    <label for="checkSolo">Solo estoy yo</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkEmpleados2" name="checkEmpleados2" class="checkbox-question-next"/>
                    <label for="checkEmpleados2">De 2 a 4 empleados</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkEmpleados4" name="checkEmpleados4" class="checkbox-question-next"/>
                    <label for="checkEmpleados4">Más de 4 empleados‎</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Cuando esta abierto su negocio?</p>
                <div class="question">
                    <input type="checkbox" id="checkPorLaManana" name="checkPorLaManana" class="checkbox-question-next"/>
                    <label for="checkPorLaManana">Por la mañana</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkPorLaTarde" name="checkPorLaTarde" class="checkbox-question-next"/>
                    <label for="checkPorLaTarde">Por la tarde</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkMañanaYTarde‎" name="checkMañanaYTarde‎" class="checkbox-question-next"/>
                    <label for="checkMañanaYTarde‎">Mañana y tarde‎‎</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkPorlanoche‎" name="checkPorlanoche‎" class="checkbox-question-next"/>
                    <label for="checkPorlanoche‎">Por la noche‎‎</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkLas24hHoras‎" name="checkLas24hHoras‎" class="checkbox-question-next"/>
                    <label for="checkLas24hHoras‎">Las 24 horas‎‎</label>
                </div>
            </div>
                <!-------------------tab2--------------------->

            <div class="question--negocio">
                <p class="question-descr">¿Tienes alarma con otra empresa?</p>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaSiNegocio" name="checkAlarmaSiNegocio" class="checkbox-question-next"/>
                    <label for="checkAlarmaSiNegocio">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkAlarmaNoNegocio" name="checkAlarmaNoNegocio" class="checkbox-question-next"/>
                    <label for="checkAlarmaNoNegocio">No</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Han robado con anterioridad en su negocio o a negocios cercanos?</p>
                <div class="question">
                    <input type="checkbox" id="checkHanRobadoSi" name="checkHanRobadoSi" class="checkbox-question-next"/>
                    <label for="checkHanRobadoSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkcheckHanRobadoNo" name="checkcheckHanRobadoNo" class="checkbox-question-next"/>
                    <label for="checkcheckHanRobadoNo">No</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Tienes internet en el negocio?</p>
                <div class="question">
                    <input type="checkbox" id="checkInternetNegocioSi" name="checkInternetNegocioSi" class="checkbox-question-next"/>
                    <label for="checkInternetNegocioSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkInternetNegocioNo" name="checkInternetNegocioNo" class="checkbox-question-next"/>
                    <label for="checkInternetNegocioNo">No</label>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Código postal de tu negocio?</p>
                <div class="question__input-wrapper">
                    <input type="text" class="question__input" id="postalNegocioInput" name="postalNegocioInput">
                    <div class="question__button" id="postalNegocioButton">Continuar</div>
                </div>
            </div>

            <div class="question--negocio">
                <p class="question-descr">¿Tiene rejas u otra medida de seguridad en el local?</p>
                <div class="question">
                    <input type="checkbox" id="checkTieneNegocioSi" name="checkTieneNegocioSi" class="checkbox-question-next"/>
                    <label for="checkTieneNegocioSi">Si</label>
                </div>
                <div class="question">
                    <input type="checkbox" id="checkTieneNegocioNo" name="checkTieneNegocioNo" class="checkbox-question-next"/>
                    <label for="checkTieneNegocioNo">No</label>
                </div>
            </div>

            <!----------------tab3--------------->

            <div class="question--negocio tab3">
                <div class="tab3__row">
                    <div class="tab3__descr">Nombre <small>*</small></div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3NegacioNombre" name="tab3NegacioNombre">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Teléfono <small>*</small></div>
                    <div class="tab3__input tab3__input--telefono">
                        <input type="text" class="question__input" id="tab3NegacioTel" name="tab3NegacioTel">
                    </div>
                </div>

                <div class="tab3__row">
                    <div class="tab3__descr">Email</div>
                    <div class="tab3__input">
                        <input type="text" class="question__input" id="tab3NegacioEmail" name="tab3NegacioEmail">
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



</div>