<?php
/**
 * <head> Functions
 *
 * Contains functions used to modify and add to the <head>.
 */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * Pulled straight from the _s source.
 */
function tbf_wp_title( $title, $sep ) {

  if ( is_feed() ) {
    return $title;
  }

  global $page, $paged;

  // add the blog name
  $title .= get_bloginfo( 'name', 'display' );

  // add the blog description for the home/front page
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " $sep $site_description";
  }

  // add a page number if necessary
  if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
    $title .= " $sep " . sprintf( __( 'Page %s', 'tbf' ), max( $paged, $page ) );
  }

  return $title;

}
add_filter( 'wp_title', 'tbf_wp_title', 10, 2 );