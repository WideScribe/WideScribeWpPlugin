( function( $ ) {

	$( '.format-video .entry-media embed, .format-video .entry-media iframe, .format-video .entry-media object' ).each( function() {

		$( this ).attr( 'data-ratio', this.height / this.width );

	} );

	function responsive_videos() {

		$( '.format-video .entry-media embed, .format-video .entry-media iframe, .format-video .entry-media object' ).each( function() {

			var video_ratio     = $( this ).attr( 'data-ratio' ),
			    video_wrapper   = $( this ).parent(),
			    container_width = video_wrapper.width();

			$( this )
				.removeAttr( 'height' )
				.removeAttr( 'width' )
				.width( container_width )
				.height( container_width * video_ratio );

		} );

	}

	responsive_videos();

	$( window ).load( responsive_videos ).resize( _.debounce( responsive_videos, 100 ) );
	$( document ).on( 'post-load', function() {

		$( '.format-video .entry-media embed, .format-video .entry-media iframe, .format-video .entry-media object' ).each( function() {

			$( this ).attr( 'data-ratio', this.height / this.width );

		} );

		responsive_videos();

	} );

} )( jQuery );
