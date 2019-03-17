<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/public
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */

require_once( plugin_dir_path( __FILE__ ) .'/../vendor/autoload.php');

use Authy\AuthyApi;
use Twilio\Rest\Client;

class Alarm_Estimate_Form_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Alarm_Estimate_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Alarm_Estimate_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/alarm-estimate-form-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'bootstrap_css', 
  					'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', 
  					array(), 
  					'4.1.3'
  					); 


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Alarm_Estimate_Form_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Alarm_Estimate_Form_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/alarm-estimate-form-public.js', array( 'jquery' ), $this->version, false );
		$title_nonce = wp_create_nonce('alarm_estimate_form');

	    wp_localize_script('jquery', 'alarm_estimate_form_ajax_obj', array(
	        'ajax_url' => admin_url( 'admin-ajax.php' ),
	        'nonce'    => $title_nonce,

	    ));

	    wp_enqueue_script( 'popper_js', 
  					'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 
  					array(), 
  					'1.14.3', 
  					true); 
	    wp_enqueue_script( 'bootstrap_js', 
  					'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', 
  					array('jquery','popper_js'), 
  					'4.1.3', 
  					true); 


	}

	/**
	 * Definir el shortcode para mostrar el formulario.
	 *
	 **/
	public function shortcode_alarm_estimate_form($atts, $content = null){

		$template_file = dirname(__FILE__) .'/partials/alarm-estimate-form-public-display.php';
		$html = file_get_contents($template_file);
		ob_start();
		?>
		<?php echo $html;?>
	    <?php
	    $data = ob_get_clean();
	    return $data;
	}


	/**
	 * Designs for displaying Notices
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var $message - String - The message we are displaying
	 * @var $status   - Boolean - its either true or false
	 **/
	public function return_success($message, $status = true) {
		$class =  ($status) ? 'notice notice-success' : 'notice notice-error';
		$message = __( $message, 'sample-text-domain' );
		$response = sprintf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );

		return $response;
	}

	/**
	 * Displays Error Notices
	 *
	 * @since    1.0.0
	 * @access   private
	 **/
	public function DisplayError($message = "Aww!, there was an error.") {
		wp_send_json_error(
		    array( 
            		'message' => $message
            	)
		  );
	}

	/**
	 * Displays Success Notices
	 *
	 * @since    1.0.0
	 * @since    1.0.0
	 **/
	public function DisplaySuccess($message, $country_code = '', $phone_number = '', $via = '' ) { 
		wp_send_json_success(
			    array( 
            		'message' => $message,
            		'country_code' => $country_code,
            		'phone_number' => $phone_number,
            		'via' => $via
            	)
			 );
	}

	/**
	 * Enviar la solicitud de verificacion al numero telefonico
	 *
	 **/
	public function alarm_estimate_form_request_verification() {
		if( ! wp_verify_nonce( $_POST['nonce_code'], 'alarm_estimate_form' ) ) die( 'Stop!');
		if( !isset($_POST['data']['request_verification']) ){ self::DisplayError('Formulario no válido');return; }

		$country_code = (isset($_POST['data']['country_code']) ) ? $_POST['data']['country_code'] : '';
		$phone_number = (isset($_POST['data']['phone_number']) )  ? $_POST['data']['phone_number']  : '';
		$via = (isset($_POST['data']['via']) ) ? $_POST['data']['via'] : '';

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); #alarm-estimate-form is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			/*
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationStart($phone_number, $country_code, $via);

			if ($response->ok()) {
                self::DisplaySuccess($response->message(), $country_code, $phone_number, $via);
            } else {
                self::DisplayError($response->errors()->message);
            }		
			*/
			self::DisplaySuccess("Código Enviado", $country_code, $phone_number, $via);
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

	/**
	 * Verificar el token recibido por SMS si es valido
	 *
	 **/
	public function alarm_estimate_form_verify_token() {
		if( ! wp_verify_nonce( $_POST['nonce_code'], 'alarm_estimate_form' ) ) die( 'Stop!');
		if( !isset($_POST['data']['verify_token']) ){ self::DisplayError('Formulario no válido');return; }
		
		$country_code = (isset($_POST['data']['country_code']) ) ? $_POST['data']['country_code'] : '';
		$phone_number = (isset($_POST['data']['phone_number']) )  ? $_POST['data']['phone_number']  : '';
		$via = (isset($_POST['data']['via']) ) ? $_POST['data']['via'] : '';
		$verification_code = (isset($_POST['data']['verification_code']) ) ? $_POST['data']['verification_code'] : '';

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); #alarm-estimate-form is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			/*
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationCheck($phone_number, $country_code, $verification_code);
			if ($response->ok()) {
                self::DisplaySuccess($response->message(), $country_code, $phone_number, $via);
            } else {
                self::DisplayError($response->errors()->message);
            }	
            */
            self::DisplaySuccess("Número Verificado", $country_code, $phone_number, $via);
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

	/**
	 * Guardar los datos recibidos desde el formulario a la  BDD
	 * y llamar a la función de enviar mensaje por whatsapp
	 *
	 **/

	public function alarm_estimate_form_submit() {
		global $wpdb;
		$table_name = $wpdb->prefix . "alarm_estimate_form";

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form');

		if( isset( $_POST['nonce_code'] ) && wp_verify_nonce( $_POST['nonce_code'], 'alarm_estimate_form') ) {

			$data =  $_POST['data'] ? $_POST['data'] : '';
			$rama_alarma =  $_POST['rama_alarma'] ? $_POST['rama_alarma'] : '';
		    parse_str($data, $dataArray);
		    $render_variables = array(
		        'nombre' => isset($dataArray['nombre'])? $dataArray['nombre'] : null,
		        'correo' => isset($dataArray['correo'])? $dataArray['correo'] : null,
		        'codigo_postal' => isset($dataArray['codigo_postal'])? $dataArray['codigo_postal'] : null,
		        'codigo_area' => isset($dataArray['country_code'])? $dataArray['country_code'] : null,
		        'telefono' => isset($dataArray['phone_number'])? $dataArray['phone_number'] : null,
		        'rama_alarma' => $rama_alarma, 
		        'residencia_habitual' => isset($dataArray['residencia_habitual'])? self::convertBoolBin($dataArray['residencia_habitual']) : null,
		        'rejas' => isset($dataArray['rejas'])? self::convertBoolBin($dataArray['rejas']) : null,
		        'internet' => isset($dataArray['internet'])? self::convertBoolBin($dataArray['internet']) : null,
		        'historial_robos' => isset($dataArray['historial_robos'])? self::convertBoolBin($dataArray['historial_robos']) : null,
		        'alarma_competencia' => isset($dataArray['alarma_competencia'])? self::convertBoolBin($dataArray['alarma_competencia']) : null,
		        'tipo_vivienda' => isset($dataArray['tipo_vivienda'])? $dataArray['tipo_vivienda'] : null,
		        'casa_mayor_180mts' => isset($dataArray['casa_mayor_180mts'])? self::convertBoolBin($dataArray['casa_mayor_180mts']) : null,
		        'rama_negocio' => isset($dataArray['rama_negocio'])? $dataArray['rama_negocio'] : null,
		        'fecha' => current_time('mysql', 1)
		    );

		    $paquetes = self::obtenerPaquetes();

		    if ($rama_alarma === 'hogar'){
		    	if ($render_variables['tipo_vivienda'] === 'piso') {
		    		$render_variables['paquete'] = $paquetes['paqueteD']['slug'];
		    	} else {
		    		if ($render_variables['casa_mayor_180mts'] === '1') {
		    			$render_variables['paquete'] = $paquetes['paqueteE']['slug'];
		    		} else {
		    			$render_variables['paquete'] = $paquetes['paqueteD']['slug'];
		    		}
		    	}
		    }

		    if ($rama_alarma === 'negocio'){
		    	switch ($render_variables['rama_negocio']) {
		    		case 'salud':
		    			$render_variables['paquete'] = $paquetes['paqueteA']['slug'];
		    			break;
		    		case 'estancos':
		    			$render_variables['paquete'] = $paquetes['paqueteA']['slug'];
		    			break;
		    		case 'naves_peq':
		    			$render_variables['paquete'] = $paquetes['paqueteA']['slug'];
		    			break;
		    		case 'hosteleria':
		    			$render_variables['paquete'] = $paquetes['paqueteB']['slug'];
		    			break;
		    		case 'otros':
		    			$render_variables['paquete'] = $paquetes['paqueteC']['slug'];
		    			break;
		    		default:
		    			$render_variables['paquete'] = $paquetes['paqueteC']['slug'];
		    			break;
		    	}
		    }
		    
			$insert = $wpdb->insert($table_name,$render_variables);

			if ($insert) {
				if ($api_details['api_seleccion'] == 'twilio') {
					self::send_whatsapp_message($render_variables);	
				} else {
					self::send_message_apiwha($render_variables);
				}
							
			} else {
				self::DisplayError( $wpdb->last_error );
			}
			
		} else {
			wp_die( __( 'Invalid nonce specified', 'alarm_estimate_form' ), __( 'Error', 'alarm_estimate_form' ), array(
							'response' 	=> 403,
							'back_link' => 'index.php',

					) );
		}
	}

	/**
	 * Función que procesará el envío del mensaje por whatsapp
	 *
	 **/
	public function send_whatsapp_message($data='') {

		$to = (isset($data['telefono']) ) ? 'whatsapp:'.$data['codigo_area'].$data['telefono'] : '';
		$sender_id = 'whatsapp:'.'+14155238886';
		$message = 'Your Wordpress.Desktop order of Estimate has shipped and should be delivered on '.$data['fecha'].'. Details : Websendex Sr/a. '.$data['nombre'].' soy Manuel Soto su asesor de seguridad de Tyco.  Le agradezco que me haya atendido y procedo a mandarle la información de la oferta tal y como hemos acordado, para cualquier duda o aclaración de la misma le recuerdo que me tiene disponible, mi teléfono directo es el 617079129 (también whatsapp). Adjunto le envío la información sobre sistema de alarma Visonic de Tyco con cámara integrada y el nuevo servicio de asistencia legalitas. ¡VENTAJAS PROMOCIÓN ONLINE!  Kit Hogar Tyco Alert + Servicio Legalitas: Tras la conversación telefónica mantenida, le indico como se quedaría su configuración con un total de: 2 Vídeo detectores. 1 Detectores de movimiento (O 1 contacto magnético). 1 Central de alarma con pantalla Módulo GSM/GPRS. Sirena de sonido ascendente con 81 decibelios (incluida en central). 1 Teclado extra bidireccional portátil (incluido emergencias médicas e incendios). 1 Mando a distancia / O pulsador SOS. Carteles exteriores. Los servicios que van incluidos en la cuota son: Mantenimiento 100% incluido. Envío de los vídeos del salto de alarma a su móvil de forma Inmediata. Conexión a Central Receptora de Alarmas las 24h del día, los 365 días del año. Supervisión de la línea GPRS cada 10 minutos. Envío de email con el control de todas las entradas y salidas de los usuarios de la alarma. Aviso de corte de luz. Anti-inhibidor de alta potencia. Conexión Multivía - doble conexión. Servicio asistencia Legalitas.';

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); 

		if(is_array($api_details) AND count($api_details) != 0) {
			$TWILIO_SID = $api_details['api_sid'];
			$TWILIO_TOKEN = $api_details['api_auth_token'];
		}

		try {
			$to = explode(',', $to);
			$client = new Client($TWILIO_SID, $TWILIO_TOKEN);
			$response = $client->messages->create(
				$to,
				array(
					'from' => $sender_id,
					'body' => $message
				)
			);

			if (is_null($response->errorMessage)) {
		        self::DisplaySuccess("Registro insertado en la BDD y enviado por Whatsapp");
		    } else {
		        self::DisplayError($response->errorMessage);
		    }	
		    //self::DisplaySuccess("Registro insertado en la BDD y enviado por Whatsapp");
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

	public function convertBoolBin($item='') {
		if ($item === 'true') return '1';
		if ($item === 'false') return '0';
		return $item;
	}

	public function alert($value='') {
		echo "<script type='text/javascript'>
				    alert('".$value."');
				    </script>";
	}

	public function send_message_apiwha($data='') {
		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); 

		if(is_array($api_details) AND count($api_details) != 0) {
			$my_apikey = $api_details['apiwha_apikey'];
			$destination = str_replace('+', '', $data['codigo_area']).$data['telefono'];
		}

		$paquetes = self::obtenerPaquetes();
		$message = $paquetes[$data['paquete']]['descripcion']; 
		$mensaje = self::reemplazarVariables($message, $data);

		$api_url = "http://panel.apiwha.com/send_message.php"; 
		$api_url .= "?apikey=". urlencode ($my_apikey); 
		$api_url .= "&number=". urlencode ($destination);
		$api_url .= "&text=". urlencode ($mensaje); 
		//$my_result_object = json_decode(file_get_contents($api_url, false)); 
		
		try {
			
			$response = wp_remote_get( $api_url );
			if ( is_array( $response ) ) {
			 	$response_code = wp_remote_retrieve_response_code( $response );
				$body = json_decode( wp_remote_retrieve_body( $response ), true );
			}

			if ($response_code === 200) {
				if ($body['success']) {
					self::DisplaySuccess($body['description']);
				} else {
					self::DisplayError($body['description']);
				}
								
			} else {
				if (is_wp_error( $response )){
					self::DisplayError($response->get_error_message());
				} else {
					if (is_array( $response )) {
						self::DisplayError($response['response']['message']);
					} else {
						self::DisplayError('Error Desconocido !');
					}				
				}
				
			}
			
			//self::DisplaySuccess('Mensaje Enviado');
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
		
	}

	/**
	 * Obtener datos de los paquetes definidos desde la BDD
	 *
	 **/
	public function obtenerPaquetes() {
		global $wpdb;
		$table_name = $wpdb->prefix . "alarm_estimate_form_paquete";

		$results = $wpdb->get_results("
			SELECT id, slug, nombre, descripcion FROM {$table_name}", ARRAY_A);

		$registros = array();

		foreach ($results as $key=>$registro) {
			$data = array_map(function($item){
				return urldecode($item);
			},$registro);
			
			$registros[$data['slug']] = $data;
		}

		return $registros;
	}

	/**
	 * Reemplazar las variables por sus valores del cliente en los
	 * mensajes definidos en los paquetes
	 *
	 **/
	public function reemplazarVariables($message='', $data='') {

		$message = str_replace ('{{nombre-cliente}}', $data['nombre'], $message);
		$message = str_replace ('{{fecha-solicitud}}', $data['fecha'], $message);
		$message = str_replace ('{{correo-cliente}}', $data['correo'], $message);
		$message = str_replace ('{{telefono-cliente}}', $data['telefono'], $message);

		return $message;
	}

}
