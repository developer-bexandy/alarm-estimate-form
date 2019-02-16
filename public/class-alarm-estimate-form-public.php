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

	}

	/**
	 * Definir el shortcode para mostrar el formulario.
	 *
	 **/
	public function shortcode_alarm_estimate_form($atts, $content = null){

	    include_once( 'partials/alarm-estimate-form-public-display.php' );
	}

	/**
	 * Registrar el shortcode para mostrar el formulario.
	 *
	 **/
	public function register_shortcode_alarm_estimate_form(){

	    add_shortcode( 'alarm_estimate_form',  'shortcode_alarm_estimate_form' );
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
	public function DisplaySuccess($message = "Request Verification Sended !!") { 
		wp_send_json_success(
			    array( 
            		'message' => $message
            	)
			 );
	}

	/**
	 * Enviar la solicitud de verificacion al numero telefonico
	 *
	 **/
	public function alarm_estimate_form_request_verification() {
		if( ! wp_verify_nonce( $_POST['nonce_code'], 'alarm_estimate_form' ) ) die( 'Stop!');
		if( !isset($_POST['data']['request_verification']) ){ return; }

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
                self::DisplaySuccess($response->message());
            } else {
                self::DisplayError($response->errors()->message);
            }			
            */            
            self::DisplaySuccess("Mensaje Enviado");
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

	/**
	 * Verificar el token recibido por SMS si es valido
	 *
	 **/
	public function alarm_estimate_form_verify_token() {
		if( !isset($_POST['verify_token']) ){ return; }

		$country_code = (isset($_POST['country_code']) ) ? $_POST['country_code'] : '';
		$phone_number = (isset($_POST['phone_number']) )  ? $_POST['phone_number']  : '';
		$via = (isset($_POST['via']) ) ? $_POST['via'] : '';
		$country_code = (isset($_POST['token']) ) ? $_POST['token'] : '';

		//gets our api details from the database.
		$api_details = get_option('verifysms'); #verifysms is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			/*
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationStart($phone_number, $country_code, $via);
			if ($response->ok()) {
                self::DisplaySuccess($response->message());
            } else {
                self::DisplayError($response->errors()->message);
            }	
            */	
            self::DisplayError("token verificado");	
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

}
