<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PhotoBlogger
 */

if ( ! function_exists( 'photoblogger_time_string' ) ) :
/**
 * Returns HTML with meta information for the current post-date/time.
 */
function photoblogger_time_string() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	return $time_string;
}
endif;

if ( ! function_exists( 'photoblogger_posted_date' ) ) :
/**
 * Returns HTML with meta information for the current post-date/time.
 */
function photoblogger_posted_date() {
	$time_string = photoblogger_time_string();

	$posted_date = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	return $posted_date;
}
endif;

if ( ! function_exists( 'photoblogger_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function photoblogger_posted_on() {
	$posted_on = photoblogger_posted_date();

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'photoblogger' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'photoblogger_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function photoblogger_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		echo '<span class="entry-footer-left">';

		if ( ! is_single() && ! is_search() && ( has_post_format( 'quote' ) || has_post_format( 'link' ) || has_post_format( 'aside' ) || has_post_format( 'image' ) ) ) {

			$posted_on = photoblogger_posted_date();

			echo '<span class="posted-on">' . $posted_on . '</span>';

		}

		else {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'photoblogger' ) );
			if ( $categories_list && photoblogger_categorized_blog() ) {
				echo '<span class="cat-links">' . $categories_list . '</span>';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'photoblogger' ) );
			if ( $tags_list ) {
				echo '<span class="tags-links">' . $tags_list . '</span>';
			}

		}

		echo '</span>';

	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="entry-footer-right"><span class="comments-link">';
		comments_popup_link( esc_html__( 'No Comments', 'photoblogger' ), esc_html__( '1 Comment', 'photoblogger' ), esc_html__( '% Comments', 'photoblogger' ) );
		echo '</span></span>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function photoblogger_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'photoblogger_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'photoblogger_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so photoblogger_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so photoblogger_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in photoblogger_categorized_blog.
 */
function photoblogger_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'photoblogger_categories' );
}
add_action( 'edit_category', 'photoblogger_category_transient_flusher' );
add_action( 'save_post',     'photoblogger_category_transient_flusher' );

if ( ! function_exists( 'photoblogger_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * @since photoblogger 1.0
 */
function photoblogger_post_thumbnail() {
	if ( ! has_post_thumbnail() || post_password_required() || is_singular()  ) {
		return;
	} ?>

	<div class="entry-thumbnail">
		<a class="entry-thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
			?>
			<span class="thumbnail-overlay overlay">
				<?php if ( ! is_single() && has_post_format( 'image' ) ) { the_title( '<h2 class="entry-title">', '</h2>' ); } ?>
			</span>
		</a>
	</div><!-- .entry-thumbnail -->

	<?php
}
endif; // photoblogger_post_thumbnail

if ( ! function_exists( 'photoblogger_fullscreen_image' ) ) :
/**
 * Display a fullscreen post thumbnail.
 *
 * @since photoblogger 1.0.0
 */
function photoblogger_fullscreen_image() {
	if ( ! has_post_thumbnail() ) {
		return;
	}

	$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'photoblogger-featured-img' );

	echo 'style="background-image: url(' . esc_url( $thumb_url[0] ) . ');"';
}
endif; // photoblogger_fullscreen_image

if ( ! function_exists( 'photoblogger_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since photoblogger 1.0.2
 */
function photoblogger_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;