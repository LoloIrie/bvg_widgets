<?php
/*
Plugin Name: BVG Widgets
Description: A collection of widgets for the BVG website
Version: 1.0
Author: Laurent Dorier
Author URI: http://etalkers.org
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

/* SiteOrigin Widgets */
function add_bvg_widgets_collection($folders){
    $folders[] = plugin_dir_path(__FILE__).'widgets/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_bvg_widgets_collection');

define('BVGW_VERSION', '1.0');
define('BVGW_BASE_FILE', __FILE__);

/* Include class file */
//include plugin_dir_path(__FILE__).'inc/bvg_widgets_class.php';

//add_action( 'widgets_init' , 'bvg_widget_init' );
//wp_enqueue_script( 'bvg_tinymce', plugin_dir_url( __FILE__ ) . 'javascript/bvg_tinymce.min.js', array() );


/* GET STYLE AND SCRIPT ROM THEME BVG */
/* Include CSS File for the admin */
function bvg_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', get_template_directory_uri() . '/../bvg/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'bvg_admin_theme_style');

function bvg_admin_theme_script(){
    wp_enqueue_script('my-admin-theme', get_template_directory_uri() . '/../bvg/wp-admin.js', array( 'jquery' ) );
}
add_action('admin_enqueue_scripts', 'bvg_admin_theme_script');

?>