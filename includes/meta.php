<?php
/**
 * Meta Functions
 *
 * Contains functions used to check, get, and display post meta data.
 */

/**
 * Gets any type of meta data.
 */
function tbf_get_meta( $key = null, $post_id = null ) {

  if ( empty( $post_id ) ) {
    $post_id = get_the_ID();
  }

  if ( ! empty( $key ) && ! empty( $post_id ) ) {
    $data = trim( get_post_meta( $post_id, $key, true ) );

    return $data;
  }

  return false;

}