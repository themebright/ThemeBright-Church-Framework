jQuery( 'document' ).ready( function( $ ) {

	$( '.tbf-map__canvas' ).each( function( i ) {

		var $this = $( this );

		var id = 'tbf-map__canvas--' + ( i + 1 );

		var position = {
			lat: parseFloat( $this.data( 'tbf-map-lat' ) ),
			lng: parseFloat( $this.data( 'tbf-map-lng' ) )
		};

		var type = $this.data( 'tbf-map-type' );
		var mapType = google.maps.MapTypeId.ROADMAP;
		if ( type === 'HYBRID' ) {
			mapType = google.maps.MapTypeId.HYBRID;
		} else if ( type === 'SATELLITE' ) {
			mapType = google.maps.MapTypeId.SATELLITE;
		} else if ( type === 'TERRAIN' ) {
			mapType = google.maps.MapTypeId.TERRAIN;
		}

		var zoom = parseInt( $this.data( 'tbf-map-zoom' ) );
		if ( ! zoom ) {
			zoom = 14;
		}

		var styles = [];
		if ( typeof tbfMapStyles !== 'undefined' ) {
			styles = tbfMapStyles;
		}

		var options = {
			center:             position,
			mapTypeId:          mapType,
			zoom:               zoom,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
			},
			panControl:         false,
			mapTypeControl:     false,
			styles:             styles
		};

		$this.attr( 'id', id );

		var map = new google.maps.Map( document.getElementById( id ), options );

		var marker = new google.maps.Marker( {
			map:      map,
			position: position
		} );

		google.maps.event.addListener( marker, 'click', function() {
			map.panTo( position );
		} );

		google.maps.event.addDomListener( window, 'resize', function() {
			map.setCenter( position );
		} );

	} );

} );
