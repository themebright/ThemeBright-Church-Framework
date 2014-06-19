<?php
/**
 * Meta Functions
 *
 * Contains functions used to check, get, and display post meta data.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Get meta.
 *
 * Gets any type of CTC meta data.
 *
 * @param string $key Meta key to query.
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed The data if it exists; false if not.
 */
function tbf_get_meta( $key = null, $post_id = null ) {

  if ( ! $post_id ) {
    $post_id = get_the_ID();
  }

  if ( $key && $post_id ) {
    $data = get_post_meta( $post_id, $key, true );

    return $data;
  }

  return false;

}