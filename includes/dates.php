<?php
/**
 * Dates
 *
 * Contains functions used to process and display dates.
 */

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