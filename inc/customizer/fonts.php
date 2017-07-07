<?php
/**
 * Fonts Customizer
 */

/**
 * Register the customizer.
 */
function highstake_fonts_customize_register( $wp_customize ) {

	// Register new section: Fonts
	$wp_customize->add_section( 'highstake_fonts' , array(
		'title'       => esc_html__( 'Fonts', 'highstake' ),
		'description' => esc_html__( 'These options is used for customizing the fonts. The Google Fonts can be found here: https://fonts.google.com/.', 'highstake' ),
		'panel'       => 'highstake_design',
		'priority'    => 3
	) );

	// Register heading custom text.
	$wp_customize->add_setting( 'highstake_heading_font_title', array(
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new Highstake_Custom_Text( $wp_customize, 'highstake_heading_font_title', array(
		'label'             => esc_html__( 'Heading', 'highstake' ),
		'section'           => 'highstake_fonts',
		'priority'          => 2
	) ) );

	// Register heading font setting.
	$wp_customize->add_setting( 'highstake_heading_font', array(
		'default'           => 'Playfair+Display:400,700,900',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'highstake_heading_font', array(
		'description'       => esc_html__( 'Font name/style/sets', 'highstake' ),
		'section'           => 'highstake_fonts',
		'priority'          => 3,
		'type'              => 'text'
	) );

	// Register heading font family setting.
	$wp_customize->add_setting( 'highstake_heading_font_family', array(
		'default'           => '\'Playfair Display\', serif',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'highstake_heading_font_family', array(
		'description'       => esc_html__( 'Font family', 'highstake' ),
		'section'           => 'highstake_fonts',
		'priority'          => 4,
		'type'              => 'text'
	) );

	// Register body custom text.
	$wp_customize->add_setting( 'highstake_body_font_title', array(
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new Highstake_Custom_Text( $wp_customize, 'highstake_body_font_title', array(
		'label'             => esc_html__( 'Body', 'highstake' ),
		'section'           => 'highstake_fonts',
		'priority'          => 5
	) ) );

	// Register body font setting.
	$wp_customize->add_setting( 'highstake_body_font', array(
		'default'           => 'Montserrat:400,700',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'highstake_body_font', array(
		'description'       => esc_html__( 'Font name/style/sets', 'highstake' ),
		'section'           => 'highstake_fonts',
		'priority'          => 6,
		'type'              => 'text'
	) );

	// Register body font family setting.
	$wp_customize->add_setting( 'highstake_body_font_family', array(
		'default'           => '\'Montserrat\', sans-serif',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'highstake_body_font_family', array(
		'description'       => esc_html__( 'Font family', 'highstake' ),
		'section'           => 'highstake_fonts',
		'priority'          => 7,
		'type'              => 'text'
	) );

}
add_action( 'customize_register', 'highstake_fonts_customize_register' );
