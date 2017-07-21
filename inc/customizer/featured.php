<?php
/**
 * Featured Customizer
 */

/**
 * Register the customizer.
 */
function highstake_featured_customize_register( $wp_customize ) {

	// Register new section: Featured
	$wp_customize->add_section( 'highstake_featured' , array(
		'title'       => esc_html__( 'Featured', 'highstake' ),
		'description' => esc_html__( 'This area called Featured, it appears at the top of the home page.', 'highstake' ),
		'panel'       => 'highstake_options',
		'priority'    => 13,
		'active_callback' => function() {
			return is_home() || is_front_page();
		}
	) );

	// Register featured type setting
	$wp_customize->add_setting( 'highstake_featured_type', array(
		'default'           => 'default',
		'sanitize_callback' => 'highstake_sanitize_featured_type',
	) );
	$wp_customize->add_control( 'highstake_featured_type', array(
		'label'             => esc_html__( 'Type', 'highstake' ),
		'section'           => 'highstake_featured',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'disable' => esc_html__( 'Disable', 'highstake' ),
			'default' => esc_html__( 'Default', 'highstake' ),
			'slider'  => esc_html__( 'Slider', 'highstake' )
		)
	) );

	// Register featured image setting
	$wp_customize->add_setting( 'highstake_featured_default_img', array(
		'default'           => '',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'highstake_featured_default_img', array(
		'label'             => esc_html__( 'Image', 'highstake' ),
		'section'           => 'highstake_featured',
		'priority'          => 3,
		'flex_width'        => true,
		'flex_height'       => true,
		'width'             => 1500,
		'height'            => 450,
		'active_callback'   => 'highstake_is_featured_default'
	) ) );

	// Register featured text setting
	$wp_customize->add_setting( 'highstake_featured_default_text', array(
		'default'           => '<small>Helping Small Business</small><h3>Grow</h3><p>It doesn\'t take a genius to start and build a successful business</p><a class="button button-primary" href="#">Start Here</a>',
		'sanitize_callback' => 'highstake_sanitize_textarea',
	) );
	$wp_customize->add_control( 'highstake_featured_default_text', array(
		'label'             => esc_html__( 'Text', 'silver' ),
		'section'           => 'highstake_featured',
		'priority'          => 5,
		'type'              => 'textarea',
		'active_callback'   => 'highstake_is_featured_default'
	) );

}
add_action( 'customize_register', 'highstake_featured_customize_register' );

/**
 * Active callback option
 */
function highstake_is_featured_default() {

	$option = get_theme_mod( 'highstake_featured_type', 'default' );

	if ( $option != 'default' ) {
		return false;
	} else {
		return true;
	}

}
