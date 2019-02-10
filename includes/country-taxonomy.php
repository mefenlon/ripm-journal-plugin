<?php
/**
 * Register Country Taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function ripm_country_taxonomy_init() {

    // create a new Country taxonomy
    // NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Countries', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Country', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Countries', 'textdomain' ),
		'popular_items'              => __( 'Popular Countries', 'textdomain' ),
		'all_items'                  => __( 'All Countries', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Country', 'textdomain' ),
		'update_item'                => __( 'Update Country', 'textdomain' ),
		'add_new_item'               => __( 'Add New Country', 'textdomain' ),
		'new_item_name'              => __( 'New Country Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate countries with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove countries', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used countries', 'textdomain' ),
		'not_found'                  => __( 'No countries found.', 'textdomain' ),
		'menu_name'                  => __( 'Countries', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'country' ),
	);

    register_taxonomy( 'country', 'ripm_journal', $args );
}
add_action( 'init', 'ripm_country_taxonomy_init' );



?>