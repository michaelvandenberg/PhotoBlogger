<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PhotoBlogger
 */
$custom_url = get_theme_mod( 'photoblogger_custom_header_url', home_url( '/' ) );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'photoblogger' ); ?></a>

	<div id="hidden-header" class="hidden" style="display:none;">
		<nav id="mobile-navigation" class="main-navigation" role="navigation">
			<div class="menu-title"><h2><?php esc_html_e( 'Menu', 'photoblogger' ); ?></h2></div>
			<?php if ( has_nav_menu( 'primary' ) ) { get_template_part( 'template-parts/navigation-primary' ); } ?>

			<div id="mobile-search" class="search-container">
				<?php get_search_form(); ?>
			</div><!-- #mobile-search -->
		</nav><!-- #mobile-navigation -->
	</div><!-- #hidden-header -->

	<header id="masthead" class="site-header" role="banner">
		<div id="top-bar" class="bar flex">
			<div class="site-branding">
				<?php photoblogger_the_custom_logo(); ?>

				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav id="desktop-navigation" class="main-navigation" role="navigation">
					<?php get_template_part( 'template-parts/navigation-primary' ); ?>
				</nav><!-- #primary-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<div id="social-top" class="social-navigation">
					<?php get_template_part( 'template-parts/navigation-social' ); ?>
				</div><!-- #social-top -->
			<?php endif; ?>
		</div><!-- #top-bar -->
	</header><!-- #masthead -->

	<div class="menu-toggle-container">
		<button class="menu-toggle" aria-controls="mobile-navigation" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'photoblogger' ); ?></span>
			<span class="toggle-lines" aria-hidden="true"></span>
		</button>
	</div>

	<?php if ( is_front_page() && photoblogger_has_featured_posts( 1 ) ) : ?>
		<?php get_template_part( 'template-parts/header-featured' ); ?>
	<?php endif; ?>

	<?php if ( is_singular() && has_post_thumbnail() && ( ! is_front_page() || ! photoblogger_has_featured_posts( 1 ) ) ) : ?>
		<?php get_template_part( 'template-parts/header-single' ); ?>
	<?php endif; ?>

	<?php if ( is_front_page() && get_header_image() ) : ?>
		<div id="custom-header" class="custom-header-container">
			<div class="custom-header-inner main-width">
				<a href="<?php echo esc_url( $custom_url ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			</div><!-- .custom-header-inner -->
		</div><!-- #custom-header -->
	<?php endif; // End header image check. ?>

	<div id="content" class="site-content">
