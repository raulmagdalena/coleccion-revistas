<?php

/**
 * Define the internationalization functionality     
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://raulmagdalenacatala.com
 * @since      0.0.1
 *
 * @package    Coleccion-Revistas
 * @subpackage Coleccion-Revistas/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.1
 * @package    Coleccion-Revistas
 * @subpackage Coleccion-Revistas/includes
 * @author     Your Name <email@example.com>
 */
class Coleccion_Revistas_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'coleccion-revistas',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
