<?php

/*
Widget Name: BVG nuLiga Team Calendar
Description: A widget which displays next team games for one team on the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/

class SiteOrigin_Widget_BvgNuligaTeamTable_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-nuligateamtable',
			__('BVG nuLiga Team Table', 'so-widgets-bundle'),
			array(
				'description' => __('Next games for one team from nuLiga', 'so-widgets-bundle'),
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
				'message' => __('Widget nuLiga Table Label', 'so-widgets-bundle'),
			),
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'so-widgets-bundle'),
			),
			'team' => array(
				'type' => 'select',
				'label' => __('Team', 'so-widgets-bundle'),
				'options' => array(
					'A1' => __('1. Mannschaft', 'so-widgets-bundle'),
					'A2' => __('2. Mannschaft', 'so-widgets-bundle'),
					'A3' => __('3. Mannschaft', 'so-widgets-bundle'),
					'A4' => __('4. Mannschaft', 'so-widgets-bundle'),
					'A5' => __('5. Mannschaft', 'so-widgets-bundle'),

					'J1' => __('Jugend 1', 'so-widgets-bundle'),

					'S1' => __('Schüler 1', 'so-widgets-bundle'),
					'S2' => __('Schüler 2', 'so-widgets-bundle'),

					'U13_1' => __('U13', 'so-widgets-bundle'),
				)
			)
		);
	}

	public function get_template_variables( $instance, $args ) {
		global $NULIGA_TEAMS_TABLE_URL;

		$instance = wp_parse_args(
			$instance,
			array(  'title' => '', 'team' => '' )
		);

		$url_team = $NULIGA_TEAMS_TABLE_URL[ $instance['team'] ];

		// Get nuLiga Infos
        if( is_admin() && isset( $_GET[ 'cache' ] ) && $_GET[ 'cache' ] === 'no' ){
            $nuliga_info_cached = false;
        }else{
            $nuliga_info_cached = get_transient( 'nuliga_team'.$instance['team'].'_table_info_cached' );
        }
		

		$last_update_txt = '';
		if( false === $nuliga_info_cached ) {
			$last_update_txt = 'Aktualisiert am ' . date( 'd.m.Y H:i' );
			if( defined( 'WP_PROXY_HOST' ) ){
				$aContext = array(
					'http' => array(
						'proxy' => 'tcp://'.WP_PROXY_HOST.':'.WP_PROXY_PORT,
						'request_fulluri' => true,
					),
				);
				$cxContext = stream_context_create($aContext);

				$html_brut = file_get_contents( $url_team, false, $cxContext );
			}else{
				$html_brut = file_get_contents( $url_team );
			}

			$html_start = '<h2>Tabelle</h2>';
			$html_end = '<h2>Spielplan';

			$html_parts = explode( $html_start , $html_brut );
			$html_brut = $html_parts[1];
			$html_parts = explode( $html_end , $html_brut );
			$html = $html_parts[0];
			$html = str_replace( 'href="', 'target="_blank" href="http://hbv-badminton.liga.nu', $html );
			$html = str_replace( 'src="/WebObjects', 'src="http://hbv-badminton.liga.nu/WebObjects', $html );


			/*
			$heads_toRemove = array( );
			$cols_toRemove = array( );
			$html = remove_columns( $html, $heads_toRemove, $cols_toRemove );
			*/
			$html .= $last_update_txt . '<br />Informationen von <a href="'.$url_team.'" target="_blank">Liga.nu</a>';

			set_transient( 'nuliga_team'.$instance['team'].'_table_info_cached', $html, 60*60*24 );
		}else{
			$html = $nuliga_info_cached;
			$html .= '<span style="display:none;"> from CACHE...</span>';
			//delete_transient( 'nuliga_team'.$instance['team'].'_table_info_cached' );
		}

		return array(
			'title' => $instance['title'],
			'bvg_team_table' => $html
		);
	}

	function get_template_name($instance) {
		return 'bvgteamtable';
	}

	function get_style_name($instance) {
		// We're not using a style
		return false;
	}
}

siteorigin_widget_register( 'bvg-nuligateamtable', __FILE__, 'SiteOrigin_Widget_BvgNuligaTeamTable_Widget' );
