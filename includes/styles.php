<?php
/**
 * Framework Styles
 */

/**
 * Registers framework styles.
 */
function tbf_register_styles() {

	wp_register_style( 'tbf', tbf_get_template_directory_uri() . '/' . TBF_DIR . '/assets/css/tbf.css', false, TBF_VERSION );

}
add_action( 'wp_enqueue_scripts', 'tbf_register_styles' );
