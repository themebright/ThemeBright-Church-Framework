<?php

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