<?php

/**
 *
 * This class is used when a field class can't be found to display an error message to the user.
 *
 * Class SiteOrigin_Widget_Field_Error
 */
if( !class_exists( 'SiteOrigin_Widget_Field_Bvg_hidden' ) ) {
	class SiteOrigin_Widget_Field_Bvg_hidden extends SiteOrigin_Widget_Field_Base
	{

		/**
		 * A label to display
		 *
		 * @access protected
		 * @var string
		 */
		protected $message;

		/**
		 * Type of field
		 *
		 * @access protected
		 * @var string
		 */
		protected $subtype;


		protected function render_field($value, $instance)
		{
			//var_dump( $value );
			$select_values = array(
				0 => __('None', 'so-widgets-bundle'),
				1 => __('Team Photo', 'so-widgets-bundle'),
				2 => __('Team Slideshow', 'so-widgets-bundle'),
				3 => __('Game Calendar', 'so-widgets-bundle'),
			);
			if( !$value ){
				$value = 0;
			}
			switch( $this->subtype ){
				case 'select':
					echo '<h2>' . $this->message . '</h2>'.$select_values[ $value ];
					echo '<input type="hidden" name="'.esc_attr( $this->element_name ).'" id="'.esc_attr( $this->element_id ).'" value="'.$value.'" />';
					break;

				case 'none':
					echo '<input type="hidden" name="'.esc_attr( $this->element_name ).'" id="'.esc_attr( $this->element_id ).'" value="'.$value.'" />';
					break;

				case 'username_from_id':
					$userdata = WP_User::get_data_by( 'id', (int) $value );
					//var_dump( $userdata );
					$username = $userdata->display_name;
					echo '<h2>' . $this->message . '</h2>'.$username;
					echo '<input type="hidden" name="'.esc_attr( $this->element_name ).'" id="'.esc_attr( $this->element_id ).'" value="'.$value.'" />';
					break;

				default:
					echo '<h2>' . $this->label . '</h2>';
					break;
			}


		}

		protected function sanitize_field_input($value, $instance)
		{
			return $value;
		}
	}
}