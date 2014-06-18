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

  if ( isset( $key ) ) {
    $data = tbf_get_meta( '_ctc_event_' . $key, $post_id );

    return $data;
  }

  return false;

}

/**
 * Has event map.
 *
 * Checks to see if the necessary meta exists to display a map.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return bool True if map_lat and map_lng exist; false if not.
 */
function tbf_has_event_map( $post_id = null ) {

  $lat = tbf_get_event_meta( 'map_lat', $post_id );
  $lng = tbf_get_event_meta( 'map_lng', $post_id );

  if ( isset( $lat ) && isset( $lng ) ) {
    return true;
  }

  return false;

}

/**
 * Event map.
 *
 * Displays event map if sufficient meta exists.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return string Event map HTML.
 */
function tbf_event_map( $post_id = null ) {

  if ( tbf_has_event_map( $post_id ) ) {
    tbf_map_html( tbf_get_event_meta( 'map_lat', $post_id ), tbf_get_event_meta( 'map_lng', $post_id ) );
  }

}

/**
 * Event date.
 *
 * Displays the event start date, and if it exists, the end date additionally.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return string Event start and possibly end date.
 */
function tbf_event_date( $post_id = null ) {

  $start_date = tbf_get_event_meta( 'start_date', $post_id );
  $end_date = tbf_get_event_meta( 'end_date', $post_id );

  $html = $start_date;

  if ( $end_date ) {
    $html .= ' &ndash; ' . $end_date;
  }

  echo $html;

}

/**
 * Event time.
 *
 * Displays the event time.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return string Event time.
 */
function tbf_event_time( $post_id = null ) {

  $time = tbf_get_event_meta( 'time', $post_id );

  echo $time;

}