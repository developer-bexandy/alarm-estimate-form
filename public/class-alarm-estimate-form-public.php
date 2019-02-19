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

		$country_code = (isset($_POST['data']['country_code']) ) ? $_POST['data']['country_code'] : '';
		$phone_number = (isset($_POST['data']['phone_number']) )  ? $_POST['data']['phone_number']  : '';
		$via = (isset($_POST['data']['via']) ) ? $_POST['data']['via'] : '';

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); #alarm-estimate-form is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationStart($phone_number, $country_code, $via);
			if ($response->ok()) {
                self::DisplaySuccess($response->message(), $country_code, $phone_number, $via);
            } else {
                self::DisplayError($response->errors()->message);
            }			
                      
            //self::DisplaySuccess("Mensaje Enviado", $country_code, $phone_number, $via);
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
		$country_code = (isset($_POST['data']['token']) ) ? $_POST['data']['token'] : '';

		//gets our api details from the database.
		$api_details = get_option('alarm-estimate-form'); #alarm-estimate-form is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationStart($phone_number, $country_code, $via);
			if ($response->ok()) {
                self::DisplaySuccess($response->message(), $country_code, $phone_number, $via);
            } else {
                self::DisplayError($response->errors()->message);
            }	
            	
            //self::DisplaySuccess("token verificado", $country_code, $phone_number, $via);	
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

}
