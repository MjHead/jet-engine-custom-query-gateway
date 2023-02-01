<?php
namespace Jet_Engine_Elementor_Custom_Gateway\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Base {

	public function __construct() {

		$dynamic_hook_name_part = $this->get_widget_name() . '/' . $this->get_controls_section_name();

		add_action( "elementor/element/$dynamic_hook_name_part/before_section_end", [ $this, 'add_controls' ] );
		add_action( 'elementor/frontend/widget/before_render', [ $this, 'add_settings' ] );
	}

	/**
	 * Add Query related settings for selected widget instance
	 * 
	 * @param [type] $widget [description]
	 */
	public function add_settings( $widget ) {

		if ( $this->get_widget_name() !== $widget->get_name() ) {
			return;
		}

		$dynamic_items = apply_filters( 'jet-engine-query-gateway/query', [], $this->get_control_name(), $widget );

		if ( ! empty( $dynamic_items ) ) {

			foreach( $dynamic_items as $index => $item ) {
				unset( $item['__dynamic__'] );
				$dynamic_items[ $index ] = $item;
			}

			$widget->set_settings( $this->get_control_name(), $dynamic_items );
		}

	}

	/**
	 * Register Query-realted editor controls
	 */
	public function add_controls( $widget ) {

		// start injection of skin control before the Link widget control
		$widget->start_injection( [
			'at' => 'before',
			'of' => $this->get_control_name(),
		] );

		do_action( 'jet-engine-query-gateway/control', $widget, $this->get_control_name() );

		$widget->end_injection();
	}

	/**
	 * Return Elementor widget ID we work with
	 * 
	 * @return string
	 */
	abstract public function get_widget_name();

	/**
	 * Return control ID where repeater content are stored
	 * 
	 * @return string
	 */
	abstract public function get_control_name();

	/**
	 * Return Elementor editor section ID where query controls should be added
	 * Must be the same section where main control itself is located
	 * 
	 * @return string
	 */
	abstract public function get_controls_section_name();

}