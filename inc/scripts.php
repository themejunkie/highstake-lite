<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2017, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function highstake_enqueue() {

	// Load plugins stylesheet
	wp_enqueue_style( 'highstake-plugins-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/plugins.min.css' );

	// Fonts
	wp_enqueue_style( 'highstake-fonts', highstake_fonts_url() );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'highstake-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'highstake-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'highstake-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'highstake-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// Load custom js plugins.
		wp_enqueue_script( 'highstake-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/highstake.min.js', array( 'jquery' ), null, true );

	}

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'highstake-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Loads HTML5 Shiv
	wp_enqueue_script( 'highstake-html5', trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.min.js', array( 'jquery' ), null, false );
	wp_script_add_data( 'highstake-html5', 'conditional', 'lte IE 9' );

}
add_action( 'wp_enqueue_scripts', 'highstake_enqueue' );

/**
 * Enable sticky sidebar
 */
function highstake_sticky_sidebar() {

	// Get the customizer data
	$enable = get_theme_mod( 'highstake_sticky_sidebar', 1 );

	if ( $enable ) {
		?>
		<script type="text/javascript">
			( function( $ ) {
				$( function() {
					$( '.widget-area' ).theiaStickySidebar( {
						additionalMarginTop: 100
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}

}
add_action( 'wp_footer', 'highstake_sticky_sidebar', 15 );
