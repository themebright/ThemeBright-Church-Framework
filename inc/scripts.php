<?php

add_action('wp_enqueue_scripts', 'tbf_scripts');
function tbf_scripts() {
  wp_enqueue_script( 'tbf-google-maps', tbf_strip_http_https( 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false' ) );
  wp_enqueue_script( 'tbf-maps', tbf_strip_http_https( get_template_directory_uri() . '/framework/assets/js/maps.js' ), array( 'jquery', 'tbf-google-maps' ) );
}