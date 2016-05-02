<?php
/**
 * Archives
 */

/**
 * Get the pages that take the place of the CTC post type archives.
 */
function tbcf_get_archive_replacement_pages( $post_type = null ) {

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
 * Redirects default archive pages to published pages with the appropriate page template (if they exist).
 */
function tbcf_redirect_archives() {

	$theme_support = get_theme_support( 'tbcf' );

	if ( ! empty( $theme_support ) && in_array( 'archive_redirection', $theme_support[0] ) && ! is_search() ) {
		if ( is_post_type_archive( array( 'ctc_event', 'ctc_location', 'ctc_person', 'ctc_sermon' ) ) ) {
			$page = tbcf_get_archive_replacement_pages( get_post_type() );

			if ( isset( $page[0] ) ) {
				wp_redirect( esc_url( get_permalink( $page[0]->ID ) ) );
				exit;
			}
		}
	}

}
add_action( 'template_redirect', 'tbcf_redirect_archives' );
