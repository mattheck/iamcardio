<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package Able
 * @since Able 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses able_header_style()
 * @uses able_admin_header_style()
 * @uses able_admin_header_image()
 *
 * @package Able
 */
function able_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '323232',
		'width'                  => 1280,
		'height'                 => 360,
		'flex-height'            => true,
		'wp-head-callback'       => 'able_header_style',
		'admin-head-callback'    => 'able_admin_header_style',
		'admin-preview-callback' => 'able_admin_header_image',
	);

	$args = apply_filters( 'able_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'able_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Able
 * @since Able 1.0
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'able_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see able_custom_header_setup().
 *
 * @since Able 1.0
 */
function able_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect( 1px 1px 1px 1px ); /* IE6, IE7 */
			clip: rect( 1px, 1px, 1px, 1px ) ;
		}
		#masthead-liner {
			padding-top: 0;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // able_header_style

if ( ! function_exists( 'able_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see able_custom_header_setup().
 *
 * @since Able 1.0
 */
function able_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
			font-family: 'Droid Serif', Georgia, Cambria, 'Times New Roman', Times, serif;
		}
		#headimg h1 {
			font-size: 48px;
			font-weight: 700;
			line-height: 52px;
			margin: 0;
		}
		#headimg h1 a {
			text-decoration: none;
		}
		#desc {
			font-size: 16px;
			font-style: italic;
			font-weight: 300;
			line-height: 26px;
			margin-bottom: 26px;
		}
		#headimg img {
			display: block;
			margin: 0 0 26px;
			max-width: 100%;
		}
	</style>
<?php
}
endif; // able_admin_header_style

if ( ! function_exists( 'able_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see able_custom_header_setup().
 *
 * @since Able 1.0
 */
function able_admin_header_image() {
	$header_text_color = get_header_textcolor();
	$header_image      = get_header_image(); ?>
	<div id="headimg">
		<?php
		if ( 'blank' == $header_text_color || '' == $header_text_color )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . $header_text_color . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php 
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // able_admin_header_image