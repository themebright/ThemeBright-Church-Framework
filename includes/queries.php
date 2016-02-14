<?php
/**
 * Queries
 */

/**
 * Returns a WP_Query object with events.
 */
function tbcf_query_events( $args = array() ) {

	return apply_filters( 'tbcf_query_events', new WP_Query( array_merge( array(
		'post_type'  => 'ctc_event',
		'paged'      => tbcf_page_num(),
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
function tbcf_query_locations( $args = array() ) {

	return apply_filters( 'tbcf_query_locations', new WP_Query( array_merge( array(
		'post_type'      => 'ctc_location',
		'posts_per_page' => 500,
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'no_found_rows'  => true
	), $args ) ) );

}

/**
 * Returns a WP_Query object with people.
 */
function tbcf_query_people( $args = array() ) {

	return apply_filters( 'tbcf_query_people', new WP_Query( array_merge( array(
		'post_type' => 'ctc_person',
		'paged'     => tbcf_page_num(),
		'order'     => 'ASC',
		'orderby'   => 'menu_order'
	), $args ) ) );

}

/**
 * Returns a WP_Query object with sermons.
 */
function tbcf_query_sermons( $args = array() ) {

	return apply_filters( 'tbcf_query_sermons', new WP_Query( array_merge( array(
		'post_type' => 'ctc_sermon',
		'paged'     => tbcf_page_num()
	), $args ) ) );

}

/**
 * Modify default CTC post type archive queries to match the parameters of the above functions.
 */
function tbcf_modify_ctc_post_type_archives_query( $query ) {

	if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive() ) {
		return false;
	}

	if ( is_post_type_archive( 'ctc_event' ) ) {
		$query->set( 'order',      'ASC' );
		$query->set( 'orderby',    'meta_value' );
		$query->set( 'meta_key',   '_ctc_event_start_date_start_time' );
		$query->set( 'meta_type',  'DATETIME' );
		$query->set( 'meta_query', array(
			array(
				'key'     => '_ctc_event_end_date',
				'value'   => date_i18n( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE'
			)
		) );
		return;
	}

	if ( is_post_type_archive( 'ctc_location' ) ) {
		$query->set( 'posts_per_page', 500 );
		$query->set( 'order',          'ASC' );
		$query->set( 'orderby',        'menu_order' );
		$query->set( 'no_found_rows',  true );
		return;
	}

	if ( is_post_type_archive( 'ctc_person' ) ) {
		$query->set( 'order',   'ASC' );
		$query->set( 'orderby', 'meta_value' );
		return;
	}

}
add_action( 'pre_get_posts', 'tbcf_modify_ctc_post_type_archives_query' );
