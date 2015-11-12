<?php

//die('*');

/**

 * The Header for our theme.

 *

 * Displays all of the <head> section and everything up till <div id="main">

 *

 * @package Able

 * @since Able 1.0

 */

?><!DOCTYPE html>

<!--[if IE 8]>

<html id="ie8" <?php language_attributes(); ?>>

<![endif]-->

<!--[if !(IE 8)]><!-->

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php /*<meta name="viewport" content="width=device-width" /> */?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />



<!--[if lt IE 9]>

  <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>

<![endif]-->

<?php wp_head(); ?>

<link rel='stylesheet' id='queries-css'  href='<?php bloginfo('template_directory');?>/queries.css' type='text/css' media='all' />

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

  <div id="site-introduction">

    <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

  </div><!-- #site-title -->

  <div id="page-liner">

    <header id="masthead" class="site-header" role="banner">

      <?php if ( has_nav_menu( 'header' ) ) : ?>

        <nav role="navigation" class="header-navigation">

          <h1 class="assistive-text">

            <?php _e( 'Menu', 'able' ); ?>

          </h1>

          <?php wp_nav_menu( array( 'theme_location' => 'header' ) ); ?>

        </nav><!-- .site-navigation -->

      <?php endif; ?>

      <?php $header_image = get_header_image();

      if ( ! empty( $header_image ) ) { ?>

      <div id="headimg">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

          <img src="<?php header_image(); ?>" alt="" />

        </a>

      </div><!-- #headimg -->

      <?php } // if ( ! empty( $header_image ) ) ?>

      <?php ubermenu( 'main' , array( 'theme_location' => 'primary' ) ); ?>
      <!-- <nav role="navigation" class="site-navigation main-navigation">

        <h1 class="assistive-text"><?php _e( 'Menu', 'able' ); ?></h1>

        <div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'able' ); ?>"><?php _e( 'Skip to content', 'able' ); ?></a></div>

        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

      </nav> .main-navigation -->

    </header><!-- #masthead .site-header -->

    <div id="main">
