<?php
/**
 * Template: Front Page
 */

get_header(); ?>

<div id="series-sidebar" class="span3">
<?php
get_sidebar('series');
?>
</div>

		<div id="primary" class="site-content span8 offset1">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php _s_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php _s_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>
