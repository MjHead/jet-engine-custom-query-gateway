<?php
/**
 * Plugin Name: JetEngine - Custom Query for Elementor widgets
 * Description: Add Custom Query controls for Elementor native widgets
 * Plugin URI:
 * Author: Crocoblock
 * Version: 1.0.0
 */

namespace Jet_Engine_Elementor_Custom_Gateway;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'JET_ENGINE_ELEMENTOR_CUSTOM_GATEWAY_PATH', plugin_dir_path( __FILE__ ) );

final class Plugin {

	/**
	 * Instance
	 */
	private static $_instance = null;

	/**
	 * Instance
	 * Ensures only one instance of the class is loaded or can be loaded.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		// Init Plugin
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 */
	public function init() {
		add_action( 'elementor/init', [ $this, 'init_widgets' ], 0 );
	}

	/**
	 * Initialize widgets with custom query gateway support
	 */
	public function init_widgets() {

		require JET_ENGINE_ELEMENTOR_CUSTOM_GATEWAY_PATH . '/widgets/base.php';
		require JET_ENGINE_ELEMENTOR_CUSTOM_GATEWAY_PATH . '/widgets/accordion.php';
		require JET_ENGINE_ELEMENTOR_CUSTOM_GATEWAY_PATH . '/widgets/toggle.php';
		require JET_ENGINE_ELEMENTOR_CUSTOM_GATEWAY_PATH . '/widgets/tabs.php';

		new Widgets\Accordion();
		new Widgets\Toggle();
		new Widgets\Tabs();

	}

}

Plugin::instance();
