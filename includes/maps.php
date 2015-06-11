<?php
/**
 * Map Functions
 */

/**
 * Creates neccessary HTML to render a map with the Google Maps API if necessary data exists; returns false not.
 */
function tbf_map( $lat = null, $lng = null, $type = 'ROAD', $zoom = '14' ) {

	if ( ! empty( $lat ) && ! empty( $lng ) ) {
		wp_enqueue_script( 'tbf-maps-api' );
		wp_enqueue_script( 'tbf-maps' );

		$html  = '';

		$html .= '<div class="tbf-map">';
		$html .= '<div class="tbf-map__scaler">';
		$html .= "<div class='tbf-map__canvas' data-tbf-map-lat='$lat' data-tbf-map-lng='$lng' data-tbf-map-type='$type' data-tbf-map-zoom='$zoom'></div>";
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	return false;

}

/**
 * Returns Google Maps Directions URL for an address if one is provided; false if not.
 */
function tbf_directions_url( $address = null ) {

	if ( ! empty( $address ) ) {
		return 'https://www.google.com/maps/dir/' . trim( strip_tags( urlencode( $address ) ) ) . '/';
	}

	return false;

}
