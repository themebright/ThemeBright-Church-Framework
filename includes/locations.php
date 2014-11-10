<?php
/**
 * Location Functions
 *
 * Contains functions used to display locations and their meta data.
 */

/**
 * Gets the location meta using tbf_get_meta without need for prefix.
 */
function tbf_get_location_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_location_' . $key, $post_id );

    return $data;
  }

}

/**
 * Displays the location address if it exists; returns false if not.
 */
function tbf_location_address( $post_id = null ) {

  $address = tbf_get_location_meta( 'address', $post_id );

  if ( ! empty( $address ) ) {
    return tbf_address( $address );
  }

  return false;

}

/**
 * Displays the location phone if it exists; returns false if not.
 */
function tbf_location_phone( $post_id = null ) {

  $phone = tbf_get_location_meta( 'phone', $post_id );

  if ( ! empty( $phone ) ) {
    return tbf_phone_link( $phone );
  }

  return false;

}

/**
 * Displays location times in <ul> if they exists; returns false if not.
 */
function tbf_location_times( $post_id = null ) {

  $times = tbf_get_location_meta( 'times', $post_id );

  if ( ! empty( $times ) ) {
    $html = '';

    $times = explode( PHP_EOL, $times );
    $times = array_map( 'trim', $times );

    $html .= '<ul class="location-times times">';

    foreach ( $times as $time ) {
      $html .= "<li><span>$time</span></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Displays a location map if neccesary data exists; returns false if not.
 */
function tbf_location_map( $post_id = null ) {

  $lat = tbf_get_location_meta( 'map_lat', $post_id );
  $lng = tbf_get_location_meta( 'map_lng', $post_id );

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    return tbf_map( $lat, $lng );
  }

  return false;

}

/**
 * Displays a static location map if neccesary data exists; returns false if not.
 */
function tbf_location_static_map( $post_id = null ) {

  $lat = tbf_get_location_meta( 'map_lat', $post_id );
  $lng = tbf_get_location_meta( 'map_lng', $post_id );

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    return tbf_static_map( $lat, $lng );
  }

  return false;

}