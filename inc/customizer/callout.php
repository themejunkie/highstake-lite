<?php
/**
 * Callout Customizer
 */

/**
 * Register the customizer.
 */
function highstake_lite_callout_customize_register( $wp_customize ) {

	// Register new section: Callout
	$wp_customize->add_section( 'highstake_lite_callout' , array(
		'title'       => esc_html__( 'Callout', 'highstake-lite' ),
		'description' => esc_html__( 'This area called Callout, it appears at the bottom of the Featured area.', 'highstake-lite' ),
		'panel'       => 'highstake_lite_options',
		'priority'    => 11,
		'active_callback' => function() {
			return is_home() || is_front_page();
		}
	) );

	// Register callout type setting
	$wp_customize->add_setting( 'highstake_lite_callout_type', array(
		'default'           => 'posts',
		'sanitize_callback' => 'highstake_lite_sanitize_callout_type',
	) );
	$wp_customize->add_control( 'highstake_lite_callout_type', array(
		'label'             => esc_html__( 'Type', 'highstake-lite' ),
		'section'           => 'highstake_lite_callout',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'subscribe' => esc_html__( 'Subscribe Box', 'highstake-lite' ),
			'posts'     => esc_html__( 'Posts List', 'highstake-lite' )
		)
	) );

	// Register subscribe box info setting
	$wp_customize->add_setting( 'highstake_lite_subscribe_info', array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new Highstake_Custom_Text( $wp_customize, 'highstake_lite_subscribe_info', array(
		'label'             => esc_html__( 'Subscribe Box', 'highstake-lite' ),
		'description'       => esc_html__( 'To display the form, please use the shortcode provided by Mailchimp for WordPress plugin.', 'highstake-lite' ),
		'section'           => 'highstake_lite_callout',
		'priority'          => 3,
		'active_callback'   => 'highstake_lite_is_callout_subscribe'
	) ) );

		// Register subscribe box title setting
		$wp_customize->add_setting( 'highstake_lite_subscribe_title', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_lite_subscribe_title', array(
			'label'             => esc_html__( 'Title', 'highstake-lite' ),
			'section'           => 'highstake_lite_callout',
			'priority'          => 5,
			'type'              => 'text',
			'active_callback'   => 'highstake_lite_is_callout_subscribe'
		) );

		// Register subscribe box title setting
		$wp_customize->add_setting( 'highstake_lite_subscribe_subtitle', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_lite_subscribe_subtitle', array(
			'label'             => esc_html__( 'Sub Title', 'highstake-lite' ),
			'section'           => 'highstake_lite_callout',
			'priority'          => 7,
			'type'              => 'text',
			'active_callback'   => 'highstake_lite_is_callout_subscribe'
		) );

		// Register subscribe box shortcode setting
		$wp_customize->add_setting( 'highstake_lite_subscribe_shortcode', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_lite_subscribe_shortcode', array(
			'label'             => esc_html__( 'Form Shortcode', 'highstake-lite' ),
			'section'           => 'highstake_lite_callout',
			'priority'          => 9,
			'type'              => 'text',
			'active_callback'   => 'highstake_lite_is_callout_subscribe'
		) );

	// Register callout posts info setting
	$wp_customize->add_setting( 'highstake_lite_callout_posts_info', array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new Highstake_Custom_Text( $wp_customize, 'highstake_lite_callout_posts_info', array(
		'label'             => esc_html__( 'Posts', 'highstake-lite' ),
		'description'       => esc_html__( 'Display latest 4 posts from tag you choose.', 'highstake-lite' ),
		'section'           => 'highstake_lite_callout',
		'priority'          => 11,
		'active_callback'   => 'highstake_lite_is_callout_posts'
	) ) );

		// Register callout posts title setting
		$wp_customize->add_setting( 'highstake_lite_callout_posts_title', array(
			'default'           => esc_html__( 'Editor\'s Choice', 'highstake-lite' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_lite_callout_posts_title', array(
			'label'             => esc_html__( 'Title', 'highstake-lite' ),
			'section'           => 'highstake_lite_callout',
			'priority'          => 13,
			'type'              => 'text',
			'active_callback'   => 'highstake_lite_is_callout_posts'
		) );

		// Register callout posts tag name setting
		$wp_customize->add_setting( 'highstake_lite_callout_posts_tag', array(
			'default'           => 'editors choice',
			'sanitize_callback' => 'esc_attr',
		) );
		$wp_customize->add_control( 'highstake_lite_callout_posts_tag', array(
			'label'             => esc_html__( 'Tag name', 'highstake-lite' ),
			'section'           => 'highstake_lite_callout',
			'priority'          => 15,
			'type'              => 'text',
			'active_callback'   => 'highstake_lite_is_callout_posts'
		) );

}
add_action( 'customize_register', 'highstake_lite_callout_customize_register' );

/**
 * Active callback option if callout is subscribe
 */
function highstake_lite_is_callout_subscribe() {

	$option = get_theme_mod( 'highstake_lite_callout_type', 'subscribe' );

	if ( $option == 'subscribe' ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Active callback option if callout is posts
 */
function highstake_lite_is_callout_posts() {

	$option = get_theme_mod( 'highstake_lite_callout_type', 'subscribe' );

	if ( $option == 'posts' ) {
		return true;
	} else {
		return false;
	}

}
