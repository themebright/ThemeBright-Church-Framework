<?php

function tbf_get_meta_data( $key = null, $post_id = null ) {

  if ( ! isset( $post_id ) ) {
    $post_id = get_the_ID();
  }

  if ( isset( $key ) && $post_id ) {
    $data = get_post_meta( $post_id, $key, true );

    if ( empty( $data ) ) {
      return null;
    }

    return $data;
  }

  return false;

}

function tbf_phone_html( $number ) {

  if ( empty( $number ) ) {
    return null;
  }

  if ( $number ) {
    $html  = '<a href="tel:+' . tbf_clean_phone( $number ) . '" class="event-phone phone">';
    $html .= $number;
    $html .= '</a>';

    echo $html;
  }

}


function tbf_map_html( $lat = null, $lng = null ) {

  if ( empty( $lat ) || empty( $lng ) ) {
    return null;
  }

  if ( $lat && $lng ) {
    $html  = '<div class="tbf-map">';
    $html .= '<div class="marker" data-lat="' . $lat . '" data-lng="' . $lng . '"></div>';
    $html .= '</div>';

    echo $html;
  }

}

function tbf_address_html( $address ) {

  if ( isset( $address ) ) {
    $address = nl2br( $address );

    echo $address;
  }

}

function tbf_clean_phone( $number = null ) {

  if ( isset( $number ) ) {
    $number = preg_replace( '/\D+/', '', $number );

    return $number;
  }

}

function tbf_strip_http_https( $url = null ) {

  if ( isset( $url ) ) {
    $url = str_replace( array( 'http:', 'https:' ), '', $url );

    return $url;
  }

}