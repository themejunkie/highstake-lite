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
		'title'    => esc_html__( 'Footer', 'highstake' ),
		'panel'    => 'highstake_options',
		'priority' => 11
	) );

	// Register accent color setting
	$wp_customize->add_setting( 'highstake_footer_bg', array(
		'default'           => '#f5f5f5',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highstake_footer_bg', array(
		'label'             => esc_html__( 'Background Color', 'highstake' ),
		'section'           => 'highstake_footer',
		'priority'          => 1
	) ) );

	// Register footer widget column setting
	$wp_customize->add_setting( 'highstake_footer_widget_column', array(
		'default'           => '6',
		'sanitize_callback' => 'highstake_sanitize_footer_widget_column',
	) );
	$wp_customize->add_control( 'highstake_footer_widget_column', array(
		'label'             => esc_html__( 'Footer Widget Column', 'highstake' ),
		'section'           => 'highstake_footer',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'3' => esc_html__( '3 Columns', 'highstake' ),
			'4' => esc_html__( '4 Columns', 'highstake' ),
			'6' => esc_html__( '6 Columns', 'highstake' )
		)
	) );

	// Register Footer Credits setting
	$wp_customize->add_setting( 'highstake_footer_credits', array(
		'sanitize_callback' => 'highstake_sanitize_textarea',
		'default'           => '&copy; Copyright ' . date( 'Y' ) . ' <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> &middot; Designed and Developed by <a href="http://www.theme-junkie.com/">Theme Junkie</a>',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'highstake_footer_credits', array(
		'label'             => esc_html__( 'Footer Text', 'highstake' ),
		'section'           => 'highstake_footer',
		'priority'          => 5,
		'type'              => 'textarea'
	) );
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'highstake_footer_credits', array(
			'selector'         => '.copyright',
			'settings'         => array( 'highstake_footer_credits' ),
			'render_callback'  => function() {
				return highstake_sanitize_textarea( get_theme_mod( 'highstake_footer_credits' ) );
			}
		) );
	}

}
add_action( 'customize_register', 'highstake_footer_customize_register' );
