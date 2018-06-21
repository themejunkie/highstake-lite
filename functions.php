<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2018, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function highstake_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'highstake_content_width', 760 );
}
add_action( 'after_setup_theme', 'highstake_content_width', 0 );

/**
 * Set new content width if user uses 1 column layout.
 */
if ( ! function_exists( 'highstake_secondary_content_width' ) ) :
	function highstake_secondary_content_width() {
		global $content_width;

		if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
			$content_width = 1160;
		}
	}
endif;
add_action( 'template_redirect', 'highstake_secondary_content_width' );

if ( ! function_exists( 'highstake_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function highstake_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'highstake-lite', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css', highstake_fonts_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare image sizes.
	add_image_size( 'highstake-featured-image', 2000, 950, true );
	add_image_size( 'highstake-post-featured-image', 760, 450, true );
	add_image_size( 'highstake-archive-featured-image', 520, 400, true );
	add_image_size( 'highstake-posts-in-grid', 720, 460, true );
	add_image_size( 'highstake-promo-box', 360, 250, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'  => esc_html__( 'Primary Location', 'highstake-lite' ),
			'social'   => esc_html__( 'Social Links' , 'highstake-lite' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'image', 'gallery', 'video'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'highstake_custom_background_args', array(
		'default-color' => 'f5f5f5'
	) ) );

	// Enable support for Custom Logo
	add_theme_support( 'custom-logo', array(
		'height'      => 31,
		'width'       => 117,
		'flex-width' => true,
	) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts',
		array(
			'1c'   => esc_html__( '1 Column Wide (Full Width)', 'highstake-lite' ),
			'1c-n' => esc_html__( '1 Column Narrow (Full Width)', 'highstake-lite' ),
			'2c-l' => esc_html__( '2 Columns: Content / Sidebar', 'highstake-lite' ),
			'2c-r' => esc_html__( '2 Columns: Sidebar / Content', 'highstake-lite' )
		),
		array( 'customize' => false, 'default' => '2c-l' )
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif; // highstake_theme_setup
add_action( 'after_setup_theme', 'highstake_theme_setup' );

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function highstake_widgets_init() {

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
	register_widget( 'Highstake_Recent_Widget' );

	// Register social widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-social.php';
	register_widget( 'Highstake_Social_Widget' );

}
add_action( 'widgets_init', 'highstake_widgets_init' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function highstake_sidebars_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'highstake-lite' ),
			'id'            => 'primary',
			'description'   => esc_html__( 'Main sidebar that appears on the right.', 'highstake-lite' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'highstake_sidebars_init' );

/**
 * Register Google fonts.
 *
 * @since  1.0.0
 * @return string
 */
function highstake_fonts_url() {

	// Get the customizer data
	$body_font      = get_theme_mod( 'highstake_body_font', 'Karla:400,400i,700,700i' );
	$heading_font   = get_theme_mod( 'highstake_heading_font', 'Montserrat:400,400i,600,600i' );

	// Important variable
	$fonts_url = '';
	$fonts     = array();

	if ( $body_font ) {
		$fonts[]   = esc_attr( str_replace( '+', ' ', $body_font ) );
	}

	if ( $heading_font && ( $body_font != $heading_font ) ) {
		$fonts[]   = esc_attr( str_replace( '+', ' ', $heading_font ) );
	}

	if ( $fonts ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Customizer.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * Page header.
 */
require trailingslashit( get_template_directory() ) . 'inc/header.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/extensions/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/extensions/hybrid-media-grabber.php';

/**
 * Demo importer.
 */
require trailingslashit( get_template_directory() ) . 'inc/demo/demo-importer.php';
