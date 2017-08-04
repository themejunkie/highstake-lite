( function ( $ ) {

	// Document ready
	$( function () {

		// Responsive video
		$( '.entry, .widget' ).fitVids();

		// Search bar
		var $search = $( '.searchbar' );
		$( '.search-toggle' ).on( 'click', function() {
			$search.fadeToggle( 300 );
			$( '.searchbar-field' ).focus();
		});
		$( '.search-close' ).on( 'click', function() {
			$search.fadeToggle( 300 );
		} );

		/**
		 * Mobile menu
		 */
		$( '#menu-primary-items' ).slicknav( {
			label: '',
			prependTo: '.menu-primary-container',
			allowParentLinks: true
		} );

		// Posts slider
		$( '.featured-posts' ).owlCarousel( {
			items: 1,
			nav: true,
			dots: false,
			navText: [
				'<i class="fa fa-chevron-left" aria-hidden="true"></i>',
				'<i class="fa fa-chevron-right" aria-hidden="true"></i>'
			],
			loop: true,
			autoplay: true
		});

		// Format gallery
		$( '.format-gallery-slider' ).owlCarousel( {
			items: 1,
			nav: true,
			dots: false,
			navText: [
				'<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
				'<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'
			],
			loop: true,
			autoplay: true
		});

		// Popup image
		$( '.entry-gallery' ).magnificPopup({
			type: 'image',
			delegate: 'a',
			gallery: {
				enabled:true
			}
		});


	} );

}( jQuery ) );
