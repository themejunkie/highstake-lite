<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2018, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function highstake_lite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'highstake_lite_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function highstake_lite_body_classes( $classes ) {

	// Adds a class of multi-author to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'multi-author';
	}

	// Adds a class for the container style.
	$container = get_theme_mod( 'highstake_lite_container_style', 'fullwidth' );
	if ( $container == 'fullwidth' ) {
		$classes[] = 'full-width-container';
	} elseif ( $container == 'boxed' ) {
		$classes[] = 'boxed-container';
	} else {
		$classes[] = 'framed-container';
	}

	if ( is_single() || is_page() && has_post_thumbnail( get_the_ID() ) ) {
		$classes[] = 'has-featured-image';
	}

	if ( is_home() || is_front_page() ) {

		$featured_type = get_theme_mod( 'highstake_lite_featured_type', 'default' );
		if ( $featured_type == 'disable' ) {
			$classes[] = 'featured-disabled';
		}

	}

	// Layout on home page.
	if ( is_home() ) {
		$blog_layouts = get_theme_mod( 'highstake_lite_blog_layouts', '2c-l' );
		$classes[] = 'layout-' . $blog_layouts;

		$callout_type = get_theme_mod( 'highstake_lite_callout_type', 'subscribe' );
		$classes[] = 'callout-' . $callout_type;
	}

	return $classes;
}
add_filter( 'body_class', 'highstake_lite_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function highstake_lite_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	// Replace hentry class with entry.
	$classes[] = 'entry';

	return $classes;
}
add_filter( 'post_class', 'highstake_lite_post_classes' );

/**
 * Remove 'hentry' from post_class()
 */
function highstake_lite_remove_hentry( $class ) {
	$class = array_diff( $class, array( 'hentry' ) );
	return $class;
}
add_filter( 'post_class', 'highstake_lite_remove_hentry' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function highstake_lite_excerpt_more( $more ) {

	if ( is_admin() ) {
		return;
	}

	return '&hellip;';
}
add_filter( 'excerpt_more', 'highstake_lite_excerpt_more' );

/**
 * Filter the except length to 20 words.
 */
function highstake_lite_custom_excerpt_length( $length ) {

	if ( is_admin() ) {
		return;
	}

	// Set up empty variable.
	$length = 50;

	// Get the blog layouts.
	$blog_layouts = get_theme_mod( 'highstake_lite_blog_layouts', '2c-l' );
	if ( is_home() && $blog_layouts == '2c-l-l' || $blog_layouts == '2c-r-l' || $blog_layouts == '1c-l' || $blog_layouts == '1c-n-l' ) {
		$length = 25;
	}

	if ( is_archive() || is_search() ) {
		$length = 25;
	}

	return $length;
}
add_filter( 'excerpt_length', 'highstake_lite_custom_excerpt_length', 999 );

/**
 * Remove theme-layouts meta box on attachment and bbPress post type.
 *
 * @since 1.0.0
 */
function highstake_lite_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );

	// bbPress
	remove_post_type_support( 'forum', 'theme-layouts' );
	remove_post_type_support( 'topic', 'theme-layouts' );
	remove_post_type_support( 'reply', 'theme-layouts' );
}
add_action( 'init', 'highstake_lite_remove_theme_layout_metabox', 11 );

/**
 * Add post type 'post' support for the Simple Page Sidebars plugin.
 *
 * @since  1.0.0
 */
function highstake_lite_page_sidebar_plugin() {
	if ( class_exists( 'Simple_Page_Sidebars' ) ) {
		add_post_type_support( 'post', 'simple-page-sidebars' );
	}
}
add_action( 'init', 'highstake_lite_page_sidebar_plugin' );

/**
 * Extend archive title
 *
 * @since  1.0.0
 */
function highstake_lite_extend_archive_title( $title ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'posts in %s category', 'highstake-lite' ), '<span>' . single_cat_title( '', false ) . '</span>' );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'posts in %s tag', 'highstake-lite' ), '<span>' . single_tag_title( '', false ) . '</span>' );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'posts by %s', 'highstake-lite' ), '<span>' . get_the_author() . '</span>' );
	} elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search Results for: %s', 'highstake-lite' ), '<span>' . get_search_query() . '</span>' );
	} else {
		$title = esc_html__( 'Latest News', 'highstake-lite' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'highstake_lite_extend_archive_title' );

/**
 * Customize tag cloud widget
 *
 * @since  1.0.0
 */
function highstake_lite_customize_tag_cloud( $args ) {
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';
	$args['number']   = 20;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'highstake_lite_customize_tag_cloud' );

/**
 * Modifies the theme layout on attachment pages.
 *
 * @since  1.0.0
 */
function highstake_lite_mod_theme_layout( $layout ) {

	// Change the layout to Full Width on Attachment page.
	if ( is_attachment() && wp_attachment_is_image() ) {
		$post_layout = get_post_layout( get_queried_object_id() );
		if ( 'default' === $post_layout ) {
			$layout = '1c';
		}
	}

	// Layout on home page.
	if ( is_home() ) {
		$archive_layouts = get_theme_mod( 'highstake_lite_blog_layouts', '2c-l' );
		$layout = $archive_layouts;

		if ( $archive_layouts === '2c-l-l' ) {
			$layout = '2c-l';
		} elseif ( $archive_layouts === '2c-r-l' ) {
			$layout = '2c-r';
		} elseif ( $archive_layouts === '1c-l' ) {
			$layout = '1c';
		} elseif ( $archive_layouts === '1c-n-l' ) {
			$layout = '1c-n';
		}

	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'highstake_lite_mod_theme_layout', 15 );

/**
 * Limit search to post
 */
function highstake_lite_search_filter($query) {
	if ( !is_admin() && $query->is_main_query() ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', 'post' );
		}
	}
}
add_action( 'pre_get_posts', 'highstake_lite_search_filter' );
