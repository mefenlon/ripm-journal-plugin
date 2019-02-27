<?php

/**
 * RIPM Journals
 *
 * @package RIPM Journals
 * @version 0.1
 * @author Matthew Fenlon <matthewfenlon@gmail.com>
 *
 *
 * Plugin name: RIPM Journals
 * Plugin URI:  https://github.com/mefenlon/ripm-journal-plugin/
 * Description: Plugin for RIPM Journal Custom Post Type and Journal related functions.
 * Version:     0.1
 * Author:      Matthew Fenlon
 * Author URI:  https://github.com/mefenlon/
 * License:     GPLv2
 * Text Domain: ripm-journal-plugin
 * Domain Path: /languages
 * WordPress Available:  yes
 * Requires License:    no
 */


if ( ! defined( 'ABSPATH' ) ) exit;

//Load composer includes
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require( __DIR__ . '/vendor/autoload.php' );
}

$rjpUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/mefenlon/ripm-journal-plugin',
        __FILE__,
        'ripm-journal-plugin'
);

//Allow widgets to load shortcodes
add_filter('widget_text', 'do_shortcode');

// Create ripm taxonomies
function ripm_taxonomy_init() {
    include(plugin_dir_path( __FILE__ ).'includes/city-taxonomy.php');
    include(plugin_dir_path( __FILE__ ).'includes/country-taxonomy.php');
    include(plugin_dir_path( __FILE__ ).'includes/editor-taxonomy.php');
    include(plugin_dir_path( __FILE__ ).'includes/language-taxonomy.php');
    include(plugin_dir_path( __FILE__ ).'includes/publisher-taxonomy.php');
}
ripm_taxonomy_init();

// Create ripm post types
function ripm_post_type_init() {
    include(plugin_dir_path( __FILE__ ).'includes/journal-metabox.php');
    include(plugin_dir_path( __FILE__ ).'includes/journal-post-type.php');
    include(plugin_dir_path( __FILE__ ).'includes/journal-admin.php');
}
ripm_post_type_init();

function display_journal_meta($atts, $content = null ) {
     global $post;
     $atts = shortcode_atts( array(
		'container'       => 'ul',
        'container_id'    => 'ripm_journal.'.$post->ID,
        'container_class' => '',
        'item'       => 'li',
        'item_class' => ''
	), $atts, 'display_journal_meta' );


     $content = '';
     $custom_content = get_post_custom($post->ID);
     if(count($custom_content)){

        $content .= "<". $atts['container'] ." id='".$atts['container_id']. "' class='". $atts['container_class']. "'>";
         $city =  get_the_term_list( $post->ID, 'city', ' ', ', ' );
         if (!empty($city )) {
             $content .= "<". $atts['item'] ." id='ripm_journal_taxonomy_city' class='". $atts['item_class']. "'>";
             $content .= "Place of Publication: ";
             $content .= $city;
             $content .= "</". $atts['item'] . ">";
         }
         if (isset($custom_content["ripm_journal_meta_box_display_date"])) {
             $content .= "<". $atts['item'] ." id='ripm_journal_meta_box_display_date' class='". $atts['item_class']. "'>";
             $content .= "Date of Publication: ";
             $content .= implode(', ', $custom_content["ripm_journal_meta_box_display_date"]);
             $content .= "</". $atts['item'] . ">";
         }
        if (isset($custom_content["ripm_journal_meta_box_periodicity"])) {
            $content .= "<". $atts['item'] ." id='ripm_journal_meta_box_periodicity' class='". $atts['item_class']. "'>";
            $content .= "Periodicity: ";
            $content .= implode(', ', $custom_content["ripm_journal_meta_box_periodicity"]);
            $content .= "</". $atts['item'] . ">";
        }
         $editor = get_the_term_list( $post->ID, 'editor' ,  ' ' );
         if (!empty($editor)) {
             $content .= "<". $atts['item'] ." id='ripm_journal_taxonomy_editor' class='". $atts['item_class']. "'>";
             $content .= "Editor: ";
             $content .= $editor;
             $content .= "</". $atts['item'] . ">";
         }
         $publisher = get_the_term_list( $post->ID, 'publisher' ,  ' ' );
         if (!empty($publisher)) {
             $content .= "<". $atts['item'] ." id='ripm_journal_taxonomy_publisher' class='". $atts['item_class']. "'>";
             $content .= "Place of Publication: ";
             $content .= $publisher;
             $content .= "</". $atts['item'] . ">";
         }
         $content .= "</". $atts['container'] . ">";
     }

     return $content;
}
add_shortcode('display_journal_meta', 'display_journal_meta');


function display_journal_table($atts, $content = null ) {
    $atts = array(
        'table_class' => 'tablesorter {sortlist: [[0,0],[1,0]]}',
    );
    $args = array(
        'post_type' => 'ripm_journal',
        'orderby'  => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ),
        'meta_key' => 'ripm_journal_meta_box_start_year',
        'nopaging' => true,
    );

    $post_query = new WP_Query($args);
    if($post_query->have_posts() ) {

        $table = <<< HTML
        <table class="{$atts['table_class']}">
            <thead>
            <tr>
                <th class="dateFormat-yyyy">Date</th>
                <th>Title</th>
                <th>Language</th>
            </tr>
            </thead>
            <tbody>

HTML;

        while($post_query->have_posts() ) {
            $post_query->the_post();
            $custom_content = get_post_custom($post_query->post->ID);
            if (isset($custom_content["ripm_journal_meta_box_display_date"])) {
                $display_date= implode(', ', $custom_content["ripm_journal_meta_box_display_date"]);
            }
            if (isset($custom_content["ripm_journal_meta_box_start_year"])) {
                $year= implode(', ', $custom_content["ripm_journal_meta_box_start_year"]);
            }
            $city =  get_the_term_list( $post_query->post->ID, 'city', ' ', ', ' );
            $language =  get_the_term_list( $post_query->post->ID, 'language', ' ', ', ' );

            $display_title = '<a href="'.esc_url( get_permalink( $post_query->post->ID ) ).'">' .
                get_the_title($post_query->post->ID)
                . '</a> (' . $city . ', '. $display_date .')';

            $table .= <<< HTML
                <tr>
                    <td>{$year}</td>
                    <td>{$display_title}</td>
                    <td>{$language}</td>
                </tr>

HTML;
        }

        $table .= <<< HTML
            </tbody>
        </table>

HTML;
    }

    return $table;
}
add_shortcode('display_journal_table', 'display_journal_table');


//
//function include_template_function( $template_path ) {
//    if ( get_post_type() == 'ripm_journal' ) {
//        if ( is_single() ) {
//            // checks if the file exists in the theme first,
//            // otherwise serve the file from the plugin
//            if ( $theme_file = locate_template( array ( 'single-ripm_journal.php' ) ) ) {
//                $template_path = $theme_file;
//            } else {
//                $template_path = plugin_dir_path( __FILE__ ) . '/templates/single-ripm_journal_elm.php';
//            }
//        }elseif ( is_archive() ) {
//            if ( $theme_file = locate_template( array ( 'archive-ripm_journal.php' ) ) ) {
//                $template_path = $theme_file;
//            } else {
//                $template_path = plugin_dir_path( __FILE__ ) . '/templates/archive-ripm_journal.php';
//            }
//        }
//    }
//    return $template_path;
//}
//add_filter( 'template_include', 'include_template_function', 1 );
