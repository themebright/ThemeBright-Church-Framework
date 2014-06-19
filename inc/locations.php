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

  if ( $key ) {
    $data = tbf_get_meta( '_ctc_location_' . $key, $post_id );

    return $data;
  }

}

/**
 * Location times.
 *
 * Displays location times in unordered list if they exists, returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Location times if they exist, false if not.
 */
function tbf_location_times( $post_id = null ) {

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
  } else {
    return false;
  }

}

/**
 * Location map.
 *
 * Displays a location map if neccesary data exists, returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Map HTML if necessary data exists, false if not.
 */
function tbf_location_map( $post_id = null ) {

  $lat = tbf_get_locaation_meta( 'map_lat', $post_id );
  $lng = tbf_get_locaation_meta( 'map_lng', $post_id );

  if ( $lat && $lng ) {
    tbf_map_html( $lat, $lgn );
  } else {
    return false;
  }

}
