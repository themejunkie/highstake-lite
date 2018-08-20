<?php
/**
 * General Customizer
 */

/**
 * Register the customizer.
 */
function highstake_lite_general_customize_register( $wp_customize ) {

	// Register new section: General
	$wp_customize->add_section( 'highstake_lite_general' , array(
		'title'    => esc_html__( 'General', 'highstake-lite' ),
		'panel'    => 'highstake_lite_options',
		'priority' => 1
	) );

	// Register container setting
	$wp_customize->add_setting( 'highstake_lite_container_style', array(
		'default'           => 'fullwidth',
		'sanitize_callback' => 'highstake_lite_sanitize_container_style',
	) );
	$wp_customize->add_control( 'highstake_lite_container_style', array(
		'label'             => esc_html__( 'Container', 'highstake-lite' ),
		'section'           => 'highstake_lite_general',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'fullwidth' => esc_html__( 'Full Width', 'highstake-lite' ),
			'boxed'     => esc_html__( 'Boxed', 'highstake-lite' ),
			'framed'    => esc_html__( 'Framed', 'highstake-lite' )
		)
	) );

	// Register pagination setting
	$wp_customize->add_setting( 'highstake_lite_posts_pagination', array(
		'default'           => 'number',
		'sanitize_callback' => 'highstake_lite_sanitize_posts_pagination',
	) );
	$wp_customize->add_control( 'highstake_lite_posts_pagination', array(
		'label'             => esc_html__( 'Pagination type', 'highstake-lite' ),
		'section'           => 'highstake_lite_general',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'number'      => esc_html__( 'Number', 'highstake-lite' ),
			'traditional' => esc_html__( 'Older / Newer', 'highstake-lite' )
		)
	) );

}
add_action( 'customize_register', 'highstake_lite_general_customize_register' );
