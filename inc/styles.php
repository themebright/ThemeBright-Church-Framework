<?php

add_action('wp_enqueue_scripts', 'tbf_styles');
function tbf_styles() {
  wp_enqueue_style( 'tbf-maps', tbf_strip_http_https( get_template_directory_uri() . '/framework/assets/css/maps.css' ) );
}