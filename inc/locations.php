<?php
/**
 * Location Functions
 *
 * Contains functions used to display locations and their meta data.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Get location meta.
 *
 * Gets the location meta using tbf_get_meta without need for prefix.
 *
 * @param string $key Meta key for the data to retrive.
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed The data if it exists; false if not.
 */
function tbf_get_location_meta( $key = null, $post_id = null ) {

  if ( isset( $key ) ) {
    $data = tbf_get_meta( '_ctc_location_' . $key, $post_id );

    return $data;
  }

}

/**
 * Location times HTML.
 *
 * Displays the location's times in an unordered list.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return string Location times in unordered list.
 */
function tbf_location_times_html( $post_id = null ) {

  $times = tbf_get_location_meta( 'times', $post_id );

  if ( $times ) {
    $times = explode( PHP_EOL, $times );
    $times = array_map( 'trim', $times );

    $html = '<ul class="location-times times">';

    foreach ( $times as $time ) {
      $html .= "<li>$time</li>";
    }

    $html .= '</ul>';

    echo $html;
  }

}

/**
 * Has location map.
 *
 * Checks to see if the necessary meta exists to display a map.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return bool True if map_lat and map_lng exist; false if not.
 */
function tbf_has_location_map( $post_id = null ) {

  $lat = tbf_get_event_meta( 'map_lat', $post_id );
  $lng = tbf_get_event_meta( 'map_lng', $post_id );

  if ( isset( $lat ) && isset( $lng ) ) {
    return true;
  }

  return false;

}