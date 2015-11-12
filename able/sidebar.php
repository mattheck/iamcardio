<?php
/**
 * @package Able
 * @since Able 1.0
 */

if (   ! is_active_sidebar( 'sidebar-1' ) /* Left Sidebar */
	&& ! is_active_sidebar( 'sidebar-2' ) /* Right Sidebar */
)
	return;

$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'tag' => 'depace',
	'posts_per_page' => 3
	);

$articles = get_posts($args);
?>

<?php /*if($_SERVER['REMOTE_ADDR'] == '190.113.212.30') { */?>

	<div id="tertiary" class="widget-area" role="complementary">
		<aside id="text-7" class="widget widget_text">
			<div class="textwidget">
				<a href="http://iamcardio.com/depaces-corner/">
					<img src="http://iamcardio.com/wp-content/uploads/2014/11/another-corner4.png">
				</a>
				<?php if($articles) : ?>
					<?php foreach($articles as $post) : 
					setup_postdata($post); 
					$the_excerpt = substr(strip_tags(get_the_excerpt()),0,80).' ...';
					//var_dump($the_excerpt);
					?>
					<div class="depacer-article">
						<?php
						if ( has_post_thumbnail() ) :
								echo '<div class="depacer-img-thumb"><a href="'.get_permalink().'">';
								the_post_thumbnail('thumbnail');
								echo '</a></div>';
						endif;
						?>
						<a href="<?php the_permalink();?>" class="depacer-title"><?php the_title(); ?></a>
						<p><?php echo $the_excerpt;?></p>
					</div>
					<?php endforeach;?>
				<?php endif;?>
				
			</div>
		</aside>
	</div><!-- #secondary -->

<?php /*}*/ ?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #tertiary -->
<?php endif; ?>