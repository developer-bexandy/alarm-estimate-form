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
	public function DisplaySuccess($message, $country_code = '', $phone_number = '', $request_id = '' ) { 
		wp_send_json_success(
			    array( 
            		'message' => $message,
            		'country_code' => $country_code,
            		'phone_number' => $phone_number,
            		'request_id' => $request_id
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
		$cancel = (isset($_POST['data']['cancel']) )  ? $_POST['data']['cancel']  : false;
		$request_id = (isset($_POST['data']['request_id']) ) ? $_POST['data']['request_id'] : '';

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); #alarm-estimate-form is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$NEXMO_API_KEY = $api_details['nexmo_api_key'];
			$NEXMO_API_SECRET = $api_details['nexmo_api_secret'];
		}

		$basic  = new \Nexmo\Client\Credentials\Basic($NEXMO_API_KEY , $NEXMO_API_SECRET);
		$client = new \Nexmo\Client($basic);

		$destination = str_replace('+', '', $country_code.$phone_number);

		try {

			if ($cancel || $request_id != '') {
			    $result = $client->verify()->cancel($request_id);
			} 
			
			$verification = $client->verify()->start([ 
				'number' => $destination,
				'brand'  => 'Alarmas Plus',
				'code_length'  => '4']);
				
			$request_id = $verification->getRequestId();

			if ($verification->getStatus() == '0') {
	            self::DisplaySuccess('Código Enviado', $country_code, $phone_number, $request_id);
	        } else {
	            self::DisplayError('Error Code: '.$verification->getStatus());
	        }		
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}

		self::DisplaySuccess("Código Enviado", $country_code, $phone_number, $request_id);
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
		$verification_code = (isset($_POST['data']['verification_code']) ) ? $_POST['data']['verification_code'] : '';
		$request_id = (isset($_POST['data']['verification_code']) ) ? $_POST['data']['request_id'] : '';
		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); #alarm-estimate-form is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$NEXMO_API_KEY = $api_details['nexmo_api_key'];
			$NEXMO_API_SECRET = $api_details['nexmo_api_secret'];
		}

		$basic  = new \Nexmo\Client\Credentials\Basic($NEXMO_API_KEY, $NEXMO_API_SECRET);
		$client = new \Nexmo\Client($basic);


		try {
			$verification = new \Nexmo\Verify\Verification($request_id);
			$result = $client->verify()->check($verification, $verification_code);


			if ($verification->getStatus() == '0') {
                self::DisplaySuccess('Número Verificado', $country_code, $phone_number, $request_id);
            } else {
                self::DisplayError('Error Code: '.$verification->getStatus());
            }	          
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}

		self::DisplaySuccess("Número Verificado", $country_code, $phone_number, $request_id);
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
				self::send_message_apiwha($render_variables);
	
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
		$image = $paquetes[$data['paquete']]['img_url']; 
		$mensaje = self::reemplazarVariables($message, $data);

		$error = false;
		$success_message = "";
		$error_message = "";

		if (!is_null($mensaje)) {
			$api_url = "http://panel.apiwha.com/send_message.php"; 
			$api_url .= "?apikey=". urlencode ($my_apikey); 
			$api_url .= "&number=". urlencode ($destination);
			$api_url .= "&text=". urlencode ($mensaje); 


			try {
			
				$response = wp_remote_get( $api_url );
	
				if ( is_array( $response ) ) {
					 $response_code = wp_remote_retrieve_response_code( $response );
					$body = json_decode( wp_remote_retrieve_body( $response ), true );
				}
	
				if ($response_code === 200) {
					if ($body['success']) {
						$success_message .= $body['description'].' ';					
					} else {
						$error = true;
						$error_message .= $body['description'].' ';
					}
									
				} else {
					if (is_wp_error( $response )){
						$error = true;
						$error_message .= $response->get_error_message().' ';
					} else {
						if (is_array( $response )) {
							$error = true;
							$error_message .= $response['response']['message'].' ';
						} else {
							$error = true;
							$error_message .= 'Error Desconocido !'.' ';
						}				
					}
					
				}
				
				//self::DisplaySuccess('Mensaje Enviado');
			} catch (Exception $e) {
				$error = true;
				$error_message .= $e->getMessage().' ';
			}

		}
		
		if (!is_null($image)) {
			$api_url = "http://panel.apiwha.com/send_message.php"; 
			$api_url .= "?apikey=". urlencode ($my_apikey); 
			$api_url .= "&number=". urlencode ($destination);
			$api_url .= "&text=". self::encodeImg(urlencode ($image)); 


			try {
			
				$response = wp_remote_get( $api_url );
	
				if ( is_array( $response ) ) {
					$response_code = wp_remote_retrieve_response_code( $response );
					$body = json_decode( wp_remote_retrieve_body( $response ), true );
				}
	
				if ($response_code === 200) {
					if ($body['success']) {
						$success_message .= $body['description'].' ';					
					} else {
						$error = true;
						$error_message .= $body['description'].' ';
					}
									
				} else {
					if (is_wp_error( $response )){
						$error = true;
						$error_message .= $response->get_error_message().' ';
					} else {
						if (is_array( $response )) {
							$error = true;
							$error_message .= $response['response']['message'].' ';
						} else {
							$error = true;
							$error_message .= 'Error Desconocido !'.' ';
						}				
					}
					
				}
				
				//self::DisplaySuccess('Mensaje Enviado');
			} catch (Exception $e) {
				$error = true;
				$error_message .= $e->getMessage().' ';
			}

		}

		if (is_null($mensaje) && is_null($image)) {
			$error = true;
			$error_message .= "El paquete no tiene mensajes de whatsapp configurados!!";
		}
		
		//$success_message = self::encodeImg(urlencode ($image));
		
		
		if (!$error) {
			self::DisplaySuccess($success_message);
		} else {
			self::DisplayError($error_message);
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
			SELECT id, slug, nombre, descripcion, img_filename, img_url, img_type FROM {$table_name}", ARRAY_A);

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

	/**
	 * Reemplazar las variables por sus valores del cliente en los
	 * mensajes definidos en los paquetes
	 *
	 **/
	public function encodeImg($url='') {

		$url = str_replace ('%3A', ':', $url);
		$url = str_replace ('%2F', '/', $url);
		return $url;
	}
}
