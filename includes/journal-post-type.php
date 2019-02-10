<?php
/**
 * Registerripm journal post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function ripm_journal_init() {
	$labels = array(
		'name'               => _x( 'Journals', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Journal', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Journals', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Journal', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'journal', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Journal', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Journal', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Journal', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Journal', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Journals', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Journals', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Journals:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No journals found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No journals found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'journal' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'           => 'dashicons-book-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'register_meta_box_cb' => 'ripm_journal_meta_box_add',
        "taxonomies" => array( 'category', 'post_tag' ),
	);

	register_post_type( 'ripm_journal', $args );
}
add_action( 'init', 'ripm_journal_init' );
