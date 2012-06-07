<?php
/**
 * @package _s
 * @since _s 1.0
 */
$attachments = attachments_get_attachments();
foreach ($attachments as &$attachment)
	$attachment = (object) $attachment;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<div class="series-head row">
			<div class="series-description span4">
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>

				</header><!-- .entry-header -->
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', '_s' ), 'after' => '</div>' ) ); ?>
			</div>
			<div class="series-featured-image-container span8">
				<?php 
				$featured_image = $attachments[0]; 
				$featured_image_attributes = wp_get_attachment_image_src($featured_image->id, 'large');
				?>
				<a rel="lightbox" class="thumbnail" href="<?php echo $featured_image_attributes[0]; ?>"><?php echo wp_get_attachment_image($featured_image->id, 'series-featured'); ?></a>	
			</div>
		</div>
		<div class="photo-grid-container">
			<ul class="photo-grid-list thumbnails">
			<?php 
			for ($i = 1; $i < count($attachments); $i++) {
				$image_attributes = wp_get_attachment_image_src($attachments[$i]->id, 'large');
				echo '<li class="span3"><a rel="lightbox" class="thumbnail" href="'.$image_attributes[0].'">' . wp_get_attachment_image($attachments[$i]->id, 'series-grid') . '</a></li>';
			}
			?>	
			</ul>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', '_s' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! _s_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_s' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_s' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_s' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', '_s' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
