<?php
/**
 * Event Functions
 *
 * Contains functions used to display events and their meta data.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Get event meta.
 *
 * Gets the event meta using tbf_get_meta without need for prefix.
 *
 * @param string $key Meta key for the data to retrive.
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed The data if it exists; false if not.
 */
function tbf_get_event_meta( $key = null, $post_id = null ) {

  if ( $key ) {
    $data = tbf_get_meta( '_ctc_event_' . $key, $post_id );

    return $data;
  }

}

/**
 * Event date.
 *
 * Displays the event date if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Event date if it exists; false if not.
 */
function tbf_event_date( $post_id = null ) {

  $start_date = tbf_get_event_meta( 'start_date', $post_id );
  $end_date = tbf_get_event_meta( 'end_date', $post_id );

  if ( $start_date ) {
    $html = $start_date;

    if ( $end_date && $end_date != $start_date ) {
      $html .= ' &ndash; ' . $end_date;
    }

    return $html;
  }

  return false;

}

/**
 * Event time.
 *
 * Displays the event time if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Event time if it exists; false if not.
 */
function tbf_event_time( $post_id = null ) {

  $time = tbf_get_event_meta( 'time', $post_id );

  if ( $time ) {
    $time = str_replace( '-', '&ndash;', $time );

    return $time;
  }

  return false;

}

/**
 * Event venue.
 *
 * Displays the event venue if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Event venue if it exists; false if not.
 */
function tbf_event_venue( $post_id = null ) {

  $venue = tbf_get_event_meta( 'venue', $post_id );

  if ( $venue ) {
    return $venue;
  }

  return false;

}

/**
 * Event address.
 *
 * Displays the event address if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Event address if it exists; false if not.
 */
function tbf_event_address( $post_id = null ) {

  $address = tbf_get_event_meta( 'address', $post_id );

  if ( $address ) {
    return tbf_address( $address );
  }

  return false;

}

/**
 * Event map.
 *
 * Displays an event map if neccesary data exists; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Map HTML if necessary data exists; false if not.
 */
function tbf_event_map( $post_id = null ) {

  $lat = tbf_get_event_meta( 'map_lat', $post_id );
  $lng = tbf_get_event_meta( 'map_lng', $post_id );

  if ( $lat && $lng ) {
    return tbf_map( $lat, $lng );
  }

  return false;

}