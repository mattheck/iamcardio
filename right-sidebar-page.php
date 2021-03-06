<?php
/**
 * Template Name: Right sidebar only
 * Description: A template with only the right sidebar
 *
 * @package Able
 * @since Able 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template(); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary .site-content -->

<?php get_sidebar(right); ?>
<?php get_footer(); ?>