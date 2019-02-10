<?php
/*
Publisher Taxonomy
*/

// Create ripm taxonomys
function ripm_publisher_taxonomy_init() {

    // create a new Publisher taxonomy
    // NOT hierarchical
	$labels = array(
		'name'                       => _x( 'Publishers', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Publisher', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Publishers', 'textdomain' ),
		'popular_items'              => __( 'Popular Publishers', 'textdomain' ),
		'all_items'                  => __( 'All Publishers', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Publisher', 'textdomain' ),
		'update_item'                => __( 'Update Publisher', 'textdomain' ),
		'add_new_item'               => __( 'Add New Publisher', 'textdomain' ),
		'new_item_name'              => __( 'New Publisher Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate publishers with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove publishers', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used publishers', 'textdomain' ),
		'not_found'                  => __( 'No publishers found.', 'textdomain' ),
		'menu_name'                  => __( 'Publishers', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'publisher' ),
	);

    register_taxonomy( 'publisher', 'ripm_journal', $args );
}
add_action( 'init', 'ripm_publisher_taxonomy_init' );


add_action( 'publisher_edit_form_fields', 'edit_sortable_name_field', 10, 2 );

function edit_sortable_name_field( $term, $taxonomy ){

    // get current group
    $sortable_name = get_term_meta( $term->term_id, 'sortable-name', true );

    ?>
	<div class="form-field form-required term-sortable-name-wrap">
	    <label for="tag-sortable-name">Sortable Name</label>
	    <input name="tag-sortable-name" id="tag-sortable-name" type="text" value="" size="40" aria-required="true">
	    <p>The sortable name is how it be sorted on your site.</p>
    </div>
	<?php
}

add_action( 'edited_publisher', 'update_feature_meta', 10, 2 );

function update_feature_meta( $term_id, $tt_id ){

    if( isset( $_POST['sortable-name'] ) && ’ !== $_POST['sortable-name'] ){
        $sortable_name = sanitize_title( $_POST['sortable-name'] );
        update_term_meta( $term_id, 'sortable-name', $sortable_name );
    }
}

add_filter('manage_edit-publisher_columns', 'add_sortable_name_column' );

function add_sortable_name_column( $columns ){
    $columns['sortable_name'] = __( 'Sortable Name', 'ripm_journal_plugin' );
    return $columns;
}

add_filter('manage_publisher_custom_column', 'add_sortable_name_column_content', 10, 3 );

function add_sortable_name_column_content( $content, $column_name, $term_id ){
    global $sortable_names;

    if( $column_name !== 'sortable_name' ){
        return $content;
    }

    $term_id = absint( $term_id );
    $sortable_name = get_term_meta( $term_id, 'sortable-name', true );

    if( !empty( $sortable_name ) ){
        $content .= esc_attr( $sortable_names[ $sortable_name ] );
    }

	return $content;
	
	add_filter( 'manage_edit-publisher_sortable_columns', 'add_sortable_name_column_sortable' );

	function add_sortable_name_column_sortable( $sortable ){
		$sortable[ 'sortable_name' ] = 'sortable_name';
		return $sortable;
	}

	$args = array(
		'hide_empty' => false, // also retrieve terms which are not used yet
		'meta_query' => array(
			array(
			   'key'       => 'sortable-name',
			   'value'     => 'kitchen',
			   'compare'   => 'LIKE'
			)
		)
	);
	
	$terms = get_terms( 'publisher', $args );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul>';
		foreach ( $terms as $term ) {
			echo '<li>' . $term->name . ' (' . get_term_meta( $term->term_id, 'sortable-name', true ) . ')' . '</li>';
		}
		echo '</ul>';
	}
}


?>