<?php
/**
 * The featured posts section.
 *
 * Displays a single featured post or multiple featured posts with slider.
 *
 * @package PhotoBlogger
 */

$featured = photoblogger_get_featured_posts();
$autoplay = get_theme_mod( 'photoblogger_slider_autoplay', '8000' );

if ( photoblogger_has_featured_posts( 2 ) ) : ?>

	<div id="featured" class="featured-area slider">
		<?php
		foreach ( $featured as $post ) :
			setup_postdata( $post );

			if ( has_post_thumbnail() ) : ?>

				<div class="slider-cell fullscreen" aria-hidden="true" <?php photoblogger_fullscreen_image(); ?>>
					<div class="overlay fullscreen">
						<?php the_title( '<div class="featured-header"><h2 class="featured-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' ); ?>
						<a  class="featured-more" href="<?php the_permalink(); ?>" rel="bookmark"><?php esc_html_e( 'Read More', 'photoblogger' ); ?><?php the_title( '<span class="screen-reader-text">', '</span>' ); ?></a>
					</div>
				</div>

		<?php
			endif;
		endforeach;
		wp_reset_postdata();
		?>

		<button class="flickity-prev-next-button previous" type="button" aria-controls="featured-area">
			<span class="screen-reader-text"><?php esc_html_e( 'Previous slide', 'photoblogger' ); ?></span>
			<svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path></svg>
		</button>

		<button class="flickity-prev-next-button next" type="button" aria-controls="featured-area">
			<span class="screen-reader-text"><?php esc_html_e( 'Next slide', 'photoblogger' ); ?></span>
			<svg viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path></svg>
		</button>
	</div>

<?php else : ?>

	<div id="featured" class="featured-area">
		<?php
		foreach ( $featured as $post ) :
			setup_postdata( $post );

			if ( has_post_thumbnail() ) : ?>

				<div class="slider-cell fullscreen" aria-hidden="false" <?php photoblogger_fullscreen_image(); ?>>
					<div class="overlay fullscreen">
						<?php the_title( '<div class="featured-header"><h2 class="featured-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></div>' ); ?>
						<a  class="featured-more" href="<?php the_permalink(); ?>" rel="bookmark"><?php esc_html_e( 'Read More', 'photoblogger' ); ?><?php the_title( '<span class="screen-reader-text">', '</span>' ); ?></a>
					</div>
				</div>

		<?php
			endif;
		endforeach;
		wp_reset_postdata();
		?>
	</div>

<?php endif; ?>