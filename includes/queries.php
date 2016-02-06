<?php
/**
 * Queries
 */

/**
 * Returns a WP_Query object with events.
 */
function tbf_query_events( $args = array() ) {

	return new WP_Query( apply_filters( 'tbf_query_events', array_merge( array(
		'post_type'  => 'ctc_event',
		'paged'      => tbf_page_num(),
		'order'      => 'ASC',
		'orderby'    => 'meta_value',
		'meta_key'   => '_ctc_event_start_date_start_time',
		'meta_type'  => 'DATETIME',
		'meta_query' => array(
			array(
				'key'     => '_ctc_event_end_date',
				'value'   => date_i18n( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE'
			)
		)
	), $args ) ) );

}

/**
 * Returns a WP_Query object with locations.
 */
function tbf_query_locations( $args = array() ) {

	return new WP_Query( apply_filters( 'tbf_query_locations', array_merge( array(
		'post_type'      => 'ctc_location',
		'paged'          => tbf_page_num(),
		'posts_per_page' => 500,
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'no_found_rows'  => true
	), $args ) ) );

}

/**
 * Returns a WP_Query object with people.
 */
function tbf_query_people( $args = array() ) {

	return new WP_Query( apply_filters( 'tbf_query_people', array_merge( array(
		'post_type' => 'ctc_person',
		'paged'     => tbf_page_num(),
		'order'     => 'ASC',
		'orderby'   => 'menu_order'
	), $args ) ) );

}

/**
 * Returns a WP_Query object with sermons.
 */
function tbf_query_sermons( $args = array() ) {

	return new WP_Query( apply_filters( 'tbf_query_sermons', array_merge( array(
		'post_type' => 'ctc_sermon',
		'paged'     => tbf_page_num()
	), $args ) ) );

}
