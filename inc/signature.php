<?php
/**
 * Signature
 *
 * @package    Highstake
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2018, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Custom signature.
 */
function highstake_custom_signature( $content ) {

	// Get the data from customizer.
	$signature_id  = get_theme_mod( 'highstake_signature_image' );
	$signature_url = wp_get_attachment_image_src( absint( $signature_id ) , 'full' );

	if ( $signature_url ) {
		$signature = '<img src="' . esc_url( $signature_url[0] ) . '" width="' . absint( $signature_url[1] ) . '" height="' . absint( $signature_url[2] ) . '" alt="" style="margin-bottom: 20px;">';
	}

	// Display the signature after post content
	if ( ! empty( $signature_url ) && is_single() ) {
		$content = $content . $signature;
	} else {
		$content;
	}

	return $content;

}
add_filter( 'the_content', 'highstake_custom_signature', 20 );
