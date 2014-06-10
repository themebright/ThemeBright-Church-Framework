<?php

function tbf_get_location_meta( $key = null, $post_id = null ) {

  if ( isset( $key ) ) {
    $data = tbf_get_meta_data( '_ctc_location_' . $key, $post_id );

    return $data;
  }

}

function tbf_location_phone_html( $post_id = null ) {

  $number = tbf_get_location_meta( 'phone', $post_id );

  if ( empty( $number ) ) {
    return null;
  }

  if ( $number ) {
    $html  = '<a href="tel:+' . tbf_clean_phone( $number ) . '" class="location-phone phone">';
    $html .= $number;
    $html .= '</a>';

    echo $html;
  }

}

function tbf_location_times_html( $post_id = null ) {

  $times = tbf_get_location_meta( 'times', $post_id );

  if ( empty( $times ) ) {
    return null;
  }

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

function tbf_get_location_map( $post_id = null ) {

  $lat = tbf_get_location_meta( 'map_lat', $post_id );
  $lng = tbf_get_location_meta( 'map_lng', $post_id );

  if ( empty ( $lat ) || empty( $lng ) ) {
    return false;
  }

  if ( $lat && $lng ) {
    return true;
  }

}