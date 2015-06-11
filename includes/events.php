<?php
/**
 * Event Functions
 */

/**
 * Gets the event meta using tbf_get_meta without need for prefix.
 */
function tbf_get_event_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbf_get_meta( $post_id, '_ctc_event_' . $key );

		return $data;
	}

	return false;

}

/**
 * Returns the event date if it exists; false if not.
 */
function tbf_event_date( $post_id = null, $format = null ) {

	$start = tbf_get_event_meta( $post_id, 'start_date' );
	$end   = tbf_get_event_meta( $post_id, 'end_date' );

	if ( ! empty( $start ) ) {
		$date['start'] = tbf_format_date( $start, $format );

		if ( ! empty( $end ) && $end !== $start ) {
			$date['end'] = tbf_format_date( $end, $format );
		}

		return $date;
	}

	return false;

}

/**
 * Returns the event time if it exists; false if not.
 */
function tbf_event_time( $post_id = null, $format = null ) {

	$start_alias = tbf_get_event_meta( $post_id, 'start_time' );
	$end_alias   = tbf_get_event_meta( $post_id, 'end_time' );

	$start = tbf_get_event_meta( $post_id, 'start_date_start_time' );
	$end   = tbf_get_event_meta( $post_id, 'end_date_end_time' );

	if ( ! empty( $start_alias ) ) {
		$time['start'] = tbf_format_time( $start, $format );

		if ( ! empty( $end_alias ) && $end_alias !== $start_alias ) {
			$time['end'] = tbf_format_time( $end, $format );
		}

		return $time;
	}

	return false;

}

/**
 * Returns truthy value if hide time range; falsey if not.
 */
function tbf_event_hide_time_range( $post_id = null ) {

	return tbf_get_event_meta( $post_id, 'hide_time_range' );

}

/**
 * Returns the event time description if it exists; false if not.
 */
function tbf_event_time_description( $post_id = null ) {

	$time = tbf_get_event_meta( $post_id, 'time' );

	if ( ! empty( $time ) ) {
		return $time;
	}

	return false;

}

/**
 * Returns the event venue if it exists; false if not.
 */
function tbf_event_venue( $post_id = null ) {

	$venue = tbf_get_event_meta( $post_id, 'venue' );

	if ( ! empty( $venue ) ) {
		return $venue;
	}

	return false;

}

/**
 * Returns the event address if it exists; false if not.
 */
function tbf_event_address( $post_id = null ) {

	$address = tbf_get_event_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return nl2br( $address );
	}

	return false;

}

/**
 * Returns truthy value if show directions link; falsey if not.
 */
function tbf_event_show_directions_link( $post_id = null ) {

	return tbf_get_event_meta( $post_id, 'show_directions_link' );

}

/**
 * Returns Google Maps URL for an event address if one exists; false if not.
 */
function tbf_event_directions_url( $post_id = null ) {

	$address = tbf_get_event_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return tbf_directions_url( $address );
	}

	return false;

}

/**
 * Returns the event map if neccesary data exists; false if not.
 */
function tbf_event_map( $post_id = null ) {

	$lat = tbf_get_event_meta( $post_id, 'map_lat' );
	$lng = tbf_get_event_meta( $post_id, 'map_lng' );

	if ( ! empty( $lat ) && ! empty( $lng ) ) {
		$type = tbf_get_event_meta( $post_id, 'map_type' );
		$zoom = tbf_get_event_meta( $post_id, 'map_zoom' );

		return tbf_map( $lat, $lng, $type, $zoom );
	}

	return false;

}

/**
 * Returns an event's categories if they exist; false if not.
 */
function tbf_event_categories( $post_id = null ) {

	$categories = tbf_get_terms( $post_id, 'ctc_event_category' );

	if ( ! empty( $categories ) ) {
		return $categories;
	}

	return false;

}
