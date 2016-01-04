<?php
/**
 * Archives
 */

/**
 * Get the pages that take the place of the CTC post type archives.
 */
function tbf_get_archive_replacement_pages( $post_type = null ) {

	if ( ! empty( $post_type ) ) {
		switch ( $post_type ) {
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

		return $pages;
	}

	return false;

}

/**
 * Update archive slugs to new URLs.
 */
function tbf_disable_archives() {

	$theme_support = get_theme_support( 'tbf' );

	if ( ! empty( $theme_support ) && in_array( 'archive_redirection', $theme_support[0] ) ) {

		add_filter( 'ctc_post_type_event_args', function( $args ) {
			$args['has_archive'] = false;
			return $args;
		} );

		add_filter( 'ctc_post_type_location_args', function( $args ) {
			$args['has_archive'] = false;
			return $args;
		} );

		add_filter( 'ctc_post_type_person_args', function( $args ) {
			$args['has_archive'] = false;
			return $args;
		} );

		add_filter( 'ctc_post_type_sermon_args', function( $args ) {
			$args['has_archive'] = false;
			return $args;
		} );

	}

	return false;

}
add_action( 'after_setup_theme', 'tbf_disable_archives', 999 );
