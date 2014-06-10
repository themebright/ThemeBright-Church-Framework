<?php

function tbf_get_person_meta( $key = null, $post_id = null ) {

  if ( isset( $key ) ) {
    $data = tbf_get_meta_data( '_ctc_person_' . $key, $post_id );

    return $data;
  }

}

function tbf_person_phone_html( $post_id = null ) {

  $number = tbf_get_person_meta( 'phone', $post_id );

  if ( empty( $number ) ) {
    return null;
  }

  if ( $number ) {
    $html  = '<a href="tel:+' . tbf_clean_phone( $number ) . '" class="person-phone phone">';
    $html .= $number;
    $html .= '</a>';

    echo $html;
  }

}

function tbf_person_urls_html( $post_id = null ) {

  $urls = tbf_get_person_meta( 'urls', $post_id );

  if ( empty( $urls ) ) {
    return null;
  }

  if ( $urls ) {
    $urls = explode( PHP_EOL, $urls );
    $urls = array_map( 'trim', $urls );

    $html = '<ul class="person-social-link social-links">';

    foreach ( $urls as $url ) {
      $html .= "<li class='" . tbf_person_url_class($url) . "'><a href='$url'>$url</a></li>";
    }

    $html .= '</ul>';

    echo $html;
  }

}

function tbf_person_url_class( $url ) {

  if ( strpos( $url, 'twitter.com' ) !== false ) {
    return 'twitter';
  } elseif ( strpos( $url, 'facebook.com' ) !== false ) {
    return 'facebook';
  } elseif ( strpos( $url, 'flickr.com' ) !== false ) {
    return 'flickr';
  } elseif ( strpos( $url, 'youtube.com' ) !== false ) {
    return 'youtube';
  } elseif ( strpos( $url, 'vimeo.com' ) !== false ) {
    return 'vimeo';
  } else {
    return 'default';
  }

}