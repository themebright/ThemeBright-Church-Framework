jQuery( 'document' ).ready( function( $ ) {

  $( '.tbf-map__canvas' ).each( function( i ) {

    var $this = $( this );

    var id = 'tbf-map-' + i;

    var position = {
      lat: parseFloat( $this.data( 'tbf-map-lat' ) ),
      lng: parseFloat( $this.data( 'tbf-map-lng' ) )
    };

    var type = $this.data( 'tbf-map-type' );

    var zoom = parseInt( $this.data( 'tbf-map-zoom' ) );

    var options = {
      center    : position,
      mapTypeId : type,
      zoom      : zoom
    };

    $this.attr( 'id', id );

    var map = new google.maps.Map( document.getElementById( id ), options );

    var marker = new google.maps.Marker( {
      map      : map,
      position : position
    });

    google.maps.event.addListener( marker, 'click', function() {
      map.panTo( position );
    });

    google.maps.event.addDomListener( window, 'resize', function() {
      map.setCenter( position );
    });

  } );

} );
