<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package Minileven
 */
?>
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="tertiary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #secondary .widget-area -->
	<?php endif; ?>
