<?php
/**
 * Taxonomy Functions
 */

/**
 * Gets a post's terms from a particular taxonomy.
 */
function tbf_get_terms( $post_id = null, $tax = null ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	if ( ! empty( $tax ) && ! empty( $post_id ) && has_term( '', $tax, $post_id ) ) {
		$terms = wp_get_post_terms( $post_id, $tax );

		return $terms;
	}

	return false;

}
