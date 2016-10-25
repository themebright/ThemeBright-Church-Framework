<?php
/**
 * Map Functions
 */

/**
 * Creates neccessary HTML to render a map with the Google Maps API if necessary data exists; returns false not.
 */
function tbcf_map( $args = null ) {

	$defaults = array(
		'lat'  => null,
		'lng'  => null,
		'type' => tbcf_map_type_default(),
		'zoom' => 14
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! empty( $args['lat'] ) && ! empty( $args['lng'] ) ) {
		wp_enqueue_script( 'tbcf-maps-api' );
		wp_enqueue_script( 'tbcf-maps' );

		$html  = '';

		$html .= '<div class="tbcf-map">';
		$html .= '<div class="tbcf-map__scaler">';
		$html .= '<div class="tbcf-map__canvas" data-tbcf-map-lat="' . $args['lat'] . '" data-tbcf-map-lng="' . $args['lng'] . '" data-tbcf-map-type="' . $args['type'] . '" data-tbcf-map-zoom="' . $args['zoom'] . '"></div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	return false;

}

/**
 * Change default map type to ROADMAP.
 */
function tbcf_map_type_default() {

	return 'ROADMAP';

}
add_filter( 'ctc_gmaps_type_default', 'tbcf_map_type_default' );

/**
 * Returns Google Maps Directions URL for an address if one is provided; false if not.
 */
function tbcf_directions_url( $address = null ) {

	if ( ! empty( $address ) ) {
		return esc_url( 'https://www.google.com/maps/dir/Current+Location/' . trim( strip_tags( urlencode( $address ) ) ) . '/' );
	}

	return false;

}

/**
 * Outputs the CTC Google Maps API key in the footer if available.
 */
function tbcf_gmaps_api_key() {

	if ( function_exists( 'ctc_setting' ) ) {
		$key = ctc_setting( 'google_maps_api_key' );
	}

	if ( ! empty( $key ) ) {
		return $key;
	}

	return false;

}
add_action( 'wp_footer', 'tbcf_gmaps_api_key' );
