<?php
/**
 * Address Functions
 *
 * Contains functions used to process and display addresses.
 */

/**
 * Displays an address in <address> tag with line breaks.
 */
function tbf_address( $address = null ) {

  if ( ! empty( $address ) ) {
    $address = nl2br( $address );

    $html = "<address>$address</address>";

    return $html;
  }

}