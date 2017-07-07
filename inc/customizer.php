<?php
/**
 * Highstake Theme Customizer
 */

// Loads custom control
require trailingslashit( get_template_directory() ) . 'inc/customizer/controls/custom-text.php';

// Loads the customizer settings
require trailingslashit( get_template_directory() ) . 'inc/customizer/general.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/header.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/post.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/page.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/footer.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/fonts.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/colors.php';

/**
 * Custom customizer functions.
 */
function highstake_customize_functions( $wp_customize ) {

	// Register new panel: Design
	$wp_customize->add_panel( 'highstake_design', array(
		'title'       => esc_html__( 'Design', 'highstake' ),
		'description' => esc_html__( 'This panel is used for customizing the design of your site.', 'highstake' ),
		'priority'    => 125,
	) );

	// Register new panel: Theme Options
	$wp_customize->add_panel( 'highstake_options', array(
		'title'       => esc_html__( 'Theme Options', 'highstake' ),
		'description' => esc_html__( 'This panel is used for customizing the Highstake theme.', 'highstake' ),
		'priority'    => 130,
	) );

	// Live preview of Site Title
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	// Enable selective refresh to the Site Title
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'settings'         => array( 'blogname' ),
			'render_callback'  => function() {
				return get_bloginfo( 'name', 'display' );
			}
		) );
	}

	// Move the Colors section.
	$wp_customize->get_section( 'colors' )->panel    = 'highstake_design';
	$wp_customize->get_section( 'colors' )->priority = 1;

	// Move the Theme Layout
	$wp_customize->get_section( 'layout' )->panel    = 'highstake_design';
	$wp_customize->get_section( 'layout' )->title    = esc_html__( 'Layouts', 'highstake' );
	$wp_customize->get_section( 'layout' )->priority = 5;
	$wp_customize->get_control( 'theme-layout-control' )->label    = esc_html__( 'Post / Page Layout', 'highstake' );
	$wp_customize->get_control( 'theme-layout-control' )->priority = 1;
	$wp_customize->get_control( 'theme-layout-control' )->active_callback = function() {
		return is_page() || is_single();
	};

	// Move the Background Image section.
	$wp_customize->get_section( 'background_image' )->panel    = 'highstake_design';
	$wp_customize->get_section( 'background_image' )->priority = 7;

	// Move the Static Front Page section.
	$wp_customize->get_section( 'static_front_page' )->panel    = 'highstake_design';
	$wp_customize->get_section( 'static_front_page' )->priority = 9;

	// Move the Additional CSS section.
	$wp_customize->get_section( 'custom_css' )->panel    = 'highstake_design';
	$wp_customize->get_section( 'custom_css' )->priority = 11;

	// Move background color to background image section.
	$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background', 'highstake' );
	$wp_customize->get_control( 'background_color' )->section = 'background_image';


}
add_action( 'customize_register', 'highstake_customize_functions', 99 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function highstake_customize_preview_js() {
	wp_enqueue_script( 'highstake-customizer', get_template_directory_uri() . '/assets/js/customizer/customizer.js', array( 'customize-preview', 'jquery' ) );
}
add_action( 'customize_preview_init', 'highstake_customize_preview_js' );

/**
 * Display theme documentation on customizer page.
 */
function highstake_documentation_link() {

	// Enqueue the script
	wp_enqueue_script( 'highstake-doc', get_template_directory_uri() . '/assets/js/customizer/doc.js', array(), '1.0.0', true );

	// Localize the script
	wp_localize_script( 'highstake-doc', 'prefixL10n',
		array(
			'prefixURL'   => esc_url( 'http://docs.theme-junkie.com/highstake/' ),
			'prefixLabel' => esc_html__( 'Documentation', 'highstake' ),
		)
	);

}
add_action( 'customize_controls_enqueue_scripts', 'highstake_documentation_link' );

/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function highstake_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize the Footer Credits
 */
function highstake_sanitize_textarea( $text ) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$text = $text;
	} else {
		$text = wp_kses_post( $text );
	}
	return $text;
}

/**
 * Sanitize the container style value.
 */
function highstake_sanitize_container_style( $style ) {
	if ( ! in_array( $style, array( 'fullwidth', 'boxed', 'framed' ) ) ) {
		$style = 'fullwidth';
	}
	return $style;
}

/**
 * Sanitize the header style value.
 */
function highstake_sanitize_header_style( $style ) {
	if ( ! in_array( $style, array( 'left', 'center', 'right' ) ) ) {
		$style = 'left';
	}
	return $style;
}

/**
 * Sanitize the pagination type value.
 */
function highstake_sanitize_posts_pagination( $type ) {
	if ( ! in_array( $type, array( 'number', 'traditional' ) ) ) {
		$type = 'number';
	}
	return $type;
}

/**
 * Sanitize the footer widget columns value.
 */
function highstake_sanitize_footer_widget_column( $col ) {
	if ( ! in_array( $col, array( '3', '4', '6' ) ) ) {
		$col = '6';
	}
	return $col;
}
