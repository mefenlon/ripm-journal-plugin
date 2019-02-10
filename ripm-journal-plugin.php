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


/**
 * Main plugin class
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require( __DIR__ . '/vendor/autoload.php' );
}



$rjpUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/mefenlon/ripm-journal-plugin',
        __FILE__,
        'ripm-journal-plugin'
);

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


/**
 * Template loader.
 *
 * The template loader will check if WP is loading a template
 * for a specific Post Type and will try to load the template
 * from out 'templates' directory.
 *
 * @since 1.0.0
 *
 * @param	string	$template	Template file that is being loaded.
 * @return	string				Template file that should be loaded.
 */
function wcpt_template_loader( $template ) {
    $find = array();
    $file = '';
    if ( is_singular( 'ripm_journal' ) ) :
        $file = plugin_dir_path( __FILE__ ).'templates/single-ripm_journal.php';
    elseif ( is_singular( 'ripm_journal' ) ) :
        $file = plugin_dir_path( __FILE__ ).'templates/single-ripm_journal.php';
    endif;
    if ( file_exists($file ) ) :
        $template =  $file ;
    endif;
    return $template;
}
add_filter( 'template_include', 'wcpt_template_loader' );



function ripm_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    //ripm_journal_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ripm_rewrite_flush' );
add_action( 'after_switch_theme', 'ripm_rewrite_flush' );



function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}


