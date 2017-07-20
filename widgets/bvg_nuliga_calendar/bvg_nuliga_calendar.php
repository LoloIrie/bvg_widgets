<?php

/*
Widget Name: BVG nuLiga Calendar for all BVG teams
Description: A widget which displays next team games for one team on the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/

class SiteOrigin_Widget_BvgNuligaAllTeamsCalendar_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-nuligaallteamscalendar',
			__('BVG nuLiga All Teams Calendar', 'so-widgets-bundle'),
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
				'message' => __('Widget nuLiga Calendar Label', 'so-widgets-bundle'),
			),
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'so-widgets-bundle')
			),
			'url' => array(
				'type' => 'text',
				'label' => __('Liga.nu URL', 'so-widgets-bundle')
			)
		);
	}

	public function get_template_variables( $instance, $args ) {

		$instance = wp_parse_args(
			$instance,
			array(  'title' => '', 'url' => '' )
		);

		$url = $instance[ 'url' ];
		// Get nuLiga Infos
        if( current_user_can( 'remove_users' ) && isset( $_GET[ 'cache' ] ) && $_GET[ 'cache' ] === 'no' ){
            $nuliga_info_cached = false;
        }else{
            $nuliga_info_cached = get_transient( 'nuliga_allteams_calendar_info_cached' );
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

				$html_brut = file_get_contents( $url, false, $cxContext );
			}else{
				$html_brut = file_get_contents( $url );
			}

			$html_start = '<h2>Spielbetrieb - Rückschau</h2>';
			$html_end = '</div>';

			$html_parts = explode( $html_start , $html_brut );
			$html_brut = $html_parts[1];
			$html_parts = explode( $html_end , $html_brut );
			$html = $html_parts[0];
			$html = str_replace( 'href="', 'target="_blank" href="http://hbv-badminton.liga.nu', $html );
			$html = str_replace( 'src="/WebObjects', 'src="http://hbv-badminton.liga.nu/WebObjects', $html );

			$html = '<h3 id="spielplan_next" class="h3float">Spielbetrieb Vorschau</h3><h3 id="spielplan_prec" class="h3float pseudo_link">Spielbetrieb Rückschau anzeigen...</h3><div style="display: none;">' . $html;
			$html = str_replace( '<h2>Spielbetrieb Vorschau</h2>', '</div><h3 id="spielplan_next2" style="display: none;">Spielbetrieb Vorschau</h3><div>', $html );
			$html .= '</div>';
			/*
			$heads_toRemove = array( );
			$cols_toRemove = array( );
			$html = remove_columns( $html, $heads_toRemove, $cols_toRemove );
			*/
			
            $html .= $last_update_txt . '<br />Informationen von <a href="'.$url.'" target="_blank">Liga.nu</a>';

			set_transient( 'nuliga_allteams_calendar_info_cached', $html, 60*60*24 );
		}else{
			$html = $nuliga_info_cached;
			$html .= '<span style="display:none;"> from CACHE...</span>';
			//delete_transient( 'nuliga_allteams_calendar_info_cached' );
		}

		return array(
			'title' => $instance['title'],
			'bvg_allteams_calendar' => $html
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

siteorigin_widget_register( 'bvg-nuligaallteamscalendar', __FILE__, 'SiteOrigin_Widget_BvgNuligaAllTeamsCalendar_Widget' );
