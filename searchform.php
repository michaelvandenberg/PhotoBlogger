<?php
/**
 * The search form.
 *
 * Displays the search form. Delete this file if you want to use the default WordPress search form.
 *
 * @package PhotoBlogger
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'before form', 'photoblogger' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'photoblogger' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	</label>
	<button class="search-submit"><span class="screen-reader-text"><?php esc_attr_e('Search Submit', 'photoblogger'); ?></span><span class="genericon genericon-search" aria-hidden="true"></span></button>
</form>
