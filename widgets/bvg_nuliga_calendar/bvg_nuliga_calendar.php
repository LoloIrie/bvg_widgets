<?php

/*
Widget Name: BVG nuLiga Calendar
Description: A widget which displays next team games for the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/

class SiteOrigin_Widget_BvgNuligaCalendar_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-nuligacalendar',
			__('BVG nuLiga Calendar', 'so-widgets-bundle'),
			array(
				'description' => __('Next team games from nuLiga', 'so-widgets-bundle'),
				'help' => ''
			),
			array(),
			false,
			plugin_dir_path(__FILE__)
		);
	}

	function initialize_form(){
		if( !class_exists( 'SiteOrigin_Widget_Field_Bvg_label' ) ){
			include plugin_dir_path(__FILE__).'../bvg_block/assets/bvg_label.class.php';
		}
		return array(
			'label' => array(
				'type' => 'bvg_label',
				'message' => __('Widget nuLiga Calendar Label', 'so-widgets-bundle'),
			),
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'so-widgets-bundle'),
			),
			'url' => array(
				'type' => 'text',
				'label' => __('nuLiga URL', 'so-widgets-bundle'),
			)
		);
	}


	public function get_template_variables( $instance, $args ) {
		$instance = wp_parse_args(
			$instance,
			array(  'title' => '', 'url' => '' )
		);


		return array(
			'title' => $instance['title'],
			'url' => $instance['url']
		);
	}


	function get_template_name($instance) {
		return 'bvgnuligacalendar';
	}

	function get_style_name($instance) {
		// We're not using a style
		return false;
	}
}


siteorigin_widget_register( 'bvg-nuligacalendar', __FILE__, 'SiteOrigin_Widget_BvgNuligaCalendar_Widget' );
