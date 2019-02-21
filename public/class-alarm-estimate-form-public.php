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
	public function DisplaySuccess($message, $country_code, $phone_number, $via ) { 
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

		//sleep(60);

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
            self::DisplaySuccess("Código de Verificación Enviado", $country_code, $phone_number, $via);
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
		
		//sleep(60);
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
            self::DisplaySuccess("Token Verificado", $country_code, $phone_number, $via);	
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

	public function alarm_estimate_form_submit() {
		global $wpdb;
		$table_name = $wpdb->prefix . "alarm_estimate_form";

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
		        'residencia_habitual' => isset($dataArray['residencia_habitual'])? filter_var($dataArray['residencia_habitual'],FILTER_VALIDATE_BOOLEAN) : null,
		        'rejas' => isset($dataArray['rejas'])? filter_var($dataArray['rejas'],FILTER_VALIDATE_BOOLEAN) : null,
		        'internet' => isset($dataArray['internet'])? filter_var($dataArray['internet'],FILTER_VALIDATE_BOOLEAN) : null,
		        'historial_robos' => isset($dataArray['historial_robos'])? filter_var($dataArray['historial_robos'],FILTER_VALIDATE_BOOLEAN) : null,
		        'alarma_competencia' => isset($dataArray['alarma_competencia'])? filter_var($dataArray['alarma_competencia'],FILTER_VALIDATE_BOOLEAN) : null,
		        'tipo_vivienda' => isset($dataArray['tipo_vivienda'])? $dataArray['tipo_vivienda'] : null,
		        'casa_mayor_180mts' => isset($dataArray['casa_mayor_180mts'])? filter_var($dataArray['casa_mayor_180mts'],FILTER_VALIDATE_BOOLEAN) : null,
		        'cantidad_empleados_negocio' => isset($dataArray['cantidad_empleados_negocio'])? $dataArray['cantidad_empleados_negocio'] : null,
		        'horario_negocio' => isset($dataArray['horario_negocio'])? $dataArray['horario_negocio'] : null,
		        'tipo_negocio' => isset($dataArray['tipo_negocio'])? $dataArray['tipo_negocio'] : null,
		        'rama_negocio' => isset($dataArray['rama_negocio'])? $dataArray['rama_negocio'] : null,

		        'nave_mayor_1500mts' => isset($dataArray['nave_mayor_1500mts'])? filter_var($dataArray['nave_mayor_1500mts'],FILTER_VALIDATE_BOOLEAN) : null,
		        'fecha' => date("d-m-Y",strtotime('now'))
		    );

		    if ($rama_alarma === 'hogar'){
		    	if ($render_variables['tipo_vivienda'] === 'piso') {
		    		$render_variables['paquete'] = 'pack1';
		    	} else {
		    		if ($render_variables['casa_mayor_180mts'] === 'true') {
		    			$render_variables['paquete'] = 'pack2';
		    		} else {
		    			$render_variables['paquete'] = 'pack1';
		    		}
		    	}
		    }

		    if ($rama_alarma === 'negocio'){
		        if ($render_variables['nave_mayor_1500mts'] === 'true') {
		        	if ($render_variables['rama_negocio'] === 'salud') {
		    			$render_variables['paquete'] = 'pack3';
		    		} else {
		    			$render_variables['paquete'] = 'pack5';
		    		}		    		
		    	} else {		    		
		    		if ($render_variables['rama_negocio'] === 'salud') {
		    			$render_variables['paquete'] = 'pack3';
		    		} elseif ($render_variables['rama_negocio'] === 'otros') {
		    			$render_variables['paquete'] = 'pack5';
		    		} else {
		    			$render_variables['paquete'] = 'pack4';
		    		}
		    	}
		    }
		    
			$insert = $wpdb->query("
				INSERT INTO $table_name(
					nombre, 
					correo, 
					codigo_postal, 
					codigo_area, 
					telefono, 
					rama_alarma, 
					residencia_habitual, 
					rejas, 
					internet, 
					historial_robos,
					alarma_competencia,
					tipo_vivienda,
					casa_mayor_180mts,
					cantidad_empleados_negocio,
					horario_negocio,
					tipo_negocio,
					rama_negocio,
					nave_mayor_1500mts,
					paquete,
					fecha 
				) VALUES(
					'".$render_variables['nombre']."',
					'".$render_variables['correo']."',
					'".$render_variables['codigo_postal']."',
					'".$render_variables['codigo_area']."',
					'".$render_variables['telefono']."',
					'".$render_variables['rama_alarma']."',
					'".$render_variables['residencia_habitual']."',
					'".$render_variables['rejas']."',
					'".$render_variables['internet']."',
					'".$render_variables['historial_robos']."',
					'".$render_variables['alarma_competencia']."',
					'".$render_variables['tipo_vivienda']."',
					'".$render_variables['casa_mayor_180mts']."',
					'".$render_variables['cantidad_empleados_negocio']."',
					'".$render_variables['horario_negocio']."',
					'".$render_variables['tipo_negocio']."',
					'".$render_variables['rama_negocio']."',
					'".$render_variables['nave_mayor_1500mts']."',
					'".$render_variables['paquete']."',
					now()
				)"
			);

			if ($insert) {
				self::DisplaySuccess("Registro insertado en la BDD");
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

}
