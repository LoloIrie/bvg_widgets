<?php

/*
Widget Name: BVG Team Ranking Table
Description: A widget which displays a table with team ranking for the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/

class SiteOrigin_Widget_BvgTeamClt_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-teamclt',
			__('BVG Team Ranking', 'so-widgets-bundle'),
			array(
				'description' => __('Team Current Ranking', 'so-widgets-bundle'),
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
				'message' => __('Widget Team Ranking Label', 'so-widgets-bundle'),
			),
			'id' => array(
				'type' => 'text',
				'label' => __('Id', 'so-widgets-bundle'),
			),
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'so-widgets-bundle'),
			),
			'saison' => array(
				'type' => 'text',
				'label' => __('Saison', 'so-widgets-bundle'),
			),
		);
	}


	public function get_template_variables( $instance, $args ) {
		$instance = wp_parse_args(
			$instance,
			array(  'title' => '', 'saison' => '' )
		);


		return array(
			'title' => $instance['title'],
			'saison' => $instance['saison'],
			'id' => $instance['id'],
		);
	}


	function get_template_name($instance) {
		return 'bvgteamranking';
	}

	function get_style_name($instance) {
		// We're not using a style
		return false;
	}
}

siteorigin_widget_register( 'bvg-teamclt', __FILE__, 'SiteOrigin_Widget_BvgTeamClt_Widget' );
