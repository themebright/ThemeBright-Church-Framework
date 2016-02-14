<?php
/**
 * Location Functions
 */

/**
 * Gets the location meta using tbcf_get_meta without need for prefix.
 */
function tbcf_get_location_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbcf_get_meta( $post_id, '_ctc_location_' . $key );

		return $data;
	}

	return false;

}

/**
 * Returns the location address if it exists; false if not.
 */
function tbcf_location_address( $post_id = null ) {

	$address = tbcf_get_location_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return nl2br( $address );
	}

	return false;

}

/**
 * Returns truthy value if show directions link; falsey if not.
 */
function tbcf_location_show_directions_link( $post_id = null ) {

	return tbcf_get_location_meta( $post_id, 'show_directions_link' );

}

/**
 * Returns Google Maps URL for a location address if one exists; false if not.
 */
function tbcf_location_directions_url( $post_id = null ) {

	$address = tbcf_get_location_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return tbcf_directions_url( $address );
	}

	return false;

}

/**
 * Returns the location phone if it exists; false if not.
 */
function tbcf_location_phone( $post_id = null ) {

	$phone = tbcf_get_location_meta( $post_id, 'phone' );

	if ( ! empty( $phone ) ) {
		return $phone;
	}

	return false;

}

/**
 * Returns the location email if it exists; false if not.
 */
function tbcf_location_email( $post_id = null ) {

	$email = tbcf_get_location_meta( $post_id, 'email' );

	if ( ! empty( $email ) ) {
		return $email;
	}

	return false;

}

/**
 * Returns location times if they exists; false if not.
 */
function tbcf_location_times( $post_id = null ) {

	$times = tbcf_get_location_meta( $post_id, 'times' );

	if ( ! empty( $times ) ) {
		return nl2br( $times );
	}

	return false;

}

/**
 * Returns the location map if neccesary data exists; false if not.
 */
function tbcf_location_map( $post_id = null ) {

	$lat = tbcf_get_location_meta( $post_id, 'map_lat' );
	$lng = tbcf_get_location_meta( $post_id, 'map_lng' );

	if ( ! empty( $lat ) && ! empty( $lng ) ) {
		$args = array(
			'lat' => $lat,
			'lng' => $lng
		);

		$type = tbcf_get_location_meta( $post_id, 'map_type' );
		if ( $type ) $args['type'] = $type;

		$zoom = tbcf_get_location_meta( $post_id, 'map_zoom' );
		if ( $zoom ) $args['zoom'] = $zoom;

		return tbcf_map( $args );
	}

	return false;

}
