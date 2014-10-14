<?php
/**
 * <head> Functions
 *
 * Contains functions used to modify and add to the <head>.
 */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function tbf_title( $title ) {

  if ( is_feed() ) {
    return $title;
  }

  $title .= get_bloginfo( 'name', 'display' );

  $site_description = get_bloginfo( 'description', 'display' );
  if ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) {
    $title .= " | $site_description";
  }

  return $title;

}
add_filter( 'wp_title', 'tbf_title' );