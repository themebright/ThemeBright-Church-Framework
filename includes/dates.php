<?php
/**
 * Dates
 *
 * Contains functions used to process and display dates.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Function
 */

/**
 * Format date.
 *
 * Formats a date with the Y-m-d format into any format specificed.
 *
 * @param string $date Date to process and format
 * @param string $format PHP date format string to be returned.
 * @return string Formatted date if it exists; contents of $date if it does not.
 */
function tbf_format_date( $date = null, $format = null ) {

  if ( ! $format ) {
    $format = get_option( 'date_format' );
  }

  if ( $date ) {
    $date = date_format( date_create_from_format( 'Y-m-d', $date ), $format );
  }

  return $date;

}