<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Able
 * @since Able 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Able 1.0
 */
function able_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'able_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Able 1.0
 */
function able_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	/*
	 * Add widget-dependent classes to body
	 */
	if (   ! is_active_sidebar( 'sidebar-1' ) /* Left Sidebar */
		&& ! is_active_sidebar( 'sidebar-2' ) /* Right Sidebar */
	)
		$classes[] = 'one-column';

	if (     is_active_sidebar( 'sidebar-1' )
		&& ! is_active_sidebar( 'sidebar-2' )
	)
		$classes[] = 'left-sidebar';

	if (   ! is_active_sidebar( 'sidebar-1' )
		&&   is_active_sidebar( 'sidebar-2' )
	)
		$classes[] = 'right-sidebar';

	if (     is_active_sidebar( 'sidebar-1' )
		&&   is_active_sidebar( 'sidebar-2' )
	)
		$classes[] = 'three-columns';

	/*
	 * Add broswer-specific classes to body
	 */
	global $is_safari, $is_chrome, $is_gecko, $is_opera, $is_IE;

	if ( $is_safari )
		$classes[] = 'safari';

	if ( $is_chrome )
		$classes[] = 'chrome';

	if ( $is_gecko )
		$classes[] = 'gecko';

	if ( $is_opera )
		$classes[] = 'opera';

	if ( $is_IE )
		$classes[] = 'ie';

	return $classes;
}
add_filter( 'body_class', 'able_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Able 1.0
 */
function able_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'able_enhanced_image_navigation', 10, 2 );

/**
 * Modify the font sizes of WordPress' tag cloud
 */
function able_widget_tag_cloud_args( $args ) {
	$args['smallest'] = 13;
	$args['largest']  = 21;
	$args['unit']     = 'px';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'able_widget_tag_cloud_args' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since Able 1.0
 */
function able_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'able' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'able_wp_title', 10, 2 );
