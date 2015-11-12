<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Able
 * @since Able 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>.entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
 		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'able' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'able' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
