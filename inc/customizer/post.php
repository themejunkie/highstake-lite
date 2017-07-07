<?php
/**
 * Post Customizer
 */

/**
 * Register the customizer.
 */
function highstake_post_customize_register( $wp_customize ) {

	// Register new section: Post
	$wp_customize->add_section( 'highstake_post' , array(
		'title'       => esc_html__( 'Post', 'highstake' ),
		'description' => esc_html__( 'These options is used for customizing the single post.', 'highstake' ),
		'panel'       => 'highstake_options',
		'priority'    => 5,
		'active_callback' => function() {
			return is_single();
		}
	) );

	// Register Post comment manager setting
	$wp_customize->add_setting( 'highstake_post_comment', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_post_comment', array(
		'label'             => esc_html__( 'Enable comment on post', 'highstake' ),
		'section'           => 'highstake_post',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register Author Box setting
	$wp_customize->add_setting( 'highstake_author_box', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_author_box', array(
		'label'             => esc_html__( 'Show author box', 'highstake' ),
		'section'           => 'highstake_post',
		'priority'          => 3,
		'type'              => 'checkbox'
	) );

	// Register Next & Prev post setting
	$wp_customize->add_setting( 'highstake_next_prev_post', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_next_prev_post', array(
		'label'             => esc_html__( 'Show next & prev post', 'highstake' ),
		'section'           => 'highstake_post',
		'priority'          => 5,
		'type'              => 'checkbox'
	) );

	// Register Post Share setting
	$wp_customize->add_setting( 'highstake_post_share', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_post_share', array(
		'label'             => esc_html__( 'Show share buttons', 'highstake' ),
		'section'           => 'highstake_post',
		'priority'          => 7,
		'type'              => 'checkbox'
	) );

	// Register Related Posts setting
	$wp_customize->add_setting( 'highstake_related_posts', array(
		'default'           => 1,
		'sanitize_callback' => 'highstake_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'highstake_related_posts', array(
		'label'             => esc_html__( 'Show related posts', 'highstake' ),
		'section'           => 'highstake_post',
		'priority'          => 9,
		'type'              => 'checkbox'
	) );

}
add_action( 'customize_register', 'highstake_post_customize_register' );
