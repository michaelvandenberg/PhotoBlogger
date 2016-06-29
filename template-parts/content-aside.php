<?php
/**
 * Template part for displaying posts with the Aside post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PhotoBlogger
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner main-width">

		<div class="special-content">
			<?php	
				// Fetch post content
				$content = get_post_field( 'post_content', get_the_ID() );

				// Apply filters
				$content = apply_filters('the_content', $content);

				// Get content parts
				$content_parts = get_extended( $content );
				
				// Output part before <!--more--> tag
				echo $content_parts['main'];
			?>
		</div><!-- .special-content -->

		<?php if ( is_single() ) : ?>

			<header class="entry-header">
				<div class="title-and-meta">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php photoblogger_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
				</div><!-- .title-and-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					// Output part after <!--more--> tag
					echo $content_parts['extended'];
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photoblogger' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

		<?php endif; ?>

		<footer class="entry-footer">
			<?php photoblogger_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		
	</div><!-- .article-inner -->
</article><!-- #post-## -->
