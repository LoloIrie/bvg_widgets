<?php

/*
Widget Name: BVG nuLiga Team Table
Description: A widget which displays the current table for one team on the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/

class SiteOrigin_Widget_BvgNuligaTeamTable_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-nuligateamtable',
			__('BVG nuLiga Team Table', 'so-widgets-bundle'),
			array(
				'description' => __('Current table for one team from nuLiga', 'so-widgets-bundle'),
				'help' => '',
				'instance_storage' => true,
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
				'message' => __('Widget nuLiga Team Table Label', 'so-widgets-bundle'),
			),
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'so-widgets-bundle'),
			),
			'team' => array(
				'type' => 'text',
				'label' => __('Team', 'so-widgets-bundle'),
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
			'team' => $instance['team']
		);
	}


	function get_template_name($instance) {
		return 'bvgnuligateamtable';
	}

	function get_style_name($instance) {
		// We're not using a style
		return false;
	}
}

siteorigin_widget_register( 'bvg-nuliga-team-table', __FILE__, 'SiteOrigin_Widget_BvgNuligaTeamTable_Widget' );