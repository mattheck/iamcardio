<?php
/**
 * @package Able
 * @since Able 1.0
 */

if (   ! is_active_sidebar( 'sidebar-2' ) /* Right Sidebar */
)
	return;
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #tertiary -->
<?php endif; ?>