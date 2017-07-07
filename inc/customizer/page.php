<?php
/**
 * Page Customizer
 */

/**
 * Register the customizer.
 */
function highstake_page_customize_register( $wp_customize ) {

	// Register new section: Page
	$wp_customize->add_section( 'highstake_page' , array(
		'title'    => esc_html__( 'Page', 'highstake' ),
		'panel'    => 'highstake_options',
		'priority' => 7,
		'active_callback' => function() {
			return is_page();
		}
	) );

	// Register Page comment manager setting
	$wp_customize->add_setting( 'highstake_page_comment', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_page_comment', array(
		'label'             => esc_html__( 'Enable comment on Pages', 'highstake' ),
		'section'           => 'highstake_page',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register Page title setting
	$wp_customize->add_setting( 'highstake_page_title', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_page_title', array(
		'label'             => esc_html__( 'Show page title', 'highstake' ),
		'section'           => 'highstake_page',
		'priority'          => 3,
		'type'              => 'checkbox'
	) );

	// Register Page highstake image setting
	$wp_customize->add_setting( 'highstake_page_highstake_image', array(
		'default'           => 0,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_page_highstake_image', array(
		'label'             => esc_html__( 'Show page highstake image', 'highstake' ),
		'section'           => 'highstake_page',
		'priority'          => 5,
		'type'              => 'checkbox'
	) );

}
add_action( 'customize_register', 'highstake_page_customize_register' );
