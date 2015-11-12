<?php
/**
 * @package Able
 * @since Able 1.0
 */

if (   ! is_active_sidebar( 'sidebar-1' ) /* Left Sidebar */
	return;
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>