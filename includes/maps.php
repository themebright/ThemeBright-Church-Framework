<?php
/**
 * Map Functions
 *
 * Contains functions used to process and display maps.
 */

/**
 * Creates neccessary HTML to render a map with the Google Maps API if necessary data exists; returns false not.
 */
function tbf_map( $lat = null, $lng = null ) {

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    wp_enqueue_script( 'tbf-maps-api' );
    wp_enqueue_script( 'tbf-maps' );

    $html = '';

    $html .= '<div class="tbf-map">';
    $html .= "<div class='marker' data-lat='$lat' data-lng='$lng'></div>";
    $html .= '</div>';

    return $html;
  }

  return false;

}