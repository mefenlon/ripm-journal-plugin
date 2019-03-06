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

//Allow substitution of -- for comma in all taxonomies
//  replace '--' with ', ' in the output - allow tags with comma this way
if( !is_admin() ) { // make sure the filters are only called in the frontend

    //Filter when taxonomy is displayed as items
    if ( ! function_exists( 'ripm_jcpt_comma_taxonomies_filter' ) ) {

        add_filter('get_the_taxonomies', 'ripm_jcpt_comma_taxonomies_filter');
        add_filter('get_terms', 'ripm_jcpt_comma_taxonomies_filter');
        add_filter('get_the_terms', 'ripm_jcpt_comma_taxonomies_filter');

        function ripm_jcpt_comma_taxonomies_filter($tags_arr) {
            $tags_arr_new = array();
            foreach ($tags_arr as $tag_arr) {
                $tag_arr_new = $tag_arr;
                $tag_arr_new->name = ripm_jcpt_comma_replace($tag_arr->name);
                $tags_arr_new[] = $tag_arr_new;
            }
            return $tags_arr_new;
        }
    }

    //Filter when taxonomy is displayed as title
    if ( ! function_exists( 'ripm_jcpt_archive_title' ) ) {

        add_filter('get_the_archive_title', 'ripm_jcpt_archive_title');

        function ripm_jcpt_archive_title($title) {
            return ripm_jcpt_comma_replace($title);
        }
    }

    //Replace -- with a comma
    if ( ! function_exists( 'ripm_jcpt_comma_replace' ) ) {

        function ripm_jcpt_comma_replace($term) {
            return str_replace('--', ', ', $term);
        }
    }


}