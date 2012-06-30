<div id="series-preview">
<?php
$series_query = new WP_Query(array('post_type'=>'kali_series', 'posts_per_page' => 4, 'orderby' => 'rand'));
?>
	<ul class="thumbnails">
			<?php while ( $series_query->have_posts() ) : $series_query->the_post(); ?>
		<li class="span3">

<?php $attachments = attachments_get_attachments(); ?>
<?php $featured_image = (object) $attachments[0]; ?>
			<a class="thumbnail" href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($featured_image->id, 'series-grid', FALSE, array('title'=>trim(strip_tags(get_the_title())))); ?></a>	

		</li>
			<?php endwhile; ?>
	</ul>
<?php wp_reset_postdata(); ?>
</div>
