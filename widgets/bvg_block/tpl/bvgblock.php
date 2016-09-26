<?php //if( !empty( $instance['title'] ) ) echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];

$css_classes = array(
	0 => '',
	1 => 'mannschaft_foto',
	2 => 'mannschaft_slideshow',
	3 => 'mannschaft_spielplan'
);

if( isset( $css_class ) && $css_class > 0 ){
	$id = $css_classes[ $css_class ];
}

?>


<div class="siteorigin-widget-tinymce textwidget">
	<div class="bvg_block <?php echo $css_classes[ $css_class ] ?>" id="<?php echo $id ?>">

		<h1><?php echo $title ?></h1>

		<h3><?php echo $subtitle ?></h3>

		<?php echo $text ?>
	</div>
</div>
