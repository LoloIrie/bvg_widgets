<?php

/**
 *
 * This class is used when a field class can't be found to display an error message to the user.
 *
 * Class SiteOrigin_Widget_Field_Error
 */
if( !class_exists( 'SiteOrigin_Widget_Field_Bvg_label' ) ) {
	class SiteOrigin_Widget_Field_Bvg_label extends SiteOrigin_Widget_Field_Base
	{

		/**
		 * A label ONLY to display.
		 *
		 * @access protected
		 * @var string
		 */
		protected $message;

		protected function render_field($value, $instance)
		{
			echo '<h2>' . $this->message . '</h2>';
		}

		protected function sanitize_field_input($value, $instance)
		{
			return $value;
		}
	}
}