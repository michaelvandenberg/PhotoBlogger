<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package PhotoBlogger
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 * See: https://jetpack.me/support/featured-content/
 */
function photoblogger_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'		=> 'scroll',
		'container' => 'main',
		'render'    => 'photoblogger_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Featured Content.
	add_theme_support( 'featured-content', array(
		'filter'     => 'photoblogger_get_featured_posts',
		'max_posts'  => 5,
		'post_types' => array( 'post', 'page' ),
	) );

} // end function photoblogger_jetpack_setup
add_action( 'after_setup_theme', 'photoblogger_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function photoblogger_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
} // end function photoblogger_infinite_scroll_render

/**
 * Get the featured posts function.
 */
function photoblogger_get_featured_posts() {
	return apply_filters( 'photoblogger_get_featured_posts', array() );
} // end function photoblogger_get_featured_posts

/**
 * Check the number of featured posts.
 */
function photoblogger_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() )
		return false;

	$minimum = absint( $minimum );
	$featured_posts = apply_filters( 'photoblogger_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) )
		return false;

	if ( $minimum > count( $featured_posts ) )
		return false;

	return true;
} // end function photoblogger_has_featured_posts
