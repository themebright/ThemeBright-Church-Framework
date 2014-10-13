<?php
/**
 * Taxonomy Functions
 *
 * Contains functions used to check, get, and display post taxonomies and terms.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Get terms.
 *
 * Gets a post's terms from a particular taxonomy.
 *
 * @param string $tax Taxonomy to search in.
 * @param int $post_id Post ID to get data for; null for current post
 * @return mixed Terms if they exist; false if they don't.
 */
function tbf_get_terms( $tax = null, $post_id = null ) {

  if ( empty( $post_id ) ) {
    $post_id = get_the_ID();
  }

  if ( ! empty( $tax ) && ! empty( $post_id ) && has_term( '', $tax, $post_id ) ) {
    $terms = wp_get_post_terms( $post_id, $tax );

    return $terms;
  }

  return false;

}