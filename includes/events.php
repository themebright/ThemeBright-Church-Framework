<?php
/**
 * Event Functions
 */

/**
 * Gets the event meta using tbcf_get_meta without need for prefix.
 */
function tbcf_get_event_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbcf_get_meta( $post_id, '_ctc_event_' . $key );

		return $data;
	}

	return false;

}

/**
 * Gets an array of years (each containing an array of months) that upcoming events exists in and saves in a transient.
 */
function tbcf_get_event_months() {

	if ( get_transient( 'tbcf_event_months' ) === false ) {

		$args = array(
			'posts_per_page' => 2000,
			'post_type'      => 'ctc_event',
			'no_found_rows'  => true,
			'meta_query'     => array(
				array(
					'key'     => '_ctc_event_start_date_start_time',
					'value'   => date_i18n( 'Y-m-d' ),
					'compare' => '>='
				)
			)
		);

		$events = new WP_Query( $args );
		$events = $events->posts;

		if ( count( $events ) < 1 ) {
			return false;
		}

		foreach ( $events as $event ) {
			$future_dates_with_events[] = substr( get_post_meta( $event->ID, '_ctc_event_start_date', true ), 0, 7 );
		}

		$future_dates_with_events = array_unique( $future_dates_with_events );
		sort( $future_dates_with_events );

		foreach ( $future_dates_with_events as $date ) {
			$future_years_with_events[] = substr( $date, 0, 4 );
		}

		$future_years_with_events = array_unique( $future_years_with_events );

		foreach ( $future_years_with_events as $year ) {
			foreach ( $future_dates_with_events as $date ) {
				if ( substr( $date, 0, 4 ) == $year ) {
					$event_months[substr( $date, 0, 4 )][] = substr( $date, 5, 7 );
				}
			}
		}

		set_transient( 'tbcf_event_months', $event_months, DAY_IN_SECONDS );

	} else {

		$event_months = get_transient( 'tbcf_event_months' );

	}

	wp_reset_postdata();

	return $event_months;

}

/**
 * Deletes tbcf_event_months transient when events are updated.
 */
function tbcf_get_event_months_delete() {

	delete_transient( 'tbcf_event_months' );

}
add_action( 'edit_post', 'tbcf_get_event_months_delete' );


/**
 * Returns the event date if it exists; false if not.
 */
function tbcf_event_date( $post_id = null, $format = null ) {

	$start = tbcf_get_event_meta( $post_id, 'start_date' );
	$end   = tbcf_get_event_meta( $post_id, 'end_date' );

	if ( ! empty( $start ) ) {
		$date['start'] = tbcf_format_date( $start, $format );

		if ( ! empty( $end ) && $end !== $start ) {
			$date['end'] = tbcf_format_date( $end, $format );
		}

		return $date;
	}

	return false;

}

/**
 * Returns the event time if it exists; false if not.
 */
function tbcf_event_time( $post_id = null, $format = null ) {

	$start_alias = tbcf_get_event_meta( $post_id, 'start_time' );
	$end_alias   = tbcf_get_event_meta( $post_id, 'end_time' );

	$start = tbcf_get_event_meta( $post_id, 'start_date_start_time' );
	$end   = tbcf_get_event_meta( $post_id, 'end_date_end_time' );

	if ( ! empty( $start_alias ) ) {
		$time['start'] = tbcf_format_time( $start, $format );

		if ( ! empty( $end_alias ) && $end_alias !== $start_alias ) {
			$time['end'] = tbcf_format_time( $end, $format );
		}

		return $time;
	}

	return false;

}

/**
 * Returns true if hide time range; false if not.
 */
function tbcf_event_hide_time_range( $post_id = null ) {

	return tbcf_get_event_meta( $post_id, 'hide_time_range' );

}

/**
 * Returns the event time description if it exists; false if not.
 */
function tbcf_event_time_description( $post_id = null ) {

	$time = tbcf_get_event_meta( $post_id, 'time' );

	if ( ! empty( $time ) ) {
		return $time;
	}

	return false;

}

/**
 * Returns the event venue if it exists; false if not.
 */
function tbcf_event_venue( $post_id = null ) {

	$venue = tbcf_get_event_meta( $post_id, 'venue' );

	if ( ! empty( $venue ) ) {
		return $venue;
	}

	return false;

}

/**
 * Returns the event address if it exists; false if not.
 */
function tbcf_event_address( $post_id = null ) {

	$address = tbcf_get_event_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return nl2br( $address );
	}

	return false;

}

/**
 * Returns truthy value if show directions link; falsey if not.
 */
function tbcf_event_show_directions_link( $post_id = null ) {

	return tbcf_get_event_meta( $post_id, 'show_directions_link' );

}

/**
 * Returns Google Maps URL for an event address if one exists; false if not.
 */
function tbcf_event_directions_url( $post_id = null ) {

	$address = tbcf_get_event_meta( $post_id, 'address' );

	if ( ! empty( $address ) ) {
		return tbcf_directions_url( $address );
	}

	return false;

}

/**
 * Returns the event map if neccesary data exists; false if not.
 */
function tbcf_event_map( $post_id = null ) {

	$lat = tbcf_get_event_meta( $post_id, 'map_lat' );
	$lng = tbcf_get_event_meta( $post_id, 'map_lng' );

	if ( ! empty( $lat ) && ! empty( $lng ) ) {
		$args = array(
			'lat' => $lat,
			'lng' => $lng
		);

		$type = tbcf_get_event_meta( $post_id, 'map_type' );
		if ( $type ) $args['type'] = $type;

		$zoom = tbcf_get_event_meta( $post_id, 'map_zoom' );
		if ( $zoom ) $args['zoom'] = $zoom;

		return tbcf_map( $args );
	}

	return false;

}

/**
 * Returns an event's categories if they exist; false if not.
 */
function tbcf_event_categories( $post_id = null ) {

	$categories = tbcf_get_terms( $post_id, 'ctc_event_category' );

	if ( ! empty( $categories ) ) {
		return $categories;
	}

	return false;

}
