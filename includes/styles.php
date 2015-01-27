<?php
/**
 * Framework Styles
 *
 * Enqueues the various styles required by the ThemeBright framework.
 */

/**
 * Registers and enqueues framework styles.
 */
function tbf_styles() {

  wp_enqueue_style( 'tbf', tbf_get_template_directory_uri() . '/' . TBF_DIR . '/assets/css/tbf.css', false, TBF_VERSION );

}
add_action( 'wp_enqueue_scripts', 'tbf_styles' );