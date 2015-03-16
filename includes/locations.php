<?php
/**
 * Location Functions
 */

/**
 * Gets the location meta using tbf_get_meta without need for prefix.
 */
function tbf_get_location_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_location_' . $key, $post_id );

    return $data;
  }

  return false;

}

/**
 * Returns the location address if it exists; false if not.
 */
function tbf_location_address( $post_id = null ) {

  $address = tbf_get_location_meta( 'address', $post_id );

  if ( ! empty( $address ) ) {
    return $address;
  }

  return false;

}

/**
 * Returns truthy value if show directions link; falsey if not.
 */
function tbf_location_show_directions_link( $post_id = null ) {

  return tbf_get_location_meta( 'show_directions_link', $post_id );

}

/**
 * Returns the location phone if it exists; false if not.
 */
function tbf_location_phone( $post_id = null ) {

  $phone = tbf_get_location_meta( 'phone', $post_id );

  if ( ! empty( $phone ) ) {
    return $phone;
  }

  return false;

}

/**
 * Returns location times if they exists; false if not.
 */
function tbf_location_times( $post_id = null ) {

  $times = tbf_get_location_meta( 'times', $post_id );

  if ( ! empty( $times ) ) {
    return $times;
  }

  return false;

}

/**
 * Returns the location map if neccesary data exists; false if not.
 */
function tbf_location_map( $post_id = null ) {

  $lat = tbf_get_location_meta( 'map_lat', $post_id );
  $lng = tbf_get_location_meta( 'map_lng', $post_id );

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    $type = tbf_get_location_meta( 'map_type', $post_id );
    $zoom = tbf_get_location_meta( 'map_zoom', $post_id );

    return tbf_map( $lat, $lng, $type, $zoom );
  }

  return false;

}
