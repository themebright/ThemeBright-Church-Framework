<?php
/**
 * Map Functions
 */

/**
 * Creates neccessary HTML to render a map with the Google Maps API if necessary data exists; returns false not.
 */
function tbf_map( $args = null ) {

	$defaults = array(
		'lat'  => null,
		'lng'  => null,
		'type' => tbf_map_type_default(),
		'zoom' => 14
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! empty( $args['lat'] ) && ! empty( $args['lng'] ) ) {
		wp_enqueue_script( 'tbf-maps-api' );
		wp_enqueue_script( 'tbf-maps' );

		$html  = '';

		$html .= '<div class="tbf-map">';
		$html .= '<div class="tbf-map__scaler">';
		$html .= '<div class="tbf-map__canvas" data-tbf-map-lat="' . $args['lat'] . '" data-tbf-map-lng="' . $args['lng'] . '" data-tbf-map-type="' . $args['type'] . '" data-tbf-map-zoom="' . $args['zoom'] . '"></div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	return false;

}

/**
 * Change default map type to ROADMAP.
 */
function tbf_map_type_default() {

	return 'ROADMAP';

}
add_filter( 'ctc_gmaps_type_default', 'tbf_map_type_default' );

/**
 * Returns Google Maps Directions URL for an address if one is provided; false if not.
 */
function tbf_directions_url( $address = null ) {

	if ( ! empty( $address ) ) {
		return esc_url( 'https://www.google.com/maps/dir/Current+Location/' . trim( strip_tags( urlencode( $address ) ) ) . '/' );
	}

	return false;

}
