<?php
/**
 * PhotoBlogger Theme Customizer.
 *
 * @package PhotoBlogger
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function photoblogger_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Theme options panel */
	$wp_customize->add_panel( 'photoblogger_theme_options', array(
		'priority'       => 900,
		'title'          => esc_html__( 'Theme Options', 'photoblogger' ),
		'description'    => esc_html__( 'This theme supports a number of options which you can set using this panel.', 'photoblogger' ),
	) );

	/* Theme options slider section */
	$wp_customize->add_section( 'photoblogger_slider_options', array(
		'title'				=> esc_html__( 'Slider Options', 'photoblogger' ),
		'priority'			=> 10,
		'panel'				=> 'photoblogger_theme_options',
		'description'		=> esc_html__( 'Enable (default) or disable autoplay for the full screen slider.', 'photoblogger' ),
	) );

	/* Theme options footer section */
	$wp_customize->add_section( 'photoblogger_footer_options', array(
		'title'				=> esc_html__( 'Footer Options', 'photoblogger' ),
		'priority'			=> 20,
		'panel'				=> 'photoblogger_theme_options',
		'description'		=> esc_html__( 'Replace the default copyright text.', 'photoblogger' ),
	) );

	/* Theme options custom header section */
	$wp_customize->add_section( 'photoblogger_custom_header_options', array(
		'title'				=> esc_html__( 'Custom Header Image Options', 'photoblogger' ),
		'priority'			=> 30,
		'panel'				=> 'photoblogger_theme_options',
		'description'		=> esc_html__( 'You can add a custom url to the custom header image.', 'photoblogger' ),
	) );

	/* Slider autoplay. */
	$wp_customize->add_setting( 'photoblogger_slider_autoplay', array(
		'default'           => '8000',
		'sanitize_callback' => 'photoblogger_sanitize_slider_autoplay',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'photoblogger_slider_autoplay', array(
		'label'             => esc_html__( 'Autoplay: ', 'photoblogger' ),
		'section'           => 'photoblogger_slider_options',
		'priority'          => 10,
		'type'              => 'radio',
		'choices'           => array(
			'true'			=> esc_html__( 'Enabled', 'photoblogger' ),
			'8000'			=> esc_html__( 'Enabled (Slow)', 'photoblogger' ),
			'false'			=> esc_html__( 'Disabled', 'photoblogger' ),
		),
	) );

	/* Custom header URL. */
	$wp_customize->add_setting( 'photoblogger_custom_header_url', array(
		'sanitize_callback' => 'photoblogger_sanitize_custom_header_url',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'photoblogger_custom_header_url', array(
		'label'             => esc_html__( 'Custom URL: ', 'photoblogger' ),
		'type'				=> 'url',
		'section'			=> 'photoblogger_custom_header_options',
		'priority'			=> 10,
	) );

	/* Custom copyright text. */
	$wp_customize->add_setting( 'photoblogger_custom_copyright', array(
		'default'			=> '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'photoblogger_custom_copyright', array(
		'label'				=> esc_html__( 'Your custom copyright text: ', 'photoblogger' ),
		'section'			=> 'photoblogger_footer_options',
		'priority'			=> 1,
	) );

}
add_action( 'customize_register', 'photoblogger_customize_register' );

/**
 * Sanitize slider slideshow.
 *
 * @param string $input.
 * @return string (true|false).
 */
function photoblogger_sanitize_slider_autoplay( $input ) {
	if ( ! in_array( $input, array( 'true', 'false', '8000' ) ) ) {
		$input = '8000';
	}
	return $input;
}

/**
 * Sanitize custom header URL.
 *
 * @param string $input.
 * @return string.
 */
function photoblogger_sanitize_custom_header_url( $input ) {
	if ( empty( $input ) ) {
		$input = esc_url( home_url( '/' ) );
	}

	else {
		$input = esc_url( $input );
	}

	return $input;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function photoblogger_customize_preview_js() {
	wp_enqueue_script( 'photoblogger_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'photoblogger_customize_preview_js' );
