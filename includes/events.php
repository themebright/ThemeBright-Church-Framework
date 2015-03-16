<?php
/**
 * Event Functions
 */

/**
 * Gets the event meta using tbf_get_meta without need for prefix.
 */
function tbf_get_event_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_event_' . $key, $post_id );

    return $data;
  }

  return false;

}

/**
 * Returns the event date if it exists; false if not.
 */
function tbf_event_date( $format = null, $post_id = null ) {

  $start = tbf_get_event_meta( 'start_date', $post_id );
  $end   = tbf_get_event_meta( 'end_date',   $post_id );

  if ( ! empty( $start ) ) {
    $date['start'] = tbf_format_date( $start, $format );

    if ( ! empty( $end ) && $end !== $start ) {
      $date['end'] = tbf_format_date( $end, $format );
    }

    return $date;
  }

  return false;

}

/**
 * Returns the event time if it exists; false if not.
 */
function tbf_event_time( $format = null, $post_id = null ) {

  $start = tbf_get_event_meta( 'start_date_start_time', $post_id );
  $end   = tbf_get_event_meta( 'start_date_end_time',   $post_id );

  if ( ! empty( $start ) ) {
    $time['start'] = tbf_format_time( $start, $format );

    if ( ! empty( $end ) && $end !== $start ) {
      $time['end'] = tbf_format_time( $end, $format );
    }

    return $time;
  }

  return false;

}

/**
 * Returns truthy value if hide time range; falsey if not.
 */
function tbf_event_hide_time_range( $post_id = null ) {

  return tbf_get_event_meta( 'hide_time_range', $post_id );

}

/**
 * Returns the event time description if it exists; false if not.
 */
function tbf_event_time_description( $post_id = null ) {

  $time = tbf_get_event_meta( 'time', $post_id );

  if ( ! empty( $time ) ) {
    return $time;
  }

  return false;

}

/**
 * Returns the event venue if it exists; false if not.
 */
function tbf_event_venue( $post_id = null ) {

  $venue = tbf_get_event_meta( 'venue', $post_id );

  if ( ! empty( $venue ) ) {
    return $venue;
  }

  return false;

}

/**
 * Returns the event address if it exists; false if not.
 */
function tbf_event_address( $post_id = null ) {

  $address = tbf_get_event_meta( 'address', $post_id );

  if ( ! empty( $address ) ) {
    return $address;
  }

  return false;

}

/**
 * Returns truthy value if show directions link; falsey if not.
 */
function tbf_event_show_directions_link( $post_id = null ) {

  return tbf_get_event_meta( 'show_directions_link', $post_id );

}

/**
 * Returns the event map if neccesary data exists; false if not.
 */
function tbf_event_map( $post_id = null ) {

  $lat = tbf_get_event_meta( 'map_lat', $post_id );
  $lng = tbf_get_event_meta( 'map_lng', $post_id );

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    $type = tbf_get_event_meta( 'map_type', $post_id );
    $zoom = tbf_get_event_meta( 'map_zoom', $post_id );

    return tbf_map( $lat, $lng, $type, $zoom );
  }

  return false;

}

/**
 * Returns an event's categories if they exist; false if not.
 */
function tbf_event_categories( $post_id = null ) {

  $categories = tbf_get_terms( 'ctc_event_category', $post_id );

  if ( ! empty( $categories ) ) {
    return $categories;
  }

  return false;

}
