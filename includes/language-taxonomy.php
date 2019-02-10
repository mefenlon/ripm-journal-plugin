<?php
/**
 * Register Lanugage Taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function ripm_lanugage_taxonomy_init() {

    // create a new Lanugage taxonomy
    // NOT hierarchical
    $labels = array(
        'name'                       => _x( 'Lanugages', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Lanugage', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Lanugages', 'textdomain' ),
        'popular_items'              => __( 'Popular Lanugages', 'textdomain' ),
        'all_items'                  => __( 'All Lanugages', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Lanugage', 'textdomain' ),
        'update_item'                => __( 'Update Lanugage', 'textdomain' ),
        'add_new_item'               => __( 'Add New Lanugage', 'textdomain' ),
        'new_item_name'              => __( 'New Lanugage Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate lanugages with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove lanugages', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used lanugages', 'textdomain' ),
        'not_found'                  => __( 'No lanugages found.', 'textdomain' ),
        'menu_name'                  => __( 'Lanugages', 'textdomain' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'lanugage' ),
    );

    register_taxonomy( 'lanugage', 'ripm_journal', $args );
}
add_action( 'init', 'ripm_lanugage_taxonomy_init' );