<?php
/**
 * Archives
 */

/**
 * Update archive slugs to new URLs.
 */
function tbf_update_archive_slugs() {

	$theme_support = get_theme_support( 'tbf' );
	if ( ! $theme_support || ! in_array( 'archive_redirection', $theme_support[0] ) ) {
		return false;
	}

	add_filter( 'ctc_post_type_event_args', function( $args ) {
		$args['rewrite']['slug'] = 'ctc-events';
		return $args;
	} );

	add_filter( 'ctc_post_type_location_args', function( $args ) {
		$args['rewrite']['slug'] = 'ctc-locations';
		return $args;
	} );

	add_filter( 'ctc_post_type_person_args', function( $args ) {
		$args['rewrite']['slug'] = 'ctc-people';
		return $args;
	} );

	add_filter( 'ctc_post_type_sermon_args', function( $args ) {
		$args['rewrite']['slug'] = 'ctc-sermons';
		return $args;
	} );

}
add_action( 'after_setup_theme', 'tbf_update_archive_slugs', 999 );

/**
 * Redirect archives to oldest page with appropriate template if theme support allows.
 */
function tbf_redirect_archives_to_pages( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return false;
	}

	$theme_support = get_theme_support( 'tbf' );
	if ( ! $theme_support || ! in_array( 'archive_redirection', $theme_support[0] ) ) {
		return false;
	}

	if ( ! is_post_type_archive( array( 'ctc_event', 'ctc_location', 'ctc_person', 'ctc_sermon' ) ) ) {
		return false;
	}

	switch ( $query->query['post_type'] ) {
		case 'ctc_event':
			$template = 'templates/events.php';
			break;
		case 'ctc_location':
			$template = 'templates/locations.php';
			break;
		case 'ctc_person':
			$template = 'templates/people.php';
			break;
		case 'ctc_sermon':
			$template = 'templates/sermons.php';
			break;
		default:
			$template = null;
	}

	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => $template
	) );

	if ( count( $pages ) > 0 ) {
		wp_redirect( esc_url( get_permalink( $pages[0]->ID ) ) );
		exit;
	}

}
add_action( 'pre_get_posts', 'tbf_redirect_archives_to_pages' );
