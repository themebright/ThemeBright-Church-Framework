( function() {

  // Declare our variables for later use
  var maps, map, id, lat, lng, position, zoom, options, marker;

  // Query all the maps
  maps = document.querySelectorAll( '.tbf-map' );

  // Loop through the maps
  for ( var i = 0; i < maps.length; i++ ) {

    // Save out individual map
    map = maps[i];

    // Save the ID
    id = 'map-' + i;

    // Set the ID
    map.setAttribute( 'id', id );

    // Save the map position
    position = {
      lat: parseInt( map.dataset.lat ),
      lng: parseInt( map.dataset.lng ),
    };

    // Save the map zoom
    zoom = parseInt( map.dataset.zoom );

    // Create the map options object
    options = {
      center: position,
      zoom: parseInt( map.dataset.zoom ),
      mapTypeId: map.dataset.type.toLowerCase(),
      panControl: false,
      mapTypeControl: false,
      scrollwheel: false
    };

    // Create the map
    map = new google.maps.Map( document.getElementById( id ), options );

    // Create the marker
    marker = new google.maps.Marker( {
      position: position,
      map: map
    });

    // On marker click, pan to center
    google.maps.event.addListener( marker, 'click', function() {
      map.panTo( position );
    });

    // On window resize, re-center the map
    google.maps.event.addDomListener( window, 'resize', function() {
      map.setCenter( position );
    });

  }

})();