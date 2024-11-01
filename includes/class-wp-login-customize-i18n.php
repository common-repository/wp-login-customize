<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://anowar.net
 * @since      1.0.0
 *
 * @package    Wp_Login_Customize
 * @subpackage Wp_Login_Customize/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Login_Customize
 * @subpackage Wp_Login_Customize/includes
 * @author     Anowar Anik <anrctg@gmail.com>
 */
class Wp_Login_Customize_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-login-customize',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
