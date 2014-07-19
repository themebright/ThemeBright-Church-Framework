<?php
/**
 * Map Functions
 *
 * Contains functions used to process and display URLs.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Strip protocol.
 *
 * Strips http: and https: from URLs.
 *
 * @param string $url URL to clean.
 * @return string Cleaned URL.
 */
function tbf_strip_protocol( $url = null ) {

  if ( $url ) {
    $url = str_replace( array( 'http:', 'https:' ), '', $url );

    return $url;
  }

}