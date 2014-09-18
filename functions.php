<?php
/**
 * Able functions and definitions
 *
 * @package Able
 * @since Able 1.0
 */

/**
 * Set up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1176; /* Default content width, no widgets active */

/**
 * Adjust the content width based on the presence of active widgets.
 *
 * @since Able 1.0
 */
function able_set_content_width() {
	global $content_width;

	if (   is_active_sidebar( 'sidebar-1' ) /* Left Sidebar */
		|| is_active_sidebar( 'sidebar-2' ) /* Right Sidebar */
	)
		$content_width = 869;

	if (   is_active_sidebar( 'sidebar-1' )
		&& is_active_sidebar( 'sidebar-2' )
	)
		$content_width = 562;
}
add_action( 'template_redirect', 'able_set_content_width' );

if ( ! function_exists( 'able_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Able 1.0
 */
function able_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Able, use a find and replace
	 * to change 'able' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'able', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Editor Style
	 */
	add_editor_style();

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'header'  => __( 'Header Menu', 'able' ),
		'primary' => __( 'Primary Menu', 'able' ),
		'footer'  => __( 'Footer Menu', 'able' ),
	) );

}
endif; // able_setup
add_action( 'after_setup_theme', 'able_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since Able 1.0.0
 */
function able_register_custom_background() {
	$args = array(
		'default-color' => 'fafafa',
	);

	$args = apply_filters( 'able_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'able_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Able 1.0
 */
function able_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'able' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'able' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'able_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since Able 1.0
 */
function able_scripts() {

	wp_enqueue_style( 'able-style', get_stylesheet_uri() );

	wp_enqueue_script( 'able-small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( get_the_ID() ) ) {
		wp_enqueue_script( 'able-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'able_scripts' );

/*
 * Hide the theme-provided background images if the user manually sets a custom background color
 *
 * @since Able 1.0
 */
function able_custom_background_check() {

	if ( '' != get_background_color() ) : ?>
		<style type="text/css">
			body {
				background-image: none;
			}
		</style>
	<?php endif;
}

add_action( 'wp_head', 'able_custom_background_check' );

/**
 * Implement the Custom Header feature.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Implement Custom Google Fonts.
 */
require( get_template_directory() . '/inc/fonts.php' );

/**
 * Custom template tags for this theme.
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require( get_template_directory() . '/inc/tweaks.php' );

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );
/*
* More custom
*/
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_length( $length ) {
    return (in_category( 'Nutrition' )) ? 55 : 65;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );
