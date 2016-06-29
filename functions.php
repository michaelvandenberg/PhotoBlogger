<?php
/**
 * PhotoBlogger functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PhotoBlogger
 */

if ( ! function_exists( 'photoblogger_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function photoblogger_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PhotoBlogger, use a find and replace
	 * to change 'photoblogger' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'photoblogger', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add theme support for custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo/
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 250,
		'flex-width' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 9999, false );
	add_image_size( 'photoblogger-featured-img', 1600, 940, true );
	add_image_size( 'photoblogger-navigation', 720, 160, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary Menu', 'photoblogger' ),
		'social'	=> esc_html__( 'Social Links', 'photoblogger' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'photoblogger_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css', photoblogger_fonts_url() ) );
}
endif; // photoblogger_setup
add_action( 'after_setup_theme', 'photoblogger_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photoblogger_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photoblogger_content_width', 720 );
}
add_action( 'after_setup_theme', 'photoblogger_content_width', 0 );

/**
 * Adjust content_width value for full width page template.
 *
 * @since PhotoBlogger 1.0.0
 */
function photoblogger_full_width_page_content_width() {
	if ( is_page_template( 'template-parts/page-full-width.php' ) ) {	
		$GLOBALS['content_width'] = apply_filters( 'photoblogger_full_width_page_content_width', 1060 );
	}
}
add_action( 'template_redirect', 'photoblogger_full_width_page_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function photoblogger_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'photoblogger' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner main-width">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'photoblogger_widgets_init' );

if ( ! function_exists( 'photoblogger_fonts_url' ) ) :
/**
 * Register Google fonts for Myth.
 *
 * @since PhotoBlogger 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function photoblogger_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Roboto, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'photoblogger' ) ) {
		$fonts[] = 'Roboto:400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Merriweather, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'photoblogger' ) ) {
		$fonts[] = 'Merriweather:400,700,400italic,700italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function photoblogger_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'photoblogger-fonts', photoblogger_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Load the theme main stylesheet.
	wp_enqueue_style( 'photoblogger-style', get_stylesheet_uri() );

	// Load the theme custom script file.
	wp_enqueue_script( 'photoblogger-script', get_template_directory_uri() . '/js/photoblogger.js', array( 'jquery' ), '20150115', true );

	// Load the skip-link-focus script file.
	wp_enqueue_script( 'photoblogger-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Only load the Flickity script file on the front page and if there is more than one featured post.
	if ( is_front_page() && photoblogger_has_featured_posts( 2 ) )  {
		wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array( 'jquery' ), '1.1.1', false );
	}

	// Load the javascript file for comments if applicable.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Pass data from the customizer to the theme script file on slider pages.
	wp_localize_script( 'photoblogger-script', 'photobloggerData', array(
		'photoblogger_autoplay'		=> get_theme_mod( 'photoblogger_slider_autoplay', '8000' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'photoblogger_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';
