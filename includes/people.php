<?php
/**
 * People Functions
 */

/**
 * Gets the person meta using tbcf_get_meta without need for prefix.
 */
function tbcf_get_person_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbcf_get_meta( $post_id, '_ctc_person_' . $key );

		return $data;
	}

	return false;

}

/**
 * Returns the person's position if it exists; false if not.
 */
function tbcf_person_position( $post_id = null ) {

	$position = tbcf_get_person_meta( $post_id, 'position' );

	if ( ! empty( $position ) ) {
		return $position;
	}

	return false;

}

/**
 * Returns the person's phone if it exists; false if not.
 */
function tbcf_person_phone( $post_id = null ) {

	$phone = tbcf_get_person_meta( $post_id, 'phone' );

	if ( ! empty( $phone ) ) {
		return $phone;
	}

	return false;

}

/**
 * Returns the person's email if it exists; false if not.
 */
function tbcf_person_email( $post_id = null ) {

	$email = tbcf_get_person_meta( $post_id, 'email' );

	if ( ! empty( $email ) ) {
		return $email;
	}

	return false;

}

/**
 * Returns the person's URLs if they exist; false if not.
 */
function tbcf_person_urls( $post_id = null ) {

	$urls = tbcf_get_person_meta( $post_id, 'urls' );

	if ( ! empty( $urls ) ) {
		return array_map( 'trim', explode( PHP_EOL, $urls ) );
	}

	return false;

}

/**
 * Returns a person's groups if they exist; false if not.
 */
function tbcf_person_groups( $post_id = null ) {

	$groups = tbcf_get_terms( $post_id, 'ctc_person_group' );

	if ( ! empty( $groups ) ) {
		return $groups;
	}

	return false;

}
