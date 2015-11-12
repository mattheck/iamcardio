<?php
/**
 * Google Fonts Implementation
 *
 * @package Able
 * @since Able 1.0
 */

/**
 * Register Google Fonts
 */
function able_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'droid-serif', "$protocol://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" );
}
add_action( 'init', 'able_register_fonts' );

/**
 * Enqueue Google Fonts on Front End
 */
function able_fonts() {
	wp_enqueue_style( 'droid-serif' );
}
add_action( 'wp_enqueue_scripts',                               'able_fonts' );
add_action( 'admin_print_styles-appearance_page_custom-header', 'able_fonts' );
