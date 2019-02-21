<?php

/**
 * Fired during plugin activation
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Alarm_Estimate_Form
 * @subpackage Alarm_Estimate_Form/includes
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */
class Alarm_Estimate_Form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::alarm_estimate_form_table();
		self::alarm_estimate_form_paquete_table();
	}

	function alarm_estimate_form_table() {
		global $wpdb;
	 	$charset_collate = $wpdb->get_charset_collate();
	 	$table_name = $wpdb->prefix . "alarm_estimate_form";
	 	$sql = "CREATE TABLE `$table_name` (
	 		`id` INT(11) NOT NULL AUTO_INCREMENT,
	 		`codigo_postal` VARCHAR(9) DEFAULT NULL,
	 		`nombre` VARCHAR(40) DEFAULT NULL,
	 		`correo` VARCHAR(40) DEFAULT NULL,
	 		`codigo_area` CHAR(3) DEFAULT NULL,
	 		`telefono` VARCHAR(11) DEFAULT NULL,
 		 	`rama_alarma` ENUM('hogar', 'negocio') DEFAULT NULL,
	 		`residencia_habitual` TINYINT(1) DEFAULT NULL,
	 		`rejas` TINYINT(1) DEFAULT NULL,
	 		`internet` TINYINT(1) DEFAULT NULL,
	 		`historial_robos` TINYINT(1) DEFAULT NULL,
	 		`alarma_competencia` TINYINT(1) DEFAULT NULL,
	 		`tipo_vivienda` ENUM('piso', 'casa') DEFAULT NULL,
	 		`casa_mayor_180mts` TINYINT(1) DEFAULT NULL,
	 		`cantidad_empleados_negocio` ENUM('solo yo', '2 a 4', 'mas de 4') DEFAULT NULL,
	 		`horario_negocio` ENUM('mañana', 'tarde', 'mañana y tarde', 'noche', '24 horas') DEFAULT NULL,
	 		`tipo_negocio` ENUM('empresa', 'autonomo') DEFAULT NULL,
	 		`rama_negocio` ENUM('salud', 'hosteleria', 'supermercado', 'peluqueria', 'informatica', 'gimnasio', 'colegio', 'bazar', 'alimentacion', 'otros') DEFAULT NULL,
	 		`nave_mayor_1500mts` TINYINT(1) DEFAULT NULL,
	 		`paquete` VARCHAR(40) DEFAULT NULL,
	 		`fecha` DATE DEFAULT NULL,
	 		PRIMARY KEY(id)
	 	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	 	";
	 	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	 		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
	 		dbDelta($sql);
	 	}
	}

	function alarm_estimate_form_paquete_table() {
		global $wpdb;
	 	$charset_collate = $wpdb->get_charset_collate();
	 	$table_name = $wpdb->prefix . "alarm_estimate_form_paquete";
	 	$sql = "CREATE TABLE `$table_name` (
	 		`id` INT(11) NOT NULL AUTO_INCREMENT,
	 		`nombre_paquete` VARCHAR(40) DEFAULT NULL,
	 		PRIMARY KEY(id)
	 	) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	 	";
	 	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
	 		require_once(ABSPATH . "wp-admin/includes/upgrade.php");
	 		dbDelta($sql);
	 	}
	}
}
