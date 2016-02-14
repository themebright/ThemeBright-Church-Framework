<?php
/**
 * Meta Functions
 */

/**
 * Gets any type of meta data.
 */
function tbcf_get_meta( $post_id = null, $key = null ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	if ( ! empty( $key ) && ! empty( $post_id ) ) {
		$data = trim( get_post_meta( $post_id, $key, true ) );

		return $data;
	}

	return false;

}
