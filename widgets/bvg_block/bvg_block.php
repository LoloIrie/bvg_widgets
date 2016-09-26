<?php

/*
Widget Name: BVG Block
Description: A widget which displays a text or HTML Block for the BVG website.
Author: Laurent Dorier
Author URI: https://etalkers.org
*/


class SiteOrigin_Widget_BvgBlock_Widget extends SiteOrigin_Widget {

	function __construct() {

		parent::__construct(
			'bvg-block',
			__('BVG Block', 'so-widgets-bundle'),
			array(
				'description' => __('Text or HTML block.', 'so-widgets-bundle'),
				'help' => '',
				'instance_storage' => true,
			),
			array(),
			false,
			plugin_dir_path(__FILE__)
		);
	}

	function initialize_form(){
		//echo '<script>alert(\'Happy ?\');</script>';
		//global $storage_hash;

		//var_dump( get_class_methods('SiteOrigin_Widget') );
		//var_dump( get_object_vars($this) );
		//var_dump($GLOBALS);
		include_once plugin_dir_path(__FILE__).'assets/bvg_label.class.php';
		include_once plugin_dir_path(__FILE__).'assets/bvg_hidden.class.php';
		include_once plugin_dir_path(__FILE__).'assets/bvg_checkbox.class.php';

		$instance = json_decode( wp_unslash( $_REQUEST['instance'] ) , true );
		//var_dump( $instance );

		$user_is_allowed = false;
		$user_id = get_current_user_id();
		if( is_admin() ||( isset( $instance['adminonly'] ) && $user_id == $instance['adminonly']) ) {
		//if( ( isset( $instance['adminonly'] ) && get_current_user_id() == 3) ) {
			$user_is_allowed = true;
		}

		if( $user_is_allowed ){
			//echo 'ID: '.$instance['adminonly'];
			$fields = array(
				'editor_msg' => array(
					'type' => 'bvg_label',
					'message' => __('Widget Block Label', 'so-widgets-bundle'),
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
					'rows' => 20
				),
				'autop' => array(
					'type' => 'checkbox',
					'default' => true,
					'label' => __('Automatically add paragraphs', 'so-widgets-bundle'),
				),
				'id' => array(
					'type' => 'text',
					'label' => __('Id', 'so-widgets-bundle'),
				),
				'css_class' => array(
					'type' => 'select',
					'label' => __('CSS Class', 'so-widgets-bundle'),
					'options' => array(
						0 => __('None', 'so-widgets-bundle'),
						1 => __('Team Photo', 'so-widgets-bundle'),
						2 => __('Team Slideshow', 'so-widgets-bundle'),
						3 => __('Game Calendar', 'so-widgets-bundle'),
					)
				),
				'adminonly' => array(
					'userid' => $user_id,
					'type' => 'bvg_checkbox',
					'default' => false,
					'label' => __('Only admins are allowed to edit this widget', 'so-widgets-bundle'),
				),
			);
		}else{

			if ( ! is_admin_bar_showing() ){
				echo '<h2 class="admin_bvg_alert">Nur die Admins und der Ersteller dürfen dieses Widget editieren...</h2>';
			}
			$fields = array(
				'editor_msg' => array(
					'type' => 'bvg_label',
					'label' => '',
					'readonly' => true
				),
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'so-widgets-bundle'),
					'readonly' => true
				),
				'subtitle' => array(
					'type' => 'text',
					'label' => __('Subtitle', 'so-widgets-bundle'),
					'readonly' => true
				),
				'text' => array(
					'label' => 'Inhalt',
					'type' => 'textarea',
					'rows' => 20,
					'readonly' => true
				),
				'id' => array(
					'type' => 'text',
					'label' => __('Id', 'so-widgets-bundle'),
					'readonly' => true
				),
				'css_class' => array(
					'type' => 'bvg_hidden',
					'subtype' => 'select',
					'message' => 'Aktuelle CSS Klasse: '
				),
				'autop' => array(
					'type' => 'bvg_hidden',
					'subtype' => 'none',
					'label' => ''
				),
				'adminonly' => array(
					'type' => 'bvg_hidden',
					'subtype' => 'username_from_id',
					'message' => 'Erstellt von: '
				),
			);
		}




		return $fields;
	}

	function unwpautop($string) {
		$string = str_replace("<p>", "", $string);
		$string = str_replace(array("<br />", "<br>", "<br/>"), "\n", $string);
		$string = str_replace("</p>", "\n\n", $string);

		return $string;
	}

	public function get_template_variables( $instance, $args ) {
		$instance = wp_parse_args(
			$instance,
			array(  'title' => '', 'subtitle' => '', 'text' => '' )
		);

		$instance['text'] = $this->unwpautop( $instance['text'] );
		$instance['text'] = apply_filters( 'widget_text', $instance['text'] );

		// Run some known stuff
		if( !empty($GLOBALS['wp_embed']) ) {
			$instance['text'] = $GLOBALS['wp_embed']->autoembed( $instance['text'] );
		}
		if (function_exists('wp_make_content_images_responsive')) {
			$instance['text'] = wp_make_content_images_responsive( $instance['text'] );
		}
		if( $instance['autop'] ) {
			$instance['text'] = wpautop( $instance['text'] );
		}
		$instance['text'] = do_shortcode( shortcode_unautop( $instance['text'] ) );

		return array(
			'title' => $instance['title'],
			'subtitle' => $instance['subtitle'],
			'text' => $instance['text'],
			'css_class' => $instance['css_class'],
			'id' => $instance['id'],
		);
	}


	function get_template_name($instance) {
		return 'bvgblock';
	}

	function get_style_name($instance) {
		// We're not using a style
		return false;
	}


	public function update( $new_instance, $old_instance, $form_type = 'widget' ) {

		$user_is_allowed = false;
		if( is_admin() || ( isset( $old_instance['adminonly'] ) && get_current_user_id() == $old_instance['adminonly']) ) {
			$user_is_allowed = true;
		}

		if( !$user_is_allowed ){
			wp_die( 'Sie d�rfen nicht dieses Widget editieren...' );
			return false;
		}


		//var_dump( $old_instance );
		//var_dump( $new_instance );
		if( !class_exists('SiteOrigin_Widgets_Color_Object') ) require plugin_dir_path( __FILE__ ).'../../../so-widgets-bundle/base/inc/color.php';

		$form_options = $this->form_options();
		if( ! empty( $form_options ) ) {
			/* @var $field_factory SiteOrigin_Widget_Field_Factory */
			$field_factory = SiteOrigin_Widget_Field_Factory::single();
			foreach ( $form_options as $field_name => $field_options ) {
				//var_dump( $field_name );
				//var_dump( $old_instance[$field_name] );
				/* @var $field SiteOrigin_Widget_Field_Base */
				if ( !empty( $this->fields ) && !empty( $this->fields[$field_name] ) ) {
					$field = $this->fields[$field_name];
				}
				else {
					$field = $field_factory->create_field( $field_name, $field_options, $this );
					$this->fields[$field_name] = $field;
				}
				$new_instance[$field_name] = $field->sanitize( isset( $new_instance[$field_name] ) ? $new_instance[$field_name] : null, $new_instance );

				/*
				if( $old_instance['adminonly'] == 'on' && $field_name === 'subtitle' ){
					//echo $field_name.' ';
					$new_instance[$field_name] = $old_instance[$field_name];
				}
				*/
				$new_instance = $field->sanitize_instance( $new_instance );
			}

			// Let other plugins also sanitize the instance
			$new_instance = apply_filters( 'siteorigin_widgets_sanitize_instance', $new_instance, $form_options, $this );
			$new_instance = apply_filters( 'siteorigin_widgets_sanitize_instance_' . $this->id_base, $new_instance, $form_options, $this );
		}
		//die();
		// Remove the old CSS, it'll be regenerated on page load.
		//$this->delete_css( $this->modify_instance( $new_instance ) );
		return $new_instance;
	}
}

siteorigin_widget_register( 'bvg-block', __FILE__, 'SiteOrigin_Widget_BvgBlock_Widget' );
