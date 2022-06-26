 <?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://raulmagdalenacatala.com
 * @since             0.0.1
 * @package           Coleccion_Revistas
 *
 * @wordpress-plugin
 * Plugin Name:       Colección de Revistas
 * Plugin URI:        http://raulmagdalenacatala.com/coleccion_revistas-uri/
 * Description:       Keeps a magazines collection
 * Version:           0.0.1
 * Author:            Raul Magdalena
 * Author URI:        http://raulmagdalenacatala.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       coleccion_revistas
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COLECCION_REVISTAS_VERSION', '0.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-coleccion_revistas-activator.php
 */
function activate_Coleccion_Revistas() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-coleccion-revistas-activator.php';
	Coleccion_Revistas_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-coleccion_revistas-deactivator.php
 */
function deactivate_Coleccion_Revistas() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-coleccion-revistas-deactivator.php';
	Coleccion_Revistas_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Coleccion_Revistas' );
register_deactivation_hook( __FILE__, 'deactivate_Coleccion_Revistas' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-coleccion-revistas.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_Coleccion_Revistas() {

	$plugin = new Coleccion_Revistas();
	$plugin->run();

}
run_Coleccion_Revistas();
