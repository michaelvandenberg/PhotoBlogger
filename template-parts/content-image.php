<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PhotoBlogger
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner main-width">
		
		<?php if ( ! is_single() && has_post_thumbnail() ) { ?>
			<header class="entry-header">
				<div class="entry-thumbnail">
					<?php photoblogger_post_thumbnail(); ?>
				</div><!-- .entry-thumbnail -->
			</header><!-- .entry-header -->
		<?php } ?>

		<?php if ( is_single() ) { ?>
			<div class="entry-content">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav" aria-hidden="true">&rarr;</span>', 'photoblogger' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photoblogger' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php } ?>

		<footer class="entry-footer">
			<?php photoblogger_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .article-inner -->
</article><!-- #post-## -->
