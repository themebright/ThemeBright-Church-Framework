<?php
/**
 * Framework Scripts
 */

/**
 * Registers framework scripts.
 */
function tbcf_register_scripts() {

	$maps_args = array( 'v' => '3' );

	if ( tbcf_gmaps_api_key() ) {
		$maps_args['key'] = tbcf_gmaps_api_key();
	}

	$maps_url = add_query_arg( $maps_args, '//maps.googleapis.com/maps/api/js' );

	wp_register_script( 'tbcf-maps-api', $maps_url, 'false', TBCF_VERSION, true );
	wp_register_script( 'tbcf-maps', tbcf_get_template_directory_uri() . '/tbcf/assets/js/maps.js', array( 'jquery', 'tbcf-maps-api' ), TBCF_VERSION, true );

	wp_register_script( 'tbcf', tbcf_get_template_directory_uri() . '/tbcf/assets/js/tbcf.js', array( 'jquery' ), TBCF_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'tbcf_register_scripts' );
