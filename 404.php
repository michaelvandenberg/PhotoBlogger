<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PhotoBlogger
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="page-header-inner main-width">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photoblogger' ); ?></h1>
					</div><!-- .page-header-inner -->
				</header><!-- .page-header -->

				<div class="page-content">
					<div class="page-content-inner main-width">

						<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'photoblogger' ); ?></p>
						
						<p><?php esc_html_e( 'Maybe you should check the menu or try a search in the box below?', 'photoblogger' ); ?></p>
						
						<?php get_search_form(); ?>

					</div><!-- .page-content-inner -->
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
