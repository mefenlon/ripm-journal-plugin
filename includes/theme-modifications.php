<?php
/**
 * Register Shortcodes.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

//if ( ! function_exists( 'custom_remove_footer_credit' ) ) {
//
//    // Remove "Powered By" from Footer
//   // add_action('init', 'custom_remove_footer_credit', 10);
//    add_action( 'after_setup_theme', 'custom_remove_footer_credit' );
//
//    function custom_remove_footer_credit()
//    {
//
//    }
//
//}

//remove_action( 'generate_footer', 'generate_credits', 20);
//
//add_action( 'after_setup_theme','lh_remove_footer' );
//function lh_remove_footer() {
//    //if ( is_404() ) {
//        remove_action( 'generate_footer','generate_credits' );
//    //}
//}
//
//if ( ! function_exists( 'custom_footer_credit' ) ) {
//    add_action('generate_credits', 'custom_footer_credit', 20);
//
//    function custom_footer_credit()
//    {
//        $copyright = sprintf( '<span class="copyright">&copy; %1$s %2$s</span>',
//            date( 'Y' ),
//            get_bloginfo( 'name' )
//        );
//
//        echo apply_filters( 'generate_copyright', $copyright ); // WPCS: XSS ok.
//    }
//}


if ( ! function_exists( 'generate_add_footer_info' ) ) {
    add_action( 'generate_credits', 'generate_add_footer_info' );
    /**
     * Add the copyright to the footer
     *
     * @since 0.1
     */
    function generate_add_footer_info() {
        $copyright = sprintf( '<span class="copyright">&copy; %1$s %2$s</span>',
            date( 'Y' ),
            get_bloginfo( 'name' )
        );

        echo apply_filters( 'generate_copyright', $copyright ); // WPCS: XSS ok.
    }
}