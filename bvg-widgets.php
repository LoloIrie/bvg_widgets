<?php
/*
Plugin Name: BVG Widgets
Description: A collection of widgets for the BVG website
Version: 2.0.1
Author: Laurent Dorier
Author URI: http://etalkers.org
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

/* Include nuLiga constants and variables */
include plugin_dir_path(__FILE__).'nuliga_constants.php';

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




/* Global functions */
if( !function_exists( 'bvg_editor' ) ){
    function bvg_editor($str = '', $id)
    {
        wp_editor($str, $id);
    }
}

if( !function_exists( 'remove_columns' ) ){
    function remove_columns( $html='', $heads_toRemove = array(), $cols_toRemove = array() ){

        $html_return = '';

        //$html = str_replace( '&', '&amp;', $html );
        // $html = str_replace( 'th>', 'td>', $html);
        // $html = str_replace( '<th', '<td', $html);
        $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        // a new dom object
        $dom = new domDocument;

        // load the html into the object
        echo 'XXXXXXX: '.$html;
        die();
        $dom->loadHTML( $html );

        // discard white space
        $dom->preserveWhiteSpace = false;

        // Get all rows
        $trList = $dom->getElementsByTagName('tr');

        $tr_head = 1;
        foreach ($trList as $tr) {

            // Header
            if( $tr_head === 1 && !empty( $heads_toRemove ) ){
                $tdList = $tr->getElementsByTagName('th');
                foreach( $heads_toRemove as $column_nb ){
                    $tr->removeChild( $tdList->item( $column_nb ) );
                }
                $tr_head++;
            }else if( $tr_head > 1 && !empty( $cols_toRemove ) ){
                $tdList = $tr->getElementsByTagName('td');
                // Content rows
                foreach( $cols_toRemove as $column_nb ){
                    /*
                    echo $column_nb.': ';
                    $xml = $tr->ownerDocument->saveXML($tr);
                    echo $xml;
                    echo '<br />';
                    */
                    $tr->removeChild( $tdList->item( $column_nb ) );
                }

            }

        }

        $html = $dom->saveHTML();

        $html_return = $html;

        $html_return = str_replace( '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">' , '' , $html_return );
        $html_return = str_replace( '<html><body>' , '' , $html_return );
        $html_return = str_replace( '</body></html>' , '' , $html_return );

        return $html_return;

    }
}


?>