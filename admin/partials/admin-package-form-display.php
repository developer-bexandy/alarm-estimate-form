<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrapper">
  <div id="package_form_feedback"></div><!-- Noticaciones -->

  <form id="package_form_ajax" action="" method="POST" accept-charset="utf-8"> 
    <div class="accordion" id="accordionExample">    
      <!-- Oferta A -->
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Paquete A
            </button>
          </h2>
        </div><!-- card-header Oferta A -->

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="form-group">
              <label for="nombrePaqueteA">Nombre de la Oferta</label>
              <input type="text" class="form-control" id="nombrePaqueteA" name="nombrePaqueteA" placeholder="Escriba un nombre para ésta oferta">
            </div><!-- form-group Nombre Oferta A -->
            <div class="form-group">
              <label for="descripcionPaqueteA">Descripción de la oferta</label>
              <textarea class="form-control" id="descripcionPaqueteA" name="descripcionPaqueteA" rows="3" placeholder="Escriba el mensaje de la oferta que será enviada al cliente vía whatsapp, puede incluir cualquiera de las variables disponibles"></textarea>
              <small id="emailHelp" class="form-text text-muted">variables disponibles: {{nombre-cliente}}, {{fecha-solicitud}}, {{correo-cliente}}, {{telefono-cliente}}.</small>
            </div><!-- form-group Descripcion Oferta A -->
            <div class="form-group">
              <label for="imgPaqueteA">Imagen Adjunto</label>
              <input type="file" class="" id="imgPaqueteA" name="imgPaqueteA" placeholder="Seleccione una imágen para enviar adjunto a ésta oferta">
              <img id="previewPaqueteA" src="" class="img-preview" with="200px">
            </div><!-- form-group Imagen Oferta A -->            
          </div><!-- card-body Oferta A -->
        </div><!-- collapse Oferta A -->
      </div><!-- card Oferta A -->
      
      <!-- Oferta B -->
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Paquete B
            </button>
          </h2>
        </div><!-- card-header Oferta B -->
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <div class="form-group">
              <label for="nombrePaqueteB">Nombre de la Oferta</label>
              <input type="text" class="form-control" id="nombrePaqueteB" name="nombrePaqueteB" placeholder="Escriba un nombre para ésta oferta">
            </div><!-- form-group Nombre Oferta B -->
            <div class="form-group">
              <label for="descripcionPaqueteB">Descripción de la oferta</label>
              <textarea class="form-control" id="descripcionPaqueteB" name="descripcionPaqueteB" rows="3" placeholder="Escriba el mensaje de la oferta que será enviada al cliente vía whatsapp, puede incluir cualquiera de las variables disponibles"></textarea>
              <small id="emailHelp" class="form-text text-muted">variables disponibles: {{nombre-cliente}}, {{fecha-solicitud}}, {{correo-cliente}}, {{telefono-cliente}}.</small>
            </div><!-- form-group Descripcion Oferta B -->
            <div class="form-group">
              <label for="imgPaqueteB">Imagen Adjunto</label>
              <input type="file" class="" id="imgPaqueteB" name="imgPaqueteB" placeholder="Seleccione una imágen para enviar adjunto a ésta oferta">
              <img id="previewPaqueteB" src="" class="img-preview" with="200px">
            </div><!-- form-group Imagen Oferta B -->
          </div><!-- card-body Oferta B -->
        </div><!-- collapse Oferta B -->
      </div><!-- card Oferta B -->

      <!-- Oferta C -->
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Paquete C
            </button>
          </h2>
        </div><!-- card-header Oferta C -->
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <div class="form-group">
              <label for="nombrePaqueteC">Nombre de la Oferta</label>
              <input type="text" class="form-control" id="nombrePaqueteC" name="nombrePaqueteC" placeholder="Escriba un nombre para ésta oferta">
            </div><!-- form-group Nombre Oferta C -->
            <div class="form-group">
              <label for="descripcionPaqueteC">Descripción de la oferta</label>
              <textarea class="form-control" id="descripcionPaqueteC" name="descripcionPaqueteC" rows="3" placeholder="Escriba el mensaje de la oferta que será enviada al cliente vía whatsapp, puede incluir cualquiera de las variables disponibles"></textarea>
              <small id="emailHelp" class="form-text text-muted">variables disponibles: {{nombre-cliente}}, {{fecha-solicitud}}, {{correo-cliente}}, {{telefono-cliente}}.</small>
            </div><!-- form-group Descripcion Oferta C -->
            <div class="form-group">
              <label for="imgPaqueteC">Imagen Adjunto</label>
              <input type="file" class="" id="imgPaqueteC" name="imgPaqueteC" placeholder="Seleccione una imágen para enviar adjunto a ésta oferta">
              <img id="previewPaqueteC" src="" class="img-preview" with="200px">
            </div><!-- form-group Imagen Oferta C -->
          </div><!-- card-body Oferta C -->
        </div><!-- collapse Oferta C -->
      </div><!-- card Oferta C -->

      <!-- Oferta D -->
      <div class="card">
        <div class="card-header" id="headingFour">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Paquete D
            </button><!-- card-header Oferta D -->
          </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            <div class="form-group">
              <label for="nombrePaqueteD">Nombre de la Oferta</label>
              <input type="text" class="form-control" id="nombrePaqueteD" name="nombrePaqueteD" placeholder="Escriba un nombre para ésta oferta">
            </div><!-- form-group Nombre Oferta D -->
            <div class="form-group">
              <label for="descripcionPaqueteD">Descripción de la oferta</label>
              <textarea class="form-control" id="descripcionPaqueteD" name="descripcionPaqueteD" rows="3" placeholder="Escriba el mensaje de la oferta que será enviada al cliente vía whatsapp, puede incluir cualquiera de las variables disponibles"></textarea>
              <small id="emailHelp" class="form-text text-muted">variables disponibles: {{nombre-cliente}}, {{fecha-solicitud}}, {{correo-cliente}}, {{telefono-cliente}}.</small>
            </div><!-- form-group Descripcion Oferta D -->
            <div class="form-group">
              <label for="imgPaqueteD">Imagen Adjunto</label>
              <input type="file" class="" id="imgPaqueteD" name="imgPaqueteD" placeholder="Seleccione una imágen para enviar adjunto a ésta oferta">
              <img id="previewPaqueteD" src="" class="img-preview" with="200px">
            </div><!-- form-group Imagen Oferta D -->
          </div><!-- card-body Oferta D -->
        </div><!-- collapse Oferta D -->
      </div><!-- card Oferta D -->

      <!-- Oferta E -->
      <div class="card">
        <div class="card-header" id="headingFive">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              Paquete E
            </button>
          </h2>
        </div><!-- class-header Oferta E -->
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
          <div class="card-body">
            <div class="form-group">
              <label for="nombrePaqueteE">Nombre de la Oferta</label>
              <input type="text" class="form-control" id="nombrePaqueteE" name="nombrePaqueteE" placeholder="Escriba un nombre para ésta oferta">
            </div><!-- form-group Nombre Oferta E -->
            <div class="form-group">
              <label for="descripcionPaqueteE">Descripción de la oferta</label>
              <textarea class="form-control" id="descripcionPaqueteE" name="descripcionPaqueteE" rows="3" placeholder="Escriba el mensaje de la oferta que será enviada al cliente vía whatsapp, puede incluir cualquiera de las variables disponibles"></textarea>
              <small id="emailHelp" class="form-text text-muted">variables disponibles: {{nombre-cliente}}, {{fecha-solicitud}}, {{correo-cliente}}, {{telefono-cliente}}.</small>
            </div><!-- form-group Descripcion Oferta E -->
            <div class="form-group">
              <label for="imgPaqueteE">Imagen Adjunto</label>
              <input type="file" class="" id="imgPaqueteE" name="imgPaqueteE" placeholder="Seleccione una imágen para enviar adjunto a ésta oferta">
              <img id="previewPaqueteE" src="" class="img-preview" with="200px">
            </div><!-- form-group Imagen Oferta E -->
          </div><!-- card-body Oferta E -->
        </div><!-- collapse Oferta E -->
      </div><!-- card Oferta E -->

      <div class="form-group">
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar"></p>
      </div><!-- form-group Submit Button -->
    </div>
  </form>

  

  <div id="waiting" class="waiting"></div><!-- Place at bottom of page - waiting ajax animation -->
  
</div>
