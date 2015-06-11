<?php
/**
 * Location Functions
 */

/**
 * Gets the location meta using tbf_get_meta without need for prefix.
 */
function tbf_get_location_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbf_get_meta( $post_id, '_ctc_location_' . $key );

		return $data;
	}

	return false;

}

/**
 * Returns the location address if it exists; false if not.
 */
function tbf_location_address( $post_id = null ) {

	$address = tbf_get_location_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return nl2br( $address );
	}

	return false;

}

/**
 * Returns truthy value if show directions link; falsey if not.
 */
function tbf_location_show_directions_link( $post_id = null ) {

	return tbf_get_location_meta( $post_id, 'show_directions_link' );

}

/**
 * Returns Google Maps URL for a location address if one exists; false if not.
 */
function tbf_location_directions_url( $post_id = null ) {

	$address = tbf_get_location_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return tbf_directions_url( $address );
	}

	return false;

}

/**
 * Returns the location phone if it exists; false if not.
 */
function tbf_location_phone( $post_id = null ) {

	$phone = tbf_get_location_meta( $post_id, 'phone' );

	if ( ! empty( $phone ) ) {
		return $phone;
	}

	return false;

}

/**
 * Returns location times if they exists; false if not.
 */
function tbf_location_times( $post_id = null ) {

	$times = tbf_get_location_meta( $post_id, 'times' );

	if ( ! empty( $times ) ) {
		return nl2br( $times );
	}

	return false;

}

/**
 * Returns the location map if neccesary data exists; false if not.
 */
function tbf_location_map( $post_id = null ) {

	$lat = tbf_get_location_meta( $post_id, 'map_lat' );
	$lng = tbf_get_location_meta( $post_id, 'map_lng' );

	if ( ! empty( $lat ) && ! empty( $lng ) ) {
		$type = tbf_get_location_meta( $post_id, 'map_type' );
		$zoom = tbf_get_location_meta( $post_id, 'map_zoom' );

		return tbf_map( $lat, $lng, $type, $zoom );
	}

	return false;

}
