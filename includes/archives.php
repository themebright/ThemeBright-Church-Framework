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
function tbf_update_archive_slugs() {

	$theme_support = get_theme_support( 'tbf' );

	if ( ! empty( $theme_support ) && in_array( 'archive_redirection', $theme_support[0] ) ) {

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

	return false;

}
add_action( 'after_setup_theme', 'tbf_update_archive_slugs', 999 );

/**
 * Redirect archives to oldest page with appropriate template if theme support allows.
 */
function tbf_redirect_archives_to_pages( $query ) {

	$theme_support = get_theme_support( 'tbf' );
	$post_types    = array( 'ctc_event', 'ctc_location', 'ctc_person', 'ctc_sermon' );

	if ( ! is_admin() && $query->is_main_query() && ! empty( $theme_support ) && in_array( 'archive_redirection', $theme_support[0] ) && is_post_type_archive( $post_types ) ) {
		$pages = tbf_get_archive_replacement_pages( $query->query['post_type'] );

		if ( count( $pages ) > 0 ) {
			wp_redirect( esc_url( get_permalink( $pages[0]->ID ) ) );
			exit;
		}
	}

	return false;

}
add_action( 'pre_get_posts', 'tbf_redirect_archives_to_pages' );
