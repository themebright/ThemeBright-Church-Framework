<?php
/**
 * Phone Number Functions
 *
 * Contains functions used to process and display phone numbers.
 */

/**
 * Cleans phone number and converts it into a tel: link.
 */
function tbf_phone_link( $number = null ) {

  if ( ! empty( $number ) ) {
    $html  = "<a href='tel:+" . esc_attr( tbf_clean_phone( $number ) ) . "' class='phone'><span>$number</span></a>";

    return $html;
  }

}

/**
 * Strips phone number of all non-digit characters.
 */
function tbf_clean_phone( $number = null ) {

  if ( ! empty( $number ) ) {
    $number = preg_replace( '/\D+/', '', $number );

    return $number;
  }

}