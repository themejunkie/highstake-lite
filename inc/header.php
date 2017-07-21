<?php
/**
 * Page header
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2017, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Set featured image as page header background.
 */
function highstake_page_header_bg() {

	// Show only on post and page
	if ( !is_single() && !is_page() ) {
		return;
	}

	// Get the featured image
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'highstake-featured-image' );

	// Display the custom header via inline CSS.
	if ( $img ) :
		$css = '
			.page-header {
				background-image: url("' . esc_url( $img[0] ) . '");
				background-size: cover;
				background-repeat: no-repeat;
				background-position: 50% 50%;
			}';
	endif;

	if ( ! empty( $css ) ) :
		wp_add_inline_style( 'highstake-style', $css );
	endif;

}
add_action( 'wp_enqueue_scripts', 'highstake_page_header_bg' );
