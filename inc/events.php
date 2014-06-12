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