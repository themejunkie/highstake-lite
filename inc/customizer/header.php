<?php
/**
 * Header & Menu Customizer
 */

/**
 * Register the customizer.
 */
function highstake_header_customize_register( $wp_customize ) {

	// Register new section: Header
	$wp_customize->add_section( 'highstake_header' , array(
		'title'       => esc_html__( 'Header', 'highstake' ),
		'panel'       => 'highstake_options',
		'priority'    => 3
	) );

	// Register Header Style setting
	$wp_customize->add_setting( 'highstake_header_style', array(
		'default'           => 'left',
		'sanitize_callback' => 'highstake_sanitize_header_style'
	) );
	$wp_customize->add_control( 'highstake_header_style', array(
		'label'             => esc_html__( 'Style', 'highstake' ),
		'section'           => 'highstake_header',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'left'   => esc_html__( 'Logo on the left', 'highstake' ),
			'center' => esc_html__( 'Logo on the center', 'highstake' ),
			'right'  => esc_html__( 'Logo on the right', 'highstake' ),
		)
	) );

	// Register Header Background Color setting
	$wp_customize->add_setting( 'highstake_header_bg', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highstake_header_bg', array(
		'label'             => esc_html__( 'Background', 'highstake' ),
		'section'           => 'highstake_header',
		'priority'          => 3
	) ) );

}
add_action( 'customize_register', 'highstake_header_customize_register' );
