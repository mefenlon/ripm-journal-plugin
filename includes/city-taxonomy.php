<?php
/**
 * Register City Taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


if ( ! function_exists( 'ripm_jcpt_city_taxonomy_init' ) ) {
    add_action( 'init', 'ripm_jcpt_city_taxonomy_init' );

    function ripm_jcpt_city_taxonomy_init()
    {

        // create a new City taxonomy
        // NOT hierarchical
        $labels = array(
            'name' => _x('Cities', 'taxonomy general name', 'textdomain'),
            'singular_name' => _x('City', 'taxonomy singular name', 'textdomain'),
            'search_items' => __('Search Cities', 'textdomain'),
            'popular_items' => __('Popular Cities', 'textdomain'),
            'all_items' => __('All Cities', 'textdomain'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit City', 'textdomain'),
            'update_item' => __('Update City', 'textdomain'),
            'add_new_item' => __('Add New City', 'textdomain'),
            'new_item_name' => __('New City Name', 'textdomain'),
            'separate_items_with_commas' => __('USE -- in place of a comma within a location. <br>Separate locations with commas', 'textdomain'),
            'add_or_remove_items' => __('Add or remove cities', 'textdomain'),
            'choose_from_most_used' => __('Choose from the most used cities', 'textdomain'),
            'not_found' => __('No cities found.', 'textdomain'),
            'menu_name' => __('Cities', 'textdomain'),
        );

        $args = array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => false,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'city'),
        );

        register_taxonomy('city', 'ripm_journal', $args);
    }
}



?>