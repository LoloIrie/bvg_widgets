<?php

/**
 * Class SiteOrigin_Widget_Field_Bvg_checkbox
 */
if( !class_exists( 'SiteOrigin_Widget_Field_Bvg_checkbox' ) ) {
	class SiteOrigin_Widget_Field_Bvg_checkbox extends SiteOrigin_Widget_Field_Base
	{

		protected function render_field($value, $instance)
		{
			?>
			<label for="<?php echo esc_attr($this->element_id) ?>">
				<input type="checkbox" name="<?php echo esc_attr($this->element_name) ?>"
					   id="<?php echo esc_attr($this->element_id) ?>"
					   class="siteorigin-widget-input" <?php checked(!empty($value)) ?> value="<?php echo $this->field_options['userid'];?>" />
				<?php echo esc_attr($this->label) ?>
			</label>
			<?php
		}

		protected function render_field_label($value, $instance)
		{
			// Empty override. This field renders it's own label in the render_field() function.
		}

		protected function sanitize_field_input($value, $instance)
		{
			return !empty($value);
		}

	}
}