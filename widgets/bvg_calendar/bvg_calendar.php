<?php

/*
Widget Name: BVG Google Calendar
Description: A widget which displays a Google calendar for the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/

class SiteOrigin_Widget_Calendar_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-calendar',
			__('BVG Google Calendar', 'so-widgets-bundle'),
			array(
				'description' => __('Calendar', 'so-widgets-bundle'),
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


		$form_fields = array(
            'label' => array(
                'type' => 'bvg_label',
                'message' => __('Widget Calendar Label', 'so-widgets-bundle'),
            ),
            'id' => array(
                'type' => 'text',
                'label' => __('Id', 'so-widgets-bundle'),
            ),
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'so-widgets-bundle'),
            ),
            'subtitle' => array(
                'type' => 'text',
                'label' => __('Subtitle', 'so-widgets-bundle'),
            ),
            'text' => array(
                'type' => 'tinymce',
                'label' => __('Text', 'so-widgets-bundle'),
            ),
            'layout' => array(
                'type' => 'radio',
                'label' => __('Calendar Layout', 'so-widgets-bundle'),
                'default' => 'WEEK',
                'options' => array(
                    'WEEK' => 'Woche',
                    'MONTH' => 'Monat',
                    'AGENDA' => 'Agenda'
                )
            ),
            'width' => array(
                'type' => 'text',
                'label' => __('Width', 'so-widgets-bundle'),
            ),
            'height' => array(
                'type' => 'text',
                'label' => __('Height', 'so-widgets-bundle'),
            )
        );

        include plugin_dir_path(__FILE__).'../../nuliga_constants.php';
        foreach( $GOOGLE_CALENDARS_NAMES as $k => $v ){
            $form_fields[ 'calendar'.$k ] = array(
                'type' => 'checkbox',
                'label' => __( $v, 'so-widgets-bundle')
            );
        }

        return $form_fields;
	}

	public function get_template_variables( $instance, $args ) {
		$instance = wp_parse_args(
			$instance,
			array(  'title' => 'Kalendar', 'subtitle' => '', 'layout' => 'WEEK' )
		);

		$instance['text'] = apply_filters( 'widget_text', $instance['text'] );

		// Run some known stuff
		if( !empty($GLOBALS['wp_embed']) ) {
			$instance['text'] = $GLOBALS['wp_embed']->autoembed( $instance['text'] );
		}
		if (function_exists('wp_make_content_images_responsive')) {
			$instance['text'] = wp_make_content_images_responsive( $instance['text'] );
		}
		
		return array(
			'title' => $instance['title'],
			'subtitle' => $instance['subtitle'],
			'text' => $instance['text'],
			'calendar1' => $instance['calendar1'],
			'calendar2' => $instance['calendar2'],
			'calendar3' => $instance['calendar3'],
			'calendar4' => $instance['calendar4'],
			'calendar5' => $instance['calendar5'],
			'calendar6' => $instance['calendar6'],
			'calendar7' => $instance['calendar7'],
			'calendar8' => $instance['calendar8'],
			'calendar9' => $instance['calendar9'],
			'calendar10' => $instance['calendar10'],
			'calendar11' => $instance['calendar11'],
			'calendar12' => $instance['calendar12'],
			'calendar13' => $instance['calendar13'],
			'calendar14' => $instance['calendar14'],
			'calendar15' => $instance['calendar15'],
			'calendar16' => $instance['calendar16'],
			'calendar17' => $instance['calendar17'],
			'layout' => $instance['layout'],
			'id' => $instance['id'],
			'width' => $instance['width'],
			'height' => $instance['height'],
		);
	}


	function get_template_name($instance) {
		return 'bvgcalendar';
	}

	function get_style_name($instance) {
		// We're not using a style
		return false;
	}
}

siteorigin_widget_register( 'bvg-calendar', __FILE__, 'SiteOrigin_Widget_Calendar_Widget' );
