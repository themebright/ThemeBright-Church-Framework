<?php
/**
 * Helper Functions
 */

/**
 * Strips phone number of all non-digit characters.
 */
function tbf_clean_phone( $number = null ) {

  if ( ! empty( $number ) ) {
    $number = preg_replace( '/\D+/', '', $number );
  }

  return $number;

}

/**
 * Formats a date from the Y-m-d format into any format specificed.
 */
function tbf_format_date( $date = null, $format = null ) {

  if ( empty( $format ) ) {
    $format = get_option( 'date_format' );
  }

  if ( ! empty( $date ) ) {
    $date = date_format( date_create_from_format( 'Y-m-d', $date ), $format );
  }

  return $date;

}

/**
 * Formats a time from the Y-m-d H:i:s format into any format specificed.
 */
function tbf_format_time( $time = null, $format = null ) {

  if ( empty( $format ) ) {
    $format = get_option( 'time_format' );
  }

  if ( ! empty( $time ) ) {
    $time = date_format( date_create_from_format( 'Y-m-d H:i:s', $time ), $format );
  }

  return $time;

}

/**
 * Returns the URL of the current template with a trailing slash and no protocol.
 */
function tbf_get_template_directory_uri() {

  return untrailingslashit( tbf_strip_protocol( get_template_directory_uri() ) );

}

/**
 * Strips http: and https: protocols from URLs.
 */
function tbf_strip_protocol( $url = null ) {

  if ( ! empty( $url ) ) {
    $url = str_replace( array( 'http:', 'https:' ), '', $url );
  }

  return $url;

}
