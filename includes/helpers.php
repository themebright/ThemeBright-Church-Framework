<?php
/**
 * Helper Functions
 */

/**
 * Strips phone number of all non-digit characters.
 */
function tbcf_clean_phone( $number = null ) {

	if ( ! empty( $number ) ) {
		$number = preg_replace( '/\D+/', '', $number );
	}

	return $number;

}

/**
 * Converts classes from wp_page_nav() to class names from wp_nav_menu() for easier styling.
 */
function tbcf_convert_page_nav_to_nav_menu_classes( $html = null ) {

	if ( ! empty( $html ) ) {
		$html = str_replace( ' page_item_has_children', ' menu-item-has-children', $html );
		$html = str_replace( ' current_page_item',      ' current-menu-item',      $html );
		$html = str_replace( ' page-item-',             ' menu-item-',             $html );
		$html = str_replace( 'class="page_item',        'class="menu-item',        $html );
		$html = str_replace( "class='children'",        'class="sub-menu"',        $html );

		return $html;
	}

	return false;

}

/**
 * Returns embed code based on audio/video URL or provided embed code.
 */
function tbcf_embed_code( $content ) {

	global $wp_embed;

	if ( tbcf_is_url( $content ) ) {
		$embed_code = $wp_embed->shortcode( array(), $content );
	} else {
		$embed_code = $content;
	}

	$embed_code = do_shortcode( $embed_code );

	return $embed_code;

}

/**
 * Formats a date from the Y-m-d format into any format specificed.
 */
function tbcf_format_date( $date = null, $format = null ) {

	if ( empty( $format ) ) {
		$format = get_option( 'date_format' );
	}

	if ( ! empty( $date ) ) {
		$date = date_format( date_create_from_format( 'Y-m-d', $date ), $format );
	}

	return $date;

}

/**
 * Formats a time from the Y-m-d H:i:s format into any format specificed.
 */
function tbcf_format_time( $time = null, $format = null ) {

	if ( empty( $format ) ) {
		$format = get_option( 'time_format' );
	}

	if ( ! empty( $time ) ) {
		$time = date_format( date_create_from_format( 'Y-m-d H:i:s', $time ), $format );
	}

	return $time;

}

/**
 * Gets the attachment ID for the image URL provided.
 */
function tbcf_get_attachment_id_by_url( $url ) {

	$parsed_url = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url,       PHP_URL_HOST ) );

	if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}

	global $wpdb;

	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

	return $attachment[0];

}

/**
 * Returns the URL of the current theme with a trailing slash and no protocol.
 */
function tbcf_get_stylesheet_directory_uri() {

		return esc_url( untrailingslashit( tbcf_strip_protocol( get_stylesheet_directory_uri() ) ) );

}

/**
 * Returns the URL of the current parent theme with a trailing slash and no protocol.
 */
function tbcf_get_template_directory_uri() {

		return esc_url( untrailingslashit( tbcf_strip_protocol( get_template_directory_uri() ) ) );

}

/**
 * Returns the first chacter from each word in a string; false if null.
 */
function tbcf_initials( $name = null ) {

	if ( ! $name ) {
		return false;
	}

	$names    = explode( ' ', $name );
	$initials = '';

	foreach ( $names as $name ) {
		$initials .= trim( strtoupper( $name[0] ) );
	}

	return $initials;

}

/**
 * Returns true if a string is a URL; false if not.
 */
function tbcf_is_url( $str ) {

	return preg_match( '/^(http(s*)):\/\//i', $str );

}

/**
 * Returns page number for query and pagination on static templates.
 */
function tbcf_page_num() {

	global $paged;

	return get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

}

/**
 * Strips http: and https: protocols from URLs.
 */
function tbcf_strip_protocol( $url = null ) {

	if ( ! empty( $url ) ) {
		$url = str_replace( array( 'http:', 'https:' ), '', $url );
	}

	return esc_url( $url );

}
