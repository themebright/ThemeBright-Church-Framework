<?php
/**
 * Framework Scripts
 *
 * Enqueues the various scripts required by the ThemeBright framework.
 */

/**
 * Registers and enqueues framework scripts.
 */
function tbf_scripts() {

  // Register scripts for use later
  wp_register_script( 'tbf-maps-api', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', 'false', TBF_VERSION );
  wp_register_script( 'tbf-maps', tbf_get_template_directory_uri() . '/' . TBF_DIR . '/assets/js/maps.js', array( 'jquery', 'tbf-maps-api' ), TBF_VERSION );

  // Immediately enqueue these scripts
  // wp_enqueue_script( 'tbf', tbf_get_template_directory_uri() . TBF_DIR . '/assets/js/tbf.js', array( 'jquery' ), TBF_VERSION );

}
add_action( 'wp_enqueue_scripts', 'tbf_scripts' );