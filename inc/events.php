<?php

function tbf_get_event_meta( $key = null, $post_id = null ) {

  if ( isset( $key ) ) {
    $data = tbf_get_meta_data( '_ctc_event_' . $key, $post_id );

    return $data;
  }

}

function tbf_get_event_map( $post_id = null ) {

  $lat = tbf_get_event_meta( 'map_lat', $post_id );
  $lng = tbf_get_event_meta( 'map_lng', $post_id );

  if ( empty ( $lat ) || empty( $lng ) ) {
    return false;
  }

  if ( $lat && $lng ) {
    return true;
  }

}