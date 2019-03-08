<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/includes
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */
class Alarm_Estimate_Form {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Alarm_Estimate_Form_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ALARM_ESTIMATE_FORM_VERSION' ) ) {
			$this->version = ALARM_ESTIMATE_FORM_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'alarm-estimate-form';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Alarm_Estimate_Form_Loader. Orchestrates the hooks of the plugin.
	 * - Alarm_Estimate_Form_i18n. Defines internationalization functionality.
	 * - Alarm_Estimate_Form_Admin. Defines all hooks for the admin area.
	 * - Alarm_Estimate_Form_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-alarm-estimate-form-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-alarm-estimate-form-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-alarm-estimate-form-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-alarm-estimate-form-public.php';

		$this->loader = new Alarm_Estimate_Form_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Alarm_Estimate_Form_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Alarm_Estimate_Form_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Alarm_Estimate_Form_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Agregar menú de Presupuesto y submenú de configuración
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_alarm_estimate_form_setting' );

		// Guardar y actualizar la configuración
		$this->loader->add_action( 'admin_init', $plugin_admin, 'alarm_estimate_form_admin_settings_save' );

		// Agregar submenú de Registro de Solicitudes
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'record_table_submenu_page' );

		// Añadir funciones listener para llamado ajax con action = 'alarm_estimate_form_submit'
		$this->loader->add_action( 'wp_ajax_get_data_table', $plugin_admin, 'get_alarma_data_table' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_data_table', $plugin_admin, 'get_alarma_data_table' );

		// Agregar submenú de Definición de Paquetes
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'setting_package_submenu_page' );

		// Obtener datos para rellenar Formulario de Paquetes
		$this->loader->add_action( 'wp_ajax_get_package_form_data', $plugin_admin, 'get_package_form_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_get_package_form_data', $plugin_admin, 'get_package_form_data' );

		// Añadir funciones listener para llamado ajax con action = 'alarm_estimate_form_submit'
		$this->loader->add_action( 'wp_ajax_save_package_form', $plugin_admin, 'save_package_form' );
		$this->loader->add_action( 'wp_ajax_nopriv_save_package_form', $plugin_admin, 'save_package_form' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Alarm_Estimate_Form_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Crear shortcode del formulario de presupuesto
		$this->loader->add_shortcode( 'alarm_estimate_form', $plugin_public, 'shortcode_alarm_estimate_form' );

		// Añadir funciones listener para llamado ajax con action = 'request_phone_verification'
		$this->loader->add_action( 'wp_ajax_request_phone_verification', $plugin_public, 'alarm_estimate_form_request_verification' );
		$this->loader->add_action( 'wp_ajax_nopriv_request_phone_verification', $plugin_public, 'alarm_estimate_form_request_verification' );

		// Añadir funciones listener para llamado ajax con action = 'verify_token'
		$this->loader->add_action( 'wp_ajax_verify_token', $plugin_public, 'alarm_estimate_form_verify_token' );
		$this->loader->add_action( 'wp_ajax_nopriv_verify_token', $plugin_public, 'alarm_estimate_form_verify_token' );

		// Añadir funciones listener para llamado ajax con action = 'alarm_estimate_form_submit'
		$this->loader->add_action( 'wp_ajax_alarm_estimate_form_submit', $plugin_public, 'alarm_estimate_form_submit' );
		$this->loader->add_action( 'wp_ajax_nopriv_alarm_estimate_form_submit', $plugin_public, 'alarm_estimate_form_submit' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Alarm_Estimate_Form_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
