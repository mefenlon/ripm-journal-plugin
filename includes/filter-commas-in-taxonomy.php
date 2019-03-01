<?php
/* From https://www.saotn.org/display-commas-wordpress-tags/
 * Modified to allow -- substiturion in all taxonomies
 * WordPress filter for tags with commas
 * replace '--' with ', ' in the output - allow tags with comma this way
 * e.g. save tag as "Fox--Peter" but display like "Fox, Peter"
 * or "cafe--restaurant" for "cafe, restaurant"
 *
 * Follow me on Twitter: @HertogJanR
 */

// filter for tags (as a taxonomy) with comma
//  replace '--' with ', ' in the output - allow tags with comma this way
if( !is_admin() ) { // make sure the filters are only called in the frontend
    //Allow substitution of -- for comma in all taxonomies
    //$custom_taxonomy_type = 'location'; // here goes your taxonomy type

    function comma_taxonomy_filter( $tag_arr ){
        global $custom_taxonomy_type;
        $tag_arr_new = $tag_arr;
        //if( $tag_arr->taxonomy == $custom_taxonomy_type && strpos( $tag_arr->name, '--' ) ){
        if( strpos( $tag_arr->name, '--' ) ){

                $tag_arr_new->name = str_replace( '--' , ', ', $tag_arr->name);
        }
        return $tag_arr_new;
    }
    add_filter( 'get_custom_taxonomy', 'comma_taxonomy_filter' );

    function comma_taxonomies_filter( $tags_arr ) {
        $tags_arr_new = array();
        foreach( $tags_arr as $tag_arr ) {
            $tags_arr_new[] = comma_taxonomy_filter( $tag_arr );
        }
        return $tags_arr_new;
    }
    add_filter( 'get_the_taxonomies', 'comma_taxonomies_filter' );
    add_filter( 'get_terms', 'comma_taxonomies_filter' );
    add_filter( 'get_the_terms', 'comma_taxonomies_filter' );
}