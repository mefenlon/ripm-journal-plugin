<?php
/**
 * Register Publisher Taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ripm_jcpt_publisher_taxonomy_init' ) ) {
    add_action('init', 'ripm_jcpt_publisher_taxonomy_init');

    function ripm_jcpt_publisher_taxonomy_init()
    {

        // create a new Publisher taxonomy
        // NOT hierarchical
        $labels = array(
            'name' => _x('Publishers', 'taxonomy general name', 'textdomain'),
            'singular_name' => _x('Publisher', 'taxonomy singular name', 'textdomain'),
            'search_items' => __('Search Publishers', 'textdomain'),
            'popular_items' => __('Popular Publishers', 'textdomain'),
            'all_items' => __('All Publishers', 'textdomain'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Publisher', 'textdomain'),
            'update_item' => __('Update Publisher', 'textdomain'),
            'add_new_item' => __('Add New Publisher', 'textdomain'),
            'new_item_name' => __('New Publisher Name', 'textdomain'),
            'separate_items_with_commas' => __('USE -- in place of a comma within a single publisher. <br>Separate publishers with commas', 'textdomain'),
            'add_or_remove_items' => __('Add or remove publishers', 'textdomain'),
            'choose_from_most_used' => __('Choose from the most used publishers', 'textdomain'),
            'not_found' => __('No publishers found.', 'textdomain'),
            'menu_name' => __('Publishers', 'textdomain'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'publisher'),
        );

        register_taxonomy('publisher', 'ripm_journal', $args);
    }
}


?>