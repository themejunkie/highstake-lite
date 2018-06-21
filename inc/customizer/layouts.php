<?php
/**
 * Layouts Customizer
 */

/**
 * Register the customizer.
 */
function highstake_layouts_customize_register( $wp_customize ) {

	// Register new section: Layouts
	$wp_customize->add_section( 'highstake_layouts' , array(
		'title'       => esc_html__( 'Layouts', 'highstake-lite' ),
		'panel'       => 'highstake_design',
		'priority'    => 5
	) );

	// Register blog layouts setting
	$wp_customize->add_setting( 'highstake_blog_layouts', array(
		'default'           => '2c-l',
		'sanitize_callback' => 'highstake_sanitize_blog_layouts',
	) );
	$wp_customize->add_control( 'highstake_blog_layouts', array(
		'label'             => esc_html__( 'Blog Layout', 'highstake-lite' ),
		'section'           => 'highstake_layouts',
		'priority'          => 1,
		'type'              => 'radio',
		'active_callback'   => 'is_home',
		'choices'           => array(
			'2c-l'   => esc_html__( 'Default right sidebar', 'highstake-lite' ),
			'2c-r'   => esc_html__( 'Default left sidebar', 'highstake-lite' ),
			'1c-n'   => esc_html__( 'Default no sidebar', 'highstake-lite' ),
			'2c-l-l' => esc_html__( 'List right sidebar', 'highstake-lite' ),
			'2c-r-l' => esc_html__( 'List left sidebar', 'highstake-lite' ),
			'1c-l'   => esc_html__( 'List no sidebar wide', 'highstake-lite' ),
			'1c-n-l' => esc_html__( 'List no sidebar narrow', 'highstake-lite' )
		),
	) );

}
add_action( 'customize_register', 'highstake_layouts_customize_register' );
