<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2017, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function highstake_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'highstake_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function highstake_body_classes( $classes ) {

	// Adds a class of multi-author to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'multi-author';
	}

	// Adds a class for the container style.
	$container = get_theme_mod( 'highstake_container_style', 'fullwidth' );
	if ( $container == 'fullwidth' ) {
		$classes[] = 'full-width-container';
	} elseif ( $container == 'boxed' ) {
		$classes[] = 'boxed-container';
	} else {
		$classes[] = 'framed-container';
	}

	return $classes;
}
add_filter( 'body_class', 'highstake_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function highstake_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	// Replace hentry class with entry.
	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'highstake_post_classes' );

/**
 * Remove 'hentry' from post_class()
 */
function highstake_remove_hentry( $class ) {
	$class = array_diff( $class, array( 'hentry' ) );
	return $class;
}
add_filter( 'post_class', 'highstake_remove_hentry' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function highstake_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'highstake_excerpt_more' );

/**
 * Filter the except length to 20 words.
 */
function highstake_custom_excerpt_length( $length ) {
	return 24;
}
add_filter( 'excerpt_length', 'highstake_custom_excerpt_length', 999 );

/**
 * Remove theme-layouts meta box on attachment and bbPress post type.
 *
 * @since 1.0.0
 */
function highstake_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );

	// bbPress
	remove_post_type_support( 'forum', 'theme-layouts' );
	remove_post_type_support( 'topic', 'theme-layouts' );
	remove_post_type_support( 'reply', 'theme-layouts' );
}
add_action( 'init', 'highstake_remove_theme_layout_metabox', 11 );

/**
 * Add post type 'post' support for the Simple Page Sidebars plugin.
 *
 * @since  1.0.0
 */
function highstake_page_sidebar_plugin() {
	if ( class_exists( 'Simple_Page_Sidebars' ) ) {
		add_post_type_support( 'post', 'simple-page-sidebars' );
	}
}
add_action( 'init', 'highstake_page_sidebar_plugin' );

/**
 * Register custom contact info fields.
 *
 * @since  1.0.0
 * @param  array $contactmethods
 * @return array
 */
function highstake_contact_info_fields( $contactmethods ) {
	$contactmethods['twitter']     = esc_html__( 'Twitter URL', 'highstake' );
	$contactmethods['facebook']    = esc_html__( 'Facebook URL', 'highstake' );
	$contactmethods['gplus']       = esc_html__( 'Google Plus URL', 'highstake' );
	$contactmethods['instagram']   = esc_html__( 'Instagram URL', 'highstake' );
	$contactmethods['pinterest']   = esc_html__( 'Pinterest URL', 'highstake' );
	$contactmethods['linkedin']    = esc_html__( 'Linkedin URL', 'highstake' );

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'highstake_contact_info_fields' );

/**
 * Extend archive title
 *
 * @since  1.0.0
 */
function highstake_extend_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search Results for: %s', 'highstake' ), '<span>' . get_search_query() . '</span>' );
	} elseif ( is_404() ) {
		$title = esc_html__( '404 Not Found!', 'highstake' );
	} else {
		$title = esc_html__( 'Latest News', 'highstake' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'highstake_extend_archive_title' );

/**
 * Customize tag cloud widget
 *
 * @since  1.0.0
 */
function highstake_customize_tag_cloud( $args ) {
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';
	$args['number']   = 20;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'highstake_customize_tag_cloud' );
// Uncomment this if support WooCommerce
// add_filter( 'woocommerce_product_tag_cloud_widget_args', 'highstake_customize_tag_cloud' );

/**
 * Modifies the theme layout on attachment pages.
 *
 * @since  1.0.0
 */
function highstake_mod_theme_layout( $layout ) {

	// Change the layout to Full Width on Attachment page.
	if ( is_attachment() && wp_attachment_is_image() ) {
		$post_layout = get_post_layout( get_queried_object_id() );
		if ( 'default' === $post_layout ) {
			$layout = '1c';
		}
	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'highstake_mod_theme_layout', 15 );
