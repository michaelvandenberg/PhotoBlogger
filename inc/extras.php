<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PhotoBlogger
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function photoblogger_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class if post thumbnail has been set.
	if ( has_post_thumbnail() && is_singular() ) {
		$classes[] = 'has-post-thumbnail';
	}

	// Adds a class if is frontpage and at least one featured post.
	if ( is_front_page() && photoblogger_has_featured_posts( 1 ) )  {
		$classes[] = 'has-slider-img';
	}

	// Adds a class if is frontpage and at least two featured posts.
	if ( is_front_page() && photoblogger_has_featured_posts( 2 ) )  {
		$classes[] = 'flickity-enabled';
	}

	// Adds a class if sidebar doesn't contain any widgets.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class when the full width page template is active.
	if ( is_page_template( 'template-parts/page-full-width.php' ) ) {
		$classes[] = 'full-width-page-template';
	}

	// Adds a class when social menu isn't active.
	if ( ! has_nav_menu( 'social' ) ) {
		$classes[] = 'no-social-menu';
	}

	return $classes;
}
add_filter( 'body_class', 'photoblogger_body_classes' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @see wp_add_inline_style()
 */
function photoblogger_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'photoblogger-navigation' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevThumb[0] ) . '); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'photoblogger-navigation' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextThumb[0] ) . '); }
		';
	}

	wp_add_inline_style( 'photoblogger-style', $css );
}
add_action( 'wp_enqueue_scripts', 'photoblogger_post_nav_background' );