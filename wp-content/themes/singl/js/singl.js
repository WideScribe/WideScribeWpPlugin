( function( $ ) {

	$( document ).ready( function() {

		var widgets_wrapper = $( '#widgets-wrapper' ),
		    widgets_trigger = $( '.widgets-trigger' ),
		    icon            = $( '.widgets-trigger .fa' );

		/*
		 * Click event for toggling the bottom-panel.
		 */
		widgets_trigger.click( function( e ) {
			e.preventDefault();
			widgets_wrapper.toggleClass( 'hide' );
			icon.toggleClass( 'fa-angle-up' ).toggleClass( 'fa-angle-down' );
		} );

		/*
		 * Backstretch.
		 */
		 if ( '' != singl_background_image_vars.header_bg && singl_script_vars.bg_image_url ) {
		 	$( 'body' ).backstretch( singl_script_vars.bg_image_url );
		 }

	} );

	/*
	 * A function to move the social links depending on the screen resolution
	 * and resize the entry thumbnail.
	 */
	function responsive() {
		var social_links = $( '#social-links-wrapper' ),
		    thumbnail = $( '.entry-thumbnail' );

		if( $( window ).width() < 768 ) {
			social_links.insertBefore( $( '#colophon' ) );
			thumbnail.css( 'width', '100%' ).css( 'width', '+=80px' );
		} else {
			social_links.appendTo( $( '#header-wrapper' ) );
			thumbnail.removeAttr( 'style' );
		}
		social_links.show();
	}
	$( window ).load( responsive ).resize( _.debounce( responsive, 100 ) );

} )( jQuery );