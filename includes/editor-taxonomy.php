<?php
/**
 * Register Editor Taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function ripm_editor_taxonomy_init() {

    // create a new Editor taxonomy
    // NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Editors', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Editor', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Editors', 'textdomain' ),
		'popular_items'              => __( 'Popular Editors', 'textdomain' ),
		'all_items'                  => __( 'All Editors', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Editor', 'textdomain' ),
		'update_item'                => __( 'Update Editor', 'textdomain' ),
		'add_new_item'               => __( 'Add New Editor', 'textdomain' ),
		'new_item_name'              => __( 'New Editor Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate editors with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove editors', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used editors', 'textdomain' ),
		'not_found'                  => __( 'No editors found.', 'textdomain' ),
		'menu_name'                  => __( 'Editors', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'editor' ),
	);

    register_taxonomy( 'editor', 'ripm_journal', $args );
}
add_action( 'init', 'ripm_editor_taxonomy_init' );



?>