<?php
/**
 * Infinite Scroll Support
 * See: http://jetpack.me/support/infinite-scroll/
 *
 * Theme Name: Able
 */

/**
 * Add theme support for Infinite Scroll.
 */
function able_jetpack_init() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page-liner',
	) );
}
add_action( 'after_setup_theme', 'able_jetpack_init' );

/**
 * Check whether or not footer widgets are present. If they are present, then a button to
 * 'Load more posts' will be displayed and IS will not be triggered unless a user manually clicks on that button.
 *
 * @param bool $has_widgets
 * @uses Jetpack_User_Agent_Info::is_ipad, jetpack_is_mobile, is_active_sidebar
 * @filter infinite_scroll_has_footer_widgets
 * @return bool
 */
function able_has_footer_widgets( $has_widgets ) {
	if ( ( ( class_exists( 'Jetpack_User_Agent_Info' ) && method_exists( 'Jetpack_User_Agent_Info', 'is_ipad' ) && Jetpack_User_Agent_Info::is_ipad() ) || ( function_exists( 'jetpack_is_mobile' ) && jetpack_is_mobile() ) ) && ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) )
		$has_widgets = true;

	return $has_widgets;
}
add_filter( 'infinite_scroll_has_footer_widgets', 'able_has_footer_widgets' );