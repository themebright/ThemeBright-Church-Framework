<?php
/**
 * Event Functions
 *
 * Contains functions used to display events and their meta data.
 */

/**
 * Gets the event meta using tbf_get_meta without need for prefix.
 */
function tbf_get_event_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_event_' . $key, $post_id );

    return $data;
  }

}

/**
 * Displays the event date if it exists; returns false if not.
 */
function tbf_event_date( $format = null, $post_id = null ) {

  $start_date = tbf_get_event_meta( 'start_date', $post_id );
  $start_date_formatted = tbf_format_date( $start_date, $format );

  $end_date = tbf_get_event_meta( 'end_date', $post_id );
  $end_date_formatted = tbf_format_date( $end_date, $format );

  if ( ! empty( $start_date ) ) {
    $html = '';

    $html .= "<span>$start_date_formatted</span>";

    if ( ! empty( $end_date ) && $end_date != $start_date ) {
      $html .= '<span class="sep">&ndash;</span>';

      $html .= "<span>$end_date_formatted</span>";
    }

    return $html;
  }

  return false;

}

/**
 * Displays the event time if it exists; returns false if not.
 */
function tbf_event_time( $post_id = null ) {

  $time = tbf_get_event_meta( 'time', $post_id );

  if ( ! empty( $time ) ) {
    $time = str_replace( array( '-', '–', '—' ), '&ndash;', $time );

    return $time;
  }

  return false;

}

/**
 * Displays the event venue if it exists; returns false if not.
 */
function tbf_event_venue( $post_id = null ) {

  $venue = tbf_get_event_meta( 'venue', $post_id );

  if ( ! empty( $venue ) ) {
    return $venue;
  }

  return false;

}

/**
 * Displays the event address if it exists; returns false if not.
 */
function tbf_event_address( $post_id = null ) {

  $address = tbf_get_event_meta( 'address', $post_id );

  if ( ! empty( $address ) ) {
    return tbf_address( $address );
  }

  return false;

}

/**
 * Displays an event map if neccesary data exists; returns false if not.
 */
function tbf_event_map( $post_id = null ) {

  $lat = tbf_get_event_meta( 'map_lat', $post_id );
  $lng = tbf_get_event_meta( 'map_lng', $post_id );

  if ( ! empty( $lat ) && ! empty( $lng ) ) {
    return tbf_map( $lat, $lng );
  }

  return false;

}