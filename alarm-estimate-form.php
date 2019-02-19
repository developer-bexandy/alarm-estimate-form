<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bexandyrodriguez.com.ve
 * @since             1.0.0
 * @package           Alarm_Estimate_Form
 *
 * @wordpress-plugin
 * Plugin Name:       ALARM ESTIMATE FORM
 * Plugin URI:        https://github.com/developer-bexandy/alarm-estimate-form
 * Description:       Usar el shortcode <strong>[alarm_estimate_form]</strong> dónde desee mostrar el formulario. Ingresar las claves de API Twilio necesarias para la verificación por SMS y envío de Whatsapp en <strong>Ajustes->ALARM ESTIME FORM SMS</strong>.
 * Version:           1.0.0
 * Author:            Bexandy Rodriguez
 * Author URI:        https://bexandyrodriguez.com.ve
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       alarm-estimate-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ALARM_ESTIMATE_FORM_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-alarm-estimate-form-activator.php
 */
function activate_alarm_estimate_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-alarm-estimate-form-activator.php';
	Alarm_Estimate_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-alarm-estimate-form-deactivator.php
 */
function deactivate_alarm_estimate_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-alarm-estimate-form-deactivator.php';
	Alarm_Estimate_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_alarm_estimate_form' );
register_deactivation_hook( __FILE__, 'deactivate_alarm_estimate_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-alarm-estimate-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_alarm_estimate_form() {

	$plugin = new Alarm_Estimate_Form();
	$plugin->run();

}
run_alarm_estimate_form();
