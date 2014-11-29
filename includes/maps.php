<?php
/**
 * Map Functions
 *
 * Contains functions used to process and display maps.
 */

/**
 * Creates neccessary HTML to render a map with the Google Maps API if necessary data exists; returns false not.
 */
function tbf_map( $lat = null, $lng = null, $zoom = '14', $type = 'roadmap' ) {

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    wp_enqueue_script( 'tbf-maps-api' );
    wp_enqueue_script( 'tbf-maps' );

    $html = '';

    $html .= '<div class="tbf-map-scaler">';
    $html .= "<div class='tbf-map' data-lat='$lat' data-lng='$lng' data-zoom='$zoom' data-type='$type'></div>";
    $html .= '</div>';

    return $html;
  }

  return false;

}

/**
 * Creates neccessary HTML to render a linked, static map with the Google Maps API if necessary data exists; returns false not.
 */
function tbf_static_map( $lat = null, $lng = null ) {

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    $html = '';

    $html .= "<a href='https://www.google.com/maps/place/$lat,$lng' target='_blank'>";
    $html .= "<img class='tbf-static-map' src='https://maps.googleapis.com/maps/api/staticmap?center=$lat,$lng&zoom=15&size=640x384&scale=2&markers=$lat,$lng' alt=''>";
    $html .= '</a>';

    return $html;
  }

  return false;

}