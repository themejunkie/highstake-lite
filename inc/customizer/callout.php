<?php
/**
 * Callout Customizer
 */

/**
 * Register the customizer.
 */
function highstake_callout_customize_register( $wp_customize ) {

	// Register new section: Callout
	$wp_customize->add_section( 'highstake_callout' , array(
		'title'       => esc_html__( 'Callout', 'highstake' ),
		'description' => esc_html__( 'This area called Callout, it appears at the bottom of the Featured area.', 'highstake' ),
		'panel'       => 'highstake_options',
		'priority'    => 15,
		'active_callback' => function() {
			return is_home() || is_front_page();
		}
	) );

	// Register callout type setting
	$wp_customize->add_setting( 'highstake_callout_type', array(
		'default'           => 'posts',
		'sanitize_callback' => 'highstake_sanitize_callout_type',
	) );
	$wp_customize->add_control( 'highstake_callout_type', array(
		'label'             => esc_html__( 'Type', 'highstake' ),
		'section'           => 'highstake_callout',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'subscribe' => esc_html__( 'Subscribe Box', 'highstake' ),
			'posts'     => esc_html__( 'Posts List', 'highstake' )
		)
	) );

	// Register subscribe box info setting
	$wp_customize->add_setting( 'highstake_subscribe_info', array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new Highstake_Custom_Text( $wp_customize, 'highstake_subscribe_info', array(
		'label'             => esc_html__( 'Subscribe Box', 'highstake' ),
		'description'       => esc_html__( 'To display the form, please use the shortcode provided by Mailchimp for WordPress plugin.', 'highstake' ),
		'section'           => 'highstake_callout',
		'priority'          => 3,
		'active_callback'   => 'highstake_is_callout_subscribe'
	) ) );

		// Register subscribe box title setting
		$wp_customize->add_setting( 'highstake_subscribe_title', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_subscribe_title', array(
			'label'             => esc_html__( 'Title', 'highstake' ),
			'section'           => 'highstake_callout',
			'priority'          => 5,
			'type'              => 'text',
			'active_callback'   => 'highstake_is_callout_subscribe'
		) );

		// Register subscribe box title setting
		$wp_customize->add_setting( 'highstake_subscribe_subtitle', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_subscribe_subtitle', array(
			'label'             => esc_html__( 'Sub Title', 'highstake' ),
			'section'           => 'highstake_callout',
			'priority'          => 7,
			'type'              => 'text',
			'active_callback'   => 'highstake_is_callout_subscribe'
		) );

		// Register subscribe box shortcode setting
		$wp_customize->add_setting( 'highstake_subscribe_shortcode', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_subscribe_shortcode', array(
			'label'             => esc_html__( 'Form Shortcode', 'highstake' ),
			'section'           => 'highstake_callout',
			'priority'          => 9,
			'type'              => 'text',
			'active_callback'   => 'highstake_is_callout_subscribe'
		) );

	// Register callout posts info setting
	$wp_customize->add_setting( 'highstake_callout_posts_info', array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	) );
	$wp_customize->add_control( new Highstake_Custom_Text( $wp_customize, 'highstake_callout_posts_info', array(
		'label'             => esc_html__( 'Posts', 'highstake' ),
		'description'       => esc_html__( 'Display latest 4 posts from tag you choose.', 'highstake' ),
		'section'           => 'highstake_callout',
		'priority'          => 11,
		'active_callback'   => 'highstake_is_callout_posts'
	) ) );

		// Register callout posts title setting
		$wp_customize->add_setting( 'highstake_callout_posts_title', array(
			'default'           => esc_html__( 'Editor\'s Choice', 'highstake' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'highstake_callout_posts_title', array(
			'label'             => esc_html__( 'Title', 'highstake' ),
			'section'           => 'highstake_callout',
			'priority'          => 13,
			'type'              => 'text',
			'active_callback'   => 'highstake_is_callout_posts'
		) );

		// Register callout posts tag name setting
		$wp_customize->add_setting( 'highstake_callout_posts_tag', array(
			'default'           => 'editors choice',
			'sanitize_callback' => 'esc_attr',
		) );
		$wp_customize->add_control( 'highstake_callout_posts_tag', array(
			'label'             => esc_html__( 'Tag name', 'highstake' ),
			'section'           => 'highstake_callout',
			'priority'          => 15,
			'type'              => 'text',
			'active_callback'   => 'highstake_is_callout_posts'
		) );

}
add_action( 'customize_register', 'highstake_callout_customize_register' );

/**
 * Active callback option if callout is subscribe
 */
function highstake_is_callout_subscribe() {

	$option = get_theme_mod( 'highstake_callout_type', 'subscribe' );

	if ( $option == 'subscribe' ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Active callback option if callout is posts
 */
function highstake_is_callout_posts() {

	$option = get_theme_mod( 'highstake_callout_type', 'subscribe' );

	if ( $option == 'posts' ) {
		return true;
	} else {
		return false;
	}

}
