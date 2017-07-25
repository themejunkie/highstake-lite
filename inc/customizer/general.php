<?php
/**
 * General Customizer
 */

/**
 * Register the customizer.
 */
function highstake_general_customize_register( $wp_customize ) {

	// Register new section: General
	$wp_customize->add_section( 'highstake_general' , array(
		'title'    => esc_html__( 'General', 'highstake' ),
		'panel'    => 'highstake_options',
		'priority' => 1
	) );

	// Register container setting
	$wp_customize->add_setting( 'highstake_container_style', array(
		'default'           => 'fullwidth',
		'sanitize_callback' => 'highstake_sanitize_container_style',
	) );
	$wp_customize->add_control( 'highstake_container_style', array(
		'label'             => esc_html__( 'Container', 'highstake' ),
		'section'           => 'highstake_general',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'fullwidth' => esc_html__( 'Full Width', 'highstake' ),
			'boxed'     => esc_html__( 'Boxed', 'highstake' ),
			'framed'    => esc_html__( 'Framed', 'highstake' )
		)
	) );

	// Register pagination setting
	$wp_customize->add_setting( 'highstake_posts_pagination', array(
		'default'           => 'number',
		'sanitize_callback' => 'highstake_sanitize_posts_pagination',
	) );
	$wp_customize->add_control( 'highstake_posts_pagination', array(
		'label'             => esc_html__( 'Pagination type', 'highstake' ),
		'section'           => 'highstake_general',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'number'      => esc_html__( 'Number', 'highstake' ),
			'traditional' => esc_html__( 'Older / Newer', 'highstake' )
		)
	) );

	// Register sticky sidebar setting
	$wp_customize->add_setting( 'highstake_sticky_sidebar', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_sticky_sidebar', array(
		'label'             => esc_html__( 'Enable sticky sidebar', 'highstake' ),
		'section'           => 'highstake_general',
		'priority'          => 5,
		'type'              => 'checkbox'
	) );

}
add_action( 'customize_register', 'highstake_general_customize_register' );
