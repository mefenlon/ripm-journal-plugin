<?php
/*
Plugin Name: RIPM Journals
Description: Journals Custom Post Type
Author: matthewfenlon@gmail.com
*/

// Include Custom Post Types
include(plugin_dir_path( __FILE__ ).'includes/publisher-taxonomy.php');
include(plugin_dir_path( __FILE__ ).'includes/journal-metabox.php');


// Create ripm taxonomys
function ripm_taxonomy_init() {

    // create a new Language taxonomy
    // NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Languages', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Language', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Languages', 'textdomain' ),
		'popular_items'              => __( 'Popular Languages', 'textdomain' ),
		'all_items'                  => __( 'All Languages', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Language', 'textdomain' ),
		'update_item'                => __( 'Update Language', 'textdomain' ),
		'add_new_item'               => __( 'Add New Language', 'textdomain' ),
		'new_item_name'              => __( 'New Language Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate languages with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove languages', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used languages', 'textdomain' ),
		'not_found'                  => __( 'No languages found.', 'textdomain' ),
		'menu_name'                  => __( 'Languages', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'language' ),
	);

    register_taxonomy( 'language', 'ripm_journal', $args );

    // create a new People taxonomy
    // NOT hierarchical
	$labels = array(
		'name'                       => _x( 'People', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'People', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search People', 'textdomain' ),
		'popular_items'              => __( 'Popular People', 'textdomain' ),
		'all_items'                  => __( 'All People', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit People', 'textdomain' ),
		'update_item'                => __( 'Update People', 'textdomain' ),
		'add_new_item'               => __( 'Add New People', 'textdomain' ),
		'new_item_name'              => __( 'New People Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate people with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove people', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used people', 'textdomain' ),
		'not_found'                  => __( 'No people found.', 'textdomain' ),
		'menu_name'                  => __( 'People', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'people' ),
	);

    register_taxonomy( 'people', 'ripm_journal', $args );

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
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'country' ),
	);

    register_taxonomy( 'country', 'ripm_journal', $args );

    // create a new City taxonomy
    // NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Cities', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'City', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Cities', 'textdomain' ),
		'popular_items'              => __( 'Popular Cities', 'textdomain' ),
		'all_items'                  => __( 'All Cities', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit City', 'textdomain' ),
		'update_item'                => __( 'Update City', 'textdomain' ),
		'add_new_item'               => __( 'Add New City', 'textdomain' ),
		'new_item_name'              => __( 'New City Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate cities with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove cities', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used cities', 'textdomain' ),
		'not_found'                  => __( 'No cities found.', 'textdomain' ),
		'menu_name'                  => __( 'Cities', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'city' ),
	);

    register_taxonomy( 'city', 'ripm_journal', $args );

    
    
	// Add new taxonomy, make it hierarchical (like categories)
	// $labels = array(
	// 	'name'              => _x( 'Publishers', 'taxonomy general name', 'textdomain' ),
	// 	'singular_name'     => _x( 'Publisher', 'taxonomy singular name', 'textdomain' ),
	// 	'search_items'      => __( 'Search Publishers', 'textdomain' ),
	// 	'all_items'         => __( 'All Publishers', 'textdomain' ),
	// 	'parent_item'       => __( 'Parent Publisher', 'textdomain' ),
	// 	'parent_item_colon' => __( 'Parent Publisher:', 'textdomain' ),
	// 	'edit_item'         => __( 'Edit Publisher', 'textdomain' ),
	// 	'update_item'       => __( 'Update Publisher', 'textdomain' ),
	// 	'add_new_item'      => __( 'Add New Publisher', 'textdomain' ),
	// 	'new_item_name'     => __( 'New Publisher Name', 'textdomain' ),
	// 	'menu_name'         => __( 'Publisher', 'textdomain' ),
	// );

	// $args = array(
	// 	'hierarchical'      => true,
	// 	'labels'            => $labels,
	// 	'show_ui'           => true,
	// 	'show_admin_column' => true,
	// 	'query_var'         => true,
	// 	'rewrite'           => array( 'slug' => 'Publisher' ),
	// );

	// register_taxonomy( 'Publisher', array( 'journal' ), $args );
}
add_action( 'init', 'ripm_taxonomy_init' );




/**
 * Register a journal post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
add_action( 'init', 'ripm_journal_init' );
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
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' ),
        'register_meta_box_cb' => 'ripm_journal_meta_box_add',

        //"taxonomies" => array( 'category', 'post_tag', 'publisher' ),
	);

	register_post_type( 'ripm_journal', $args );
}

function ripm_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    ripm_journal_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ripm_rewrite_flush' );
add_action( 'after_switch_theme', 'ripm_rewrite_flush' );




/* Stop Adding Functions Below this Line */
?>