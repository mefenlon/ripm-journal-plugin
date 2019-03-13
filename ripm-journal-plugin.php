<?php

/**
 * RIPM Journals
 *
 * @package RIPM Journals
 * @version 0.3.1
 * @author Matthew Fenlon <matthewfenlon@gmail.com>
 *
 *
 * Plugin name: RIPM Journals
 * Plugin URI:  https://github.com/mefenlon/ripm-journal-plugin/
 * Description: Plugin for RIPM Journal Custom Post Type and Journal related functions.
 * Version:     0.3.1
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
$rjpUpdateChecker->getVcsApi()->enableReleaseAssets();

//Add taxonomy filters
include(plugin_dir_path( __FILE__ ).'includes/filters.php');

//Add shortcodes
include(plugin_dir_path( __FILE__ ).'includes/shortcodes.php');
//Allow widgets to load shortcodes
add_filter('widget_text', 'do_shortcode');

//Theme modifications
include(plugin_dir_path( __FILE__ ).'includes/theme-modifications.php');



// Create ripm taxonomies
include(plugin_dir_path( __FILE__ ).'includes/city-taxonomy.php');
include(plugin_dir_path( __FILE__ ).'includes/country-taxonomy.php');
include(plugin_dir_path( __FILE__ ).'includes/editor-taxonomy.php');
include(plugin_dir_path( __FILE__ ).'includes/language-taxonomy.php');
include(plugin_dir_path( __FILE__ ).'includes/publisher-taxonomy.php');


// Create ripm post types
include(plugin_dir_path( __FILE__ ).'includes/journal-metabox.php');
include(plugin_dir_path( __FILE__ ).'includes/journal-post-type.php');



