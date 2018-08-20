<?php
/**
 * Page Customizer
 */

/**
 * Register the customizer.
 */
function highstake_lite_page_customize_register( $wp_customize ) {

	// Register new section: Page
	$wp_customize->add_section( 'highstake_lite_page' , array(
		'title'    => esc_html__( 'Pages', 'highstake-lite' ),
		'panel'    => 'highstake_lite_options',
		'priority' => 7
	) );

	// Register Page comment manager setting
	$wp_customize->add_setting( 'highstake_lite_page_comment', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_lite_page_comment', array(
		'label'             => esc_html__( 'Enable comment on Pages', 'highstake-lite' ),
		'section'           => 'highstake_lite_page',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register Page title setting
	$wp_customize->add_setting( 'highstake_lite_page_title', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_lite_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_lite_page_title', array(
		'label'             => esc_html__( 'Show page title', 'highstake-lite' ),
		'section'           => 'highstake_lite_page',
		'priority'          => 3,
		'type'              => 'checkbox'
	) );

}
add_action( 'customize_register', 'highstake_lite_page_customize_register' );
