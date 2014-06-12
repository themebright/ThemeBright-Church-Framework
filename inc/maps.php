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
 * Map HTML
 *
 * Creates neccessary HTML to render a map with the Google Maps API.
 *
 * @param string $lat Map latitude.
 * @param string $lng Map longitude.
 * @return string HTML requred to render map.
 */
function tbf_map_html( $lat = null, $lng = null ) {

  if ( empty( $lat ) || empty( $lng ) ) {
    return null;
  }

  if ( $lat && $lng ) {
    $html  = '<div class="tbf-map">';
    $html .= '<div class="marker" data-lat="' . $lat . '" data-lng="' . $lng . '"></div>';
    $html .= '</div>';

    echo $html;
  }

}