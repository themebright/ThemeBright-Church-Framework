<?php
/**
 * Framework Scripts
 */

/**
 * Registers framework scripts.
 */
function tbf_register_scripts() {

	wp_register_script( 'tbf-maps-api', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', 'false', TBF_VERSION );
	wp_register_script( 'tbf-maps', tbf_get_template_directory_uri() . '/' . TBF_DIR . '/assets/js/maps.js', array( 'jquery', 'tbf-maps-api' ), TBF_VERSION );

	wp_register_script( 'tbf', tbf_get_template_directory_uri() . '/' . TBF_DIR . '/assets/js/tbf.js', array( 'jquery' ), TBF_VERSION );

}
add_action( 'wp_enqueue_scripts', 'tbf_register_scripts' );
