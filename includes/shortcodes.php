<?php
/**
 * Register Shortcodes.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


//Display Journal Title ( City, Dates )
if ( ! function_exists( 'ripm_jcpt_display_journal_combined_title' ) ) {

    add_shortcode('ripm_display_journal_combined_title', 'ripm_jcpt_display_journal_combined_title');

    function ripm_jcpt_display_journal_combined_title($atts, $content = null)
    {
        global $post;
        $atts = shortcode_atts( array(
            'container'         => 'div',
            'container_id'      => 'ripm_journal_title.'.$post->ID,
            'container_class'   => '',
            'link_id'           => 'ripm_journal_title_link.'.$post->ID,
            'link_class'       => '',
            'make_link' => true,

        ), $atts, 'ripm_display_journal_combined_title' );

        $display_title = '';
        $extras = array();
        $display_title = "<". $atts['container'] ." id='".$atts['container_id']. "' class='". $atts['container_class']. "'>";




        if($atts['make_link']){
            $display_title .= '<a href="' . esc_url(get_permalink($post->ID)) . '">' .
                get_the_title($post->ID)
                . '</a> ';
        } else
            $display_title .= get_the_title($post->ID) . ' ';

        $custom_content = get_post_custom($post->ID);
        if(count($custom_content)){
            if(!empty($custom_content["ripm_journal_meta_box_display_locations_and_dates"])) {
                $extras[] = implode(', ', $custom_content["ripm_journal_meta_box_display_locations_and_dates"]);
            }else{
                $extras[] = get_the_term_list($post->ID, 'city', ' ', ', ');
                if(!empty($custom_content["ripm_journal_meta_box_display_date"])) {
                    $extras[] = implode(', ', $custom_content["ripm_journal_meta_box_display_date"]);
                }
            }
        }

            if (!empty($extras)) {
                $insides = trim(implode(', ', $extras));
                if(!empty($insides))
                    $display_title .= ' (' .$insides  . ') ';
            }


        if(!empty($content))
            $display_title .= '<br/>' . $content;

        $display_title .= "</". $atts['container'] . ">";

        return $display_title;
    }
}


//Display the custom fields associated with a ripm journal
if ( ! function_exists( 'ripm_jcpt_display_journal_meta' ) ) {
    add_shortcode('ripm_display_journal_meta', 'ripm_jcpt_display_journal_meta');

    function ripm_jcpt_display_journal_meta($atts, $content = null ) {
        global $post;
        $atts = shortcode_atts( array(
            'container'       => 'ul',
            'container_id'    => 'ripm_journal.'.$post->ID,
            'container_class' => '',
            'item'       => 'li',
            'item_class' => ''
        ), $atts, 'ripm_display_journal_meta' );


        $content = '';
        $custom_content = get_post_custom($post->ID);
        if(count($custom_content)){

            $content .= "<". $atts['container'] ." id='".$atts['container_id']. "' class='". $atts['container_class']. "'>";
            $city =  get_the_term_list( $post->ID, 'city', ' ', ', ' );
            if (!empty($city )) {
                $content .= "<". $atts['item'] ." id='ripm_journal_taxonomy_city' class='". $atts['item_class']. "'>";
                $content .= "Place of Publication: ";
                $content .= $city;
                $content .= "</". $atts['item'] . ">";
            }
            if (isset($custom_content["ripm_journal_meta_box_display_date"])) {
                $content .= "<". $atts['item'] ." id='ripm_journal_meta_box_display_date' class='". $atts['item_class']. "'>";
                $content .= "Date of Publication: ";
                $content .= implode(', ', $custom_content["ripm_journal_meta_box_display_date"]);
                $content .= "</". $atts['item'] . ">";
            }
            if (isset($custom_content["ripm_journal_meta_box_periodicity"])) {
                $content .= "<". $atts['item'] ." id='ripm_journal_meta_box_periodicity' class='". $atts['item_class']. "'>";
                $content .= "Periodicity: ";
                $content .= implode(', ', $custom_content["ripm_journal_meta_box_periodicity"]);
                $content .= "</". $atts['item'] . ">";
            }
            $editor = get_the_term_list( $post->ID, 'editor' ,  ' ', ', ' );
            if (!empty($editor)) {
                $content .= "<". $atts['item'] ." id='ripm_journal_taxonomy_editor' class='". $atts['item_class']. "'>";
                $content .= "Editor: ";
                $content .= $editor;
                $content .= "</". $atts['item'] . ">";
            }
            $publisher = get_the_term_list( $post->ID, 'publisher' ,  ' ', ', ' );
            if (!empty($publisher)) {
                $content .= "<". $atts['item'] ." id='ripm_journal_taxonomy_publisher' class='". $atts['item_class']. "'>";
                $content .= "Place of Publication: ";
                $content .= $publisher;
                $content .= "</". $atts['item'] . ">";
            }
            $content .= "</". $atts['container'] . ">";
        }

        return $content;
    }
}

//Display a table of all journal custom post types
if ( ! function_exists( 'ripm_jcpt_display_journal_table' ) ) {
    add_shortcode('ripm_display_journal_table', 'ripm_jcpt_display_journal_table');

    function ripm_jcpt_display_journal_table($atts, $content = null)
    {
        $atts = array(
            'table_class' => 'tablesorter {sortlist: [[0,0],[1,0]]}',
        );
        $args = array(
            'post_type' => 'ripm_journal',
            'orderby' => array('meta_value_num' => 'DESC', 'title' => 'ASC'),
            'meta_key' => 'ripm_journal_meta_box_start_year',
            'nopaging' => true,
        );

        $post_query = new WP_Query($args);
        if ($post_query->have_posts()) {

            $table = <<< HTML
        <table class="{$atts['table_class']}">
            <thead>
            <tr>
                <th class="dateFormat-yyyy">Date</th>
                <th>Title</th>
                <th>Language</th>
            </tr>
            </thead>
            <tbody>

HTML;

            while ($post_query->have_posts()) {
                $post_query->the_post();
                $custom_content = get_post_custom($post_query->post->ID);
                if (isset($custom_content["ripm_journal_meta_box_display_date"])) {
                    $display_date = implode(', ', $custom_content["ripm_journal_meta_box_display_date"]);
                }
                if (isset($custom_content["ripm_journal_meta_box_start_year"])) {
                    $year = implode(', ', $custom_content["ripm_journal_meta_box_start_year"]);
                }
                $city = get_the_term_list($post_query->post->ID, 'city', ' ', ', ');
                $language = get_the_term_list($post_query->post->ID, 'language', ' ', ', ');

//                $display_title = '<a href="' . esc_url(get_permalink($post_query->post->ID)) . '">' .
//                    get_the_title($post_query->post->ID)
//                    . '</a> (' . $city . ', ' . $display_date . ')';
                $display_title = do_shortcode('[ripm_display_journal_combined_title]');

                $table .= <<< HTML
                <tr>
                    <td>{$year}</td>
                    <td>{$display_title}</td>
                    <td>{$language}</td>
                </tr>

HTML;
            }

            $table .= <<< HTML
            </tbody>
        </table>

HTML;
        }

        return $table;
    }
}


?>