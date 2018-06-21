<?php
/**
 * Footer Customizer
 */

/**
 * Register the customizer.
 */
function highstake_footer_customize_register( $wp_customize ) {

	// Register new section: Footer
	$wp_customize->add_section( 'highstake_footer' , array(
		'title'    => esc_html__( 'Footer', 'highstake-lite' ),
		'panel'    => 'highstake_options',
		'priority' => 13
	) );

	// Register footer content setting
	$wp_customize->add_setting( 'highstake_footer_content', array(
		'default'           => 'logo',
		'sanitize_callback' => 'highstake_sanitize_footer_content',
	) );
	$wp_customize->add_control( 'highstake_footer_content', array(
		'label'             => esc_html__( 'Footer Content', 'highstake-lite' ),
		'description'       => esc_html__( 'It will appear at the bottom of social links.', 'highstake-lite' ),
		'section'           => 'highstake_footer',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'disable' => esc_html__( 'Disable', 'highstake-lite' ),
			'logo'    => esc_html__( 'Logo', 'highstake-lite' ),
			'custom'  => esc_html__( 'Custom content', 'highstake-lite' )
		)
	) );

	// Register footer logo setting
	$wp_customize->add_setting( 'highstake_footer_logo', array(
		'default'           => '',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'highstake_footer_logo', array(
		'label'             => esc_html__( 'Logo', 'highstake-lite' ),
		'section'           => 'highstake_footer',
		'priority'          => 3,
		'flex_width'        => true,
		'width'             => 347,
		'height'            => 118,
		'active_callback'   => 'highstake_is_footer_content_logo'
	) ) );

	// Register footer custom content setting
	$wp_customize->add_setting( 'highstake_footer_custom_content', array(
		'sanitize_callback' => 'highstake_sanitize_textarea',
		'default'           => ''
	) );
	$wp_customize->add_control( 'highstake_footer_custom_content', array(
		'label'             => esc_html__( 'Custom content', 'highstake-lite' ),
		'description'       => esc_html__( 'You can add any text of HTML here, you also can put ad code here!', 'highstake-lite' ),
		'section'           => 'highstake_footer',
		'priority'          => 5,
		'type'              => 'textarea',
		'active_callback'   => 'highstake_is_footer_custom_content'
	) );

}
add_action( 'customize_register', 'highstake_footer_customize_register' );

/**
 * Show control if footer content = logo
 */
function highstake_is_footer_content_logo() {

	$option = get_theme_mod( 'highstake_footer_content', 'logo' );

	if ( $option == 'logo' ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Show control if footer content = custom
 */
function highstake_is_footer_custom_content() {

	$option = get_theme_mod( 'highstake_footer_content', 'logo' );

	if ( $option == 'custom' ) {
		return true;
	} else {
		return false;
	}

}
