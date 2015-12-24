<?php
/**
 * Helper Functions
 */

/**
 * Strips phone number of all non-digit characters.
 */
function tbf_clean_phone( $number = null ) {

	if ( ! empty( $number ) ) {
		$number = preg_replace( '/\D+/', '', $number );
	}

	return $number;

}

/**
 * Returns embed code based on audio/video URL or provided embed code.
 */
function tbf_embed_code( $content ) {

	global $wp_embed;

	if ( tbf_is_url( $content ) ) {
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
function tbf_format_date( $date = null, $format = null ) {

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
function tbf_format_time( $time = null, $format = null ) {

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
function tbf_get_attachment_id_by_url( $url ) {

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
function tbf_get_stylesheet_directory_uri() {

		return untrailingslashit( tbf_strip_protocol( get_stylesheet_directory_uri() ) );

}

/**
 * Returns the URL of the current parent theme with a trailing slash and no protocol.
 */
function tbf_get_template_directory_uri() {

		return untrailingslashit( tbf_strip_protocol( get_template_directory_uri() ) );

}

/**
 * Returns the first chacter from each word in a string; false if null.
 */
function tbf_initials( $name = null ) {

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
function tbf_is_url( $str ) {

	return preg_match( '/^(http(s*)):\/\//i', $str );

}

/**
 * Strips http: and https: protocols from URLs.
 */
function tbf_strip_protocol( $url = null ) {

	if ( ! empty( $url ) ) {
		$url = str_replace( array( 'http:', 'https:' ), '', $url );
	}

	return $url;

}
