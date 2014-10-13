<?php
/**
 * URL Functions
 *
 * Contains functions used to process and display URLs.
 */

/**
 * Strips http: and https: protocols from URLs.
 */
function tbf_strip_protocol( $url = null ) {

  if ( ! empty( $url ) ) {
    $url = str_replace( array( 'http:', 'https:' ), '', $url );

    return $url;
  }

}