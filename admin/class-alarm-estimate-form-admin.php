<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/admin
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */
class Alarm_Estimate_Form_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/alarm-estimate-form-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/alarm-estimate-form-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registrar el menú de administración del plugin dentro del Dashboard de Wordpress
	 *
	 * @since    1.0.0
	 **/
	
	public function add_alarm_estimate_form_setting() {

		/**
		 * Añadir la página de configuración del plugin en el menú "Ajustes".
		 *
		 * Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 **/
		add_options_page( 'ALARM ESTIMATE FORM PAGE', 'ALARM ESTIMATE FORM SMS', 'manage_options', $this->plugin_name, array($this, 'display_alarm_estimate_form_settings_page') );
	}

	/**
	 * Renderizar la página de configuración del plugin (El archivo html)
	 *
	 * @since    1.0.0
	 * 
	 **/
	public function display_alarm_estimate_form_settings_page() {

		include_once( 'partials/alarm-estimate-form-admin-display.php' );
	}

	/**
	 * Registrar y definir los campos necesarios para la configuración.
	 *
	 **/
	public function alarm_estimate_form_admin_settings_save() {

		register_setting( $this->plugin_name, $this->plugin_name, array($this, 'plugin_options_validate') );

		add_settings_section('alarm_estimate_form_sendex', 'Configuración para envío de SMS - Whatsapp', array($this, 'alarm_estimate_form_sendex_section_text'), 'alarm-estimate-form-settings-page');

		add_settings_section('alarm_estimate_form_verifysms', 'Configuración para Verificación de Teléfono por SMS', array($this, 'alarm_estimate_form_verifysms_section_text'), 'alarm-estimate-form-settings-page');


		add_settings_field('api_sid', 'API SID', array($this, 'sendex_setting_sid'), 'alarm-estimate-form-settings-page', 'alarm_estimate_form_sendex');

		add_settings_field('api_auth_token', 'API AUTH TOKEN', array($this, 'sendex_setting_token'), 'alarm-estimate-form-settings-page', 'alarm_estimate_form_sendex');

		

		add_settings_field('prod_api_key', 'PRODUCTION API KEY', array($this, 'alarm_estimate_form_setting_key'), 'alarm-estimate-form-settings-page', 'alarm_estimate_form_verifysms');

	}

	
	/**
	 * Mostrar el subtitulo en la configuración
	 *
	 **/
	public function alarm_estimate_form_sendex_section_text() {
		echo '<h3>Editar detalles de la API de Twilio</h3>';
	}

	/**
	 * Renderizar el campo sid
	 *
	 **/
	public function sendex_setting_sid() {
		$options = get_option($this->plugin_name);
		echo "<input id='plugin_text_string' name='$this->plugin_name[api_sid]' size='40' type='text' value='{$options['api_sid']}' />";
	}

	/**
	 * Renderizar el campo auth_token
	 *
	 **/
	public function sendex_setting_token() {
		$options = get_option($this->plugin_name);
		echo "<input id='plugin_text_string' name='$this->plugin_name[api_auth_token]' size='40' type='text' value='{$options['api_auth_token']}' />";
	}

	/**
	 * Mostrar el subtitulo en la configuración
	 *
	 **/
	public function alarm_estimate_form_verifysms_section_text() {
		echo '<h3>Editar detalles de la API de Verificación de Twilio</h3>';
	}

	/**
	 * Renderizar el campo prod_api_key
	 *
	 **/
	public function alarm_estimate_form_setting_key() {
		$options = get_option($this->plugin_name);
		echo "<input id='plugin_text_string' name='$this->plugin_name[prod_api_key]' size='40' type='text' value='{$options['prod_api_key']}' />";
	}

	/**
	 * Sanitizar todos los campos de entrada.
	 *
	 **/
	public function plugin_options_validate($input) {
		$newinput['api_sid'] = trim($input['api_sid']);
		$newinput['api_auth_token'] = trim($input['api_auth_token']);
		$newinput['prod_api_key'] = trim($input['prod_api_key']);

		return $newinput;
	}
}
