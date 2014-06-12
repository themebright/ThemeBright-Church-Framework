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

  if ( isset( $url ) ) {
    $url = str_replace( array( 'http:', 'https:' ), '', $url );

    return $url;
  }

}

/**
 * Description
 * @param type $url
 * @return type
 */
function tbf_url_class( $url ) {

  $networks = array(
    'blogspot.com' => 'blogger',
    'facebook.com' => 'facebook',
    'flickr.com' => 'flickr',
    'instagram.com' => 'instagram',
    'pinterest.com' => 'pinterest',
    'plus.google.com' => 'gplus',
    'soundcloud.com' => 'soundcloud',
    'tumblr.com' => 'tumblr',
    'twitter.com' => 'twitter',
    'vimeo.com' => 'vimeo',
    'wordpress.com' => 'wordpress',
    'youtube.com' => 'youtube'
  );

  foreach ( $networks as $network => $class ) {
    if ( stripos( $url, $network ) !== false ) {
      return $class;
    }
  }

}