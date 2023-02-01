<?php
namespace Jet_Engine_Elementor_Custom_Gateway\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tabs extends Base {

	/**
	 * Return Elementor widget ID we work withj
	 * 
	 * @return string
	 */
	public function get_widget_name() {
		return 'tabs';
	}

	/**
	 * Return control ID where repeater content are stored
	 * 
	 * @return string
	 */
	public function get_control_name() {
		return 'tabs';
	}

	/**
	 * Return Elementor editor section ID where query controls should be added
	 * Must be the same section where main control itself is located
	 * 
	 * @return string
	 */
	public function get_controls_section_name() {
		return 'section_tabs';
	}

}
