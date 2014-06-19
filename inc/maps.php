<?php
/**
 * Map Functions
 *
 * Contains functions used to process and display maps.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Map.
 *
 * Creates neccessary HTML to render a map with the Google Maps API if necessary data
 * exists; returns false not.
 *
 * @param string $lat Map latitude.
 * @param string $lng Map longitude.
 * @return mixed HTML requred to render map if data exists; false if not.
 */
function tbf_map( $lat = null, $lng = null ) {

  if ( $lat && $lng ) {
    $html  = '<div class="tbf-map">';
    $html .= '<div class="marker" data-lat="' . $lat . '" data-lng="' . $lng . '"></div>';
    $html .= '</div>';

    echo $html;
  } else {
    return false;
  }

}