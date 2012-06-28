<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _s
 * @since _s 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="header-main site-header row" role="banner">
		<hgroup class="span6">
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="DualSpiral Photography">
				<span class="assistive-text">	<?php bloginfo( 'name' ); ?></span>
			</a></h1>
			<h2 class="site-description assistive-text"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav role="navigation" class="site-navigation main-navigation span6">
			<h1 class="assistive-text"><?php _e( 'Menu', '_s' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', '_s' ); ?>"><?php _e( 'Skip to content', '_s' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>
	</header><!-- #masthead .site-header -->

	<?php if(is_front_page()): ?>
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
	<?php endif; ?>
	<div id="main" class="row">
