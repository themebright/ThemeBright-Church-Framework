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

function tbf_clean_phone( $number = null ) {

  if ( isset( $number ) ) {
    $number = preg_replace( '/\D+/', '', $number );

    return $number;
  }

}

function tbf_strip_http_https( $input = null ) {

  if ( isset( $input ) ) {
    $output = str_replace( array( 'http:', 'https:' ), '', $input );

    return $output;
  }

}