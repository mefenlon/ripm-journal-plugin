<?php
/**
 * Register Language Taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


if ( ! function_exists( 'ripm_jcpt_language_taxonomy_init' ) ) {
    add_action('init', 'ripm_jcpt_language_taxonomy_init');

    function ripm_jcpt_language_taxonomy_init()
    {

        // create a new Language taxonomy
        // NOT hierarchical
        $labels = array(
            'name' => _x('Languages', 'taxonomy general name', 'textdomain'),
            'singular_name' => _x('Language', 'taxonomy singular name', 'textdomain'),
            'search_items' => __('Search Languages', 'textdomain'),
            'popular_items' => __('Popular Languages', 'textdomain'),
            'all_items' => __('All Languages', 'textdomain'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Language', 'textdomain'),
            'update_item' => __('Update Language', 'textdomain'),
            'add_new_item' => __('Add New Language', 'textdomain'),
            'new_item_name' => __('New Language Name', 'textdomain'),
            'separate_items_with_commas' => __('USE -- in place of a comma within a language. <br>Separate languages with commas', 'textdomain'),
            'add_or_remove_items' => __('Add or remove languages', 'textdomain'),
            'choose_from_most_used' => __('Choose from the most used languages', 'textdomain'),
            'not_found' => __('No languages found.', 'textdomain'),
            'menu_name' => __('Languages', 'textdomain'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'language'),
        );

        register_taxonomy('language', 'ripm_journal', $args);
    }

}