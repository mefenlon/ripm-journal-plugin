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
    if (!function_exists('ripm_jcpt_comma_taxonomies_filter')) {

        add_filter('get_the_taxonomies', 'ripm_jcpt_comma_taxonomies_filter');
        add_filter('get_terms', 'ripm_jcpt_comma_taxonomies_filter');
        add_filter('get_the_terms', 'ripm_jcpt_comma_taxonomies_filter');

        function ripm_jcpt_comma_taxonomies_filter($tags_arr)
        {
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
    if (!function_exists('ripm_jcpt_archive_title')) {

        add_filter('get_the_archive_title', 'ripm_jcpt_archive_title');
        add_filter('single_tag_title', 'ripm_jcpt_archive_title');
        add_filter('single_term_title', 'ripm_jcpt_archive_title');
        
        function ripm_jcpt_archive_title($title)
        {
            return ripm_jcpt_comma_replace($title);
        }
    }



    //Replace -- with a comma
    if (!function_exists('ripm_jcpt_comma_replace')) {

        function ripm_jcpt_comma_replace($term)
        {
            return str_replace('--', ', ', $term);
        }
    }


//Adds additional information behind journal titles when listed in archive pages
    if (!function_exists('ripm_jcpt_journal_title_filter')) {

        add_filter('the_title', 'ripm_jcpt_journal_title_filter', 10, 2);
        function ripm_jcpt_journal_title_filter($title, $id)
        {

            global $post;
            if (in_the_loop()) {
                $extras = get_title_extras($post);

                //if (is_post_type_archive()) {
                    if (!empty($extras)) {
                        $insides = trim(implode(', ', $extras));
                        if (!empty($insides))
                            $title .= ' (' . $insides . ') ';
                    }
                //}
            }
            return $title;
        }
    }

    function get_title_extras($post){
        $custom_content = get_post_custom($post->ID);

        if (count($custom_content)) {
            $location_and_dates = trim(implode(', ', $custom_content["ripm_journal_meta_box_display_locations_and_dates"]));

            if (!empty($location_and_dates)) {
                $extras[] = $location_and_dates;
            } else {
                $extras[] = get_the_term_list($post->ID, 'city', ' ', ', ');
                if (!empty($custom_content["ripm_journal_meta_box_display_date"])) {
                    $extras[] = implode(', ', $custom_content["ripm_journal_meta_box_display_date"]);
                }
            }
        }
        return $extras;

    }
}//end if( !is_admin()

//Adds custom post types to archive pages for tag and category
if ( ! function_exists( 'ripm_jcpt_add_custom_types_to_tax' ) ) {

    add_filter('pre_get_posts', 'ripm_jcpt_add_custom_types_to_tax');
    function ripm_jcpt_add_custom_types_to_tax($query)
    {
        if (is_category() || is_tag() && empty($query->query_vars['suppress_filters'])) {
            $post_types = get_post_types();
            $query->set('post_type', $post_types);
            return $query;
        }
    }
}
