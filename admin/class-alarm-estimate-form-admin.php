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
		global $pagenow; 
		if ( 'admin.php' === $pagenow ) { 

			wp_enqueue_style( 'bootstrap_css', 
			'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', 
  					array(), '4.3.1'); 
			wp_script_add_data( 'bootstrap_css', array( 'integrity', 'crossorigin' ) , array( 'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T', 'anonymous' ) );

			wp_enqueue_style( 'font_awesome_css', 
				'https://use.fontawesome.com/releases/v5.7.2/css/all.css', 
	  			array(), '5.7.2'); 
			wp_script_add_data( 'font_awesome_css', array( 'integrity', 'crossorigin' ) , array( 'sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr', 'anonymous' ) );

			if ('alarm-estimate-form-registro' === $_GET['page']) {
				wp_enqueue_style( 'bootstrap_table_css', 
					'https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.css', 
		  			array(), '1.13.4');
				
			}

		} 

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
		global $pagenow; 
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/alarm-estimate-form-admin.js', array( 'jquery' ), $this->version, false );

		if ( ( 'admin.php' === $pagenow ) ) { 
			
			wp_enqueue_script( 'popper_js', 
	  			'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', 
	  			array(), '1.14.7', true); 
			wp_script_add_data( 'popper_js', array( 'integrity', 'crossorigin' ) , array( 'sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1', 'anonymous' ) );

		    wp_enqueue_script( 'bootstrap_js', 
	  			'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', 
	  			array('jquery','popper_js'), '4.3.1', true); 
		    wp_script_add_data( 'bootstrap_js', array( 'integrity', 'crossorigin' ) , array( 'sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM', 'anonymous' ) );

		    if ( 'alarm-estimate-form-registro' === $_GET['page'] ) {
		    	wp_enqueue_script( 'admin-record-table-js', plugin_dir_url( __FILE__ ) . 'js/admin-record-table.js', array( 'jquery' ), $this->version, false );

		    	wp_enqueue_script( 'bootstrap_table_js', 
		  			'https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.js', 
		  			array('jquery','popper_js', 'bootstrap_js'), '1.13.4', true); 

			    wp_enqueue_script( 'bootstrap_table_locale_es_ES_js', 
		  			'https://unpkg.com/bootstrap-table@1.13.4/dist/locale/bootstrap-table-es-ES.min.js', 
		  			array('jquery','popper_js', 'bootstrap_js', 'bootstrap_table_js'), '1.13.4', true);

			    

			    wp_enqueue_script( 'bootstrap_table_locale_es_ES_js', 
		  			'https://unpkg.com/bootstrap-table@1.13.4/dist/locale/bootstrap-table-es-ES.min.js', 
		  			array('bootstrap_table_js'), '1.13.4', true);

			    

			    $title_nonce = wp_create_nonce('get_alarma_data_table');
			    wp_localize_script('jquery', 'alarm_estimate_form_ajax_obj', array(
			        'ajax_url' => admin_url( 'admin-ajax.php' ),
			        'nonce'    => $title_nonce,
			    ));

			    wp_enqueue_script( 'bootstrap-table-mobile-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap-table-mobile.js', array(), $this->version, false );
			}
			
			if ( 'alarm-estimate-form-paquetes' === $_GET['page'] ) {
				
				$title_nonce = wp_create_nonce('package_form_nonce_code');
				$params = array ( 
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce'    => $title_nonce,
					);
				
				wp_enqueue_script( 'package_form_ajax_handle', 
					plugin_dir_url( __FILE__ ) . 'js/package_form-ajax-handler.js', 
					array( 'jquery' ), $this->version, false );				
				wp_localize_script( 'package_form_ajax_handle', 'params', $params );
				
			}
			
		    
		}
		
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
		add_menu_page( 'Presupuestos', 'Presupuestos', 'manage_options', $this->plugin_name );

		add_submenu_page($this->plugin_name,  'Configuración', 'Configuración', 'manage_options', $this->plugin_name, array($this, 'display_alarm_estimate_form_settings_page') );
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

		add_settings_section('alarm_estimate_form_settings', 'CONFIGURACIÓN DE API NEXMO - APIWHA', array($this, 'alarm_estimate_form_section_text'), 'alarm-estimate-form-settings-page');


		add_settings_field('nexmo_api_key', 'NEXMO API KEY', array($this, 'nexmo_api_key'), 'alarm-estimate-form-settings-page', 'alarm_estimate_form_settings');

		add_settings_field('nexmo_api_secret', 'NEXMO API SECRET', array($this, 'nexmo_api_secret'), 'alarm-estimate-form-settings-page', 'alarm_estimate_form_settings');
		
		add_settings_field('apiwha_apikey', 'APIWHA API KEY', array($this, 'alarm_estimate_form_apiwha_apikey'), 'alarm-estimate-form-settings-page', 'alarm_estimate_form_settings');

	}


	
	/**
	 * Mostrar el subtitulo en la configuración
	 *
	 **/
	public function alarm_estimate_form_section_text() {
		echo '<h3>Key y Secret de las diferentes API utilizadas</h3>';
	}

	/**
	 * Renderizar el campo sid
	 *
	 **/
	public function nexmo_api_key() {
		$options = get_option($this->plugin_name);
		echo "<input id='twilio_api_sid' name='$this->plugin_name[nexmo_api_key]' size='40' type='text' value='{$options['nexmo_api_key']}' />
			<p class='description'>Nexmo - utilizado para verificación de teléfono por SMS</p>";
	}

	/**
	 * Renderizar el campo auth_token
	 *
	 **/
	public function nexmo_api_secret() {
		$options = get_option($this->plugin_name);
		echo "<input id='twilio_api_auth_token' name='$this->plugin_name[nexmo_api_secret]' size='40' type='text' value='{$options['nexmo_api_secret']}' />
			<p class='description'>Nexmo - utilizado para verificación de teléfono por SMS</p>";
	}
	

	/**
	 * Renderizar el campo apiwha_apikey
	 *
	 **/
	public function alarm_estimate_form_apiwha_apikey() {
		$options = get_option($this->plugin_name);
		echo "<input id='apiwha_apikey' name='$this->plugin_name[apiwha_apikey]' size='40' type='text' value='{$options['apiwha_apikey']}' />
			<p class='description'>APIWHA - utilizado para envío de mensajes por Whatsapp</p>";
	}


	/**
	 * Sanitizar todos los campos de entrada.
	 *
	 **/
	public function plugin_options_validate($input) {
		$newinput['nexmo_api_key'] = trim($input['nexmo_api_key']);
		$newinput['nexmo_api_secret'] = trim($input['nexmo_api_secret']);
		$newinput['apiwha_apikey'] = trim($input['apiwha_apikey']);

		return $newinput;
	}

	public function record_table_submenu_page() {
		add_submenu_page($this->plugin_name,  'Registro', 'Registro', 'manage_options', $this->plugin_name.'-registro', array($this, 'display_record_table_submenu_page') );
	}

	public function display_record_table_submenu_page() {
		//
		require_once plugin_dir_path( __FILE__ ) . 'partials/admin-record-table-display.php';
	}

	public function get_alarma_data_table() {
		global $wpdb;
		global $pagenow;
		$table_name = $wpdb->prefix . "alarm_estimate_form";

		if( isset( $_POST['nonce_code'] ) && wp_verify_nonce( $_POST['nonce_code'], 'get_alarma_data_table') ) {

			$paquetes = self::obtenerPaquetes();
			
			$results = $wpdb->get_results("
				SELECT id, nombre, correo, codigo_postal, telefono, rama_alarma, residencia_habitual, rejas, internet, 
				historial_robos, alarma_competencia, tipo_vivienda, 
				casa_mayor_180mts, cantidad_empleados_negocio, 
				horario_negocio, tipo_negocio, rama_negocio, 
				nave_mayor_1500mts, paquete, fecha 
				FROM {$table_name} ORDER BY id DESC", ARRAY_A);
			foreach ($results as $key=>$registro) {
				$data = array_map(function($item){
					if ($item === '1') return 'si';
					if ($item === '0') return 'no';
					return $item;
				},$registro);

				$data = self::reemplazarValores($data, $paquetes);

				$registros[] = array_filter($data);
			}

			wp_send_json_success($registros);
		} else {
			wp_send_json_error(
			    array( 
	            		'message' => 'no nonce'
	            	)
		  	);
		}
	}

	/**
	 * Registrar submenu de definición de paquetes.
	 *
	 **/
	public function setting_package_submenu_page() {
		add_submenu_page($this->plugin_name,  'Paquetes', 'Paquetes', 'manage_options', $this->plugin_name.'-paquetes', array($this, 'display_package_form_submenu_page') );
	}

	/**
	 * Mostrar formularo de definición de paquetes.
	 *
	 **/
	public function display_package_form_submenu_page() {
		//
		require_once plugin_dir_path( __FILE__ ) . 'partials/admin-package-form-display.php';
	}

	/**
	 * Guardar los datos recibidos desde el formulario de definicion de paquetes
	 *
	 **/

	public function save_package_form() {
		global $wpdb;
		$table_name = $wpdb->prefix . "alarm_estimate_form_paquete";


		if( isset( $_POST['package_form_nonce'] ) && wp_verify_nonce( $_POST['package_form_nonce'], 'package_form_nonce_code') ) {

			$posted_data = isset($_POST) ? $_POST : array();
			$file_data = isset($_FILES) ? $_FILES : array();
			$data = array_merge($posted_data, $file_data);
			$response = array();
			// sanitize the input
			//$data = $_POST['datos'] ? $_POST['datos'] : '';
			parse_str($data['datos'], $dataArray);
			$nombrePaqueteA = sanitize_text_field( $dataArray['nombrePaqueteA'] );
			$descripcionPaqueteA = urlencode ($dataArray['descripcionPaqueteA']);
			$nombrePaqueteB = sanitize_text_field( $dataArray['nombrePaqueteB'] );
			$descripcionPaqueteB = urlencode ($dataArray['descripcionPaqueteB']);
			$nombrePaqueteC = sanitize_text_field( $dataArray['nombrePaqueteC'] );
			$descripcionPaqueteC = urlencode ($dataArray['descripcionPaqueteC']);
			$nombrePaqueteD = sanitize_text_field( $dataArray['nombrePaqueteD'] );
			$descripcionPaqueteD =  urlencode ($dataArray['descripcionPaqueteD']);
			$nombrePaqueteE = sanitize_text_field( $dataArray['nombrePaqueteE'] );
			$descripcionPaqueteE = urlencode ($dataArray['descripcionPaqueteE']);

			$adjunto = array();
			for ($i=0; $i < 5; $i++) { 
				$paqueteID = 'imgPaquete'.['A','B','C','D','E'][$i];

				$uploaded_file = wp_handle_upload($data[$paqueteID], array('test_form' => false));				

				if ($uploaded_file && !isset($uploaded_file['error'])) {
					$adjunto[$paqueteID]['filename'] = basename($uploaded_file['url']);
					$adjunto[$paqueteID]['url'] = $uploaded_file['url'];
					$adjunto[$paqueteID]['type'] = $uploaded_file['type'];
				} else {
					$adjunto[$paqueteID]['filename'] = null;
					$adjunto[$paqueteID]['url'] = null;
					$adjunto[$paqueteID]['type'] = null;
				}
			}

			$variables = array (
				'1' => array (
					'slug' => 'paqueteA',
		        	'nombre' => $nombrePaqueteA,
		        	'descripcion' => $descripcionPaqueteA,
		        	'img_filename' => $adjunto['imgPaqueteA']['filename'],
		        	'img_url' => $adjunto['imgPaqueteA']['url'],
		        	'img_type' => $adjunto['imgPaqueteA']['type']
				),
				'2' => array (
					'slug' => 'paqueteB',
		        	'nombre' => $nombrePaqueteB,
		        	'descripcion' => $descripcionPaqueteB,
		        	'img_filename' => $adjunto['imgPaqueteB']['filename'],
		        	'img_url' => $adjunto['imgPaqueteB']['url'],
		        	'img_type' => $adjunto['imgPaqueteB']['type']
				),
				'3' => array (
					'slug' => 'paqueteC',
		        	'nombre' => $nombrePaqueteC,
		        	'descripcion' => $descripcionPaqueteC,
		        	'img_filename' => $adjunto['imgPaqueteC']['filename'],
		        	'img_url' => $adjunto['imgPaqueteC']['url'],
		        	'img_type' => $adjunto['imgPaqueteC']['type']
				),
				'4' => array (
					'slug' => 'paqueteD',
		        	'nombre' => $nombrePaqueteD,
		        	'descripcion' => $descripcionPaqueteD,
		        	'img_filename' => $adjunto['imgPaqueteD']['filename'],
		        	'img_url' => $adjunto['imgPaqueteD']['url'],
		        	'img_type' => $adjunto['imgPaqueteD']['type']
				),
				'5' => array (
					'slug' => 'paqueteE',
		        	'nombre' => $nombrePaqueteE,
		        	'descripcion' => $descripcionPaqueteE,
		        	'img_filename' => $adjunto['imgPaqueteE']['filename'],
		        	'img_url' => $adjunto['imgPaqueteE']['url'],
		        	'img_type' => $adjunto['imgPaqueteE']['type']
				)
			);

			$error = false;

			$all_slugs = $wpdb->get_col("SELECT slug FROM {$table_name}");

			$datos = $wpdb->get_results("
				SELECT id, slug, nombre, descripcion, img_filename, img_url, img_type
				FROM {$table_name}", ARRAY_A);
			
			$results = self::mapear_arreglo($datos, 'slug');

			foreach ($variables as $key => $paquete) {

				if (is_null($results[$paquete['slug']]['img_filename'])) {
					$img_filename = $paquete['img_filename'];
				} else {
					$img_filename = is_null($paquete['img_filename']) ? $results[$paquete['slug']]['img_filename'] : $paquete['img_filename'];
				}

				if (is_null($results[$paquete['slug']]['img_url'])) {
					$img_url = $paquete['img_url'];
				} else {
					$img_url = is_null($paquete['img_url']) ? $results[$paquete['slug']]['img_url'] : $paquete['img_url'];
				}

				if (is_null($results[$paquete['slug']]['img_type'])) {
					$img_type = $paquete['img_type'];
				} else {
					$img_type = is_null($paquete['img_type']) ? $results[$paquete['slug']]['img_type'] : $paquete['img_type'];
				}
				
				$data = array(
					//'id' => null,
			        'slug' => $paquete['slug'],
			        'nombre' => $paquete['nombre'],
			        'descripcion' => $paquete['descripcion'],
			        'img_filename' => sanitize_text_field($img_filename),
			        'img_url' => urlencode (stripslashes($img_url)),
			        'img_type' => urlencode($img_type)
		    	);

		    	if (in_array($data['slug'], $all_slugs)) {
					$wpdb->update($table_name, $data, array('slug' => $data['slug']));
		    	} else {
		    		$wpdb->insert($table_name, $data);
		    	}
				
				


		    	if (!empty($wpdb->last_error)) {
					$error = true;
					wp_send_json_error(
					    array( 
			            		'message' => $wpdb->last_error
			            	)
				  	);
				} 

				$wpdb->flush();
			}

			if (!$error) {
				self::get_package_form_data();
			}
			
		}			
		else {
			wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
						'response' 	=> 403,
						'back_link' => 'admin.php?page=' . $this->plugin_name.'-paquetes',
				) );
		}

	}


	/**
	 * Obtener Datos de Paquetes en la BDD
	 *
	 **/

	public function get_package_form_data() {
		global $wpdb;
		$table_name = $wpdb->prefix . "alarm_estimate_form_paquete";

		if( isset( $_POST['package_form_nonce'] ) && wp_verify_nonce( $_POST['package_form_nonce'], 'package_form_nonce_code') ) {
			
			$results = $wpdb->get_results("
				SELECT id, slug, nombre, descripcion, img_filename, img_url, img_type
				FROM {$table_name}", ARRAY_A);

			foreach ($results as $key=>$registro) {
				$data = array_map(function($item){
					return urldecode($item);
				},$registro);

				$registros[] = array_filter($data);
			}

			wp_send_json_success($registros);
		} else {
			wp_send_json_error(
			    array( 
	            		'message' => 'no nonce'
	            	)
		  	);
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
	public function reemplazarValores($data='', $paquetes = '') {


		$data['paquete'] = $paquetes[$data['paquete']] ? $paquetes[$data['paquete']]['nombre'] : $data['paquete'];

		return $data;
	}

	/**
	 * Reemplazar las variables por sus valores del cliente en los
	 * mensajes definidos en los paquetes
	 *
	 **/
	public function mapear_arreglo($array='', $indice = '') {

		foreach ($array as $key=>$datos) {
			$mapa[$datos[$indice]] = $datos;
			
		}
		return $mapa;
	}


}
