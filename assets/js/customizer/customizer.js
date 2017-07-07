/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Set up variable
	api = wp.customize;

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Footer background color
	api( 'highstake_footer_bg', function ( value ) {
		value.bind( function ( to ) {
			to = to ? to : '#f5f5f5';
			$( '.site-footer' ).css( 'background-color', to );
		} );
	} );

} )( jQuery );
