<?php
/**
 * Colors Customizer
 */

/**
 * Register the customizer.
 */
function highstake_colors_customize_register( $wp_customize ) {

	// Register accent color setting
	$wp_customize->add_setting( 'highstake_accent_color', array(
		'default'           => '#54e5b0',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highstake_accent_color', array(
		'label'             => esc_html__( 'Accent Color', 'highstake-lite' ),
		'section'           => 'colors',
		'priority'          => 1
	) ) );

}
add_action( 'customize_register', 'highstake_colors_customize_register' );
