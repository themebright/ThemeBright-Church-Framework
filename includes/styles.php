<?php
/**
 * Framework Styles
 */

/**
 * Registers framework styles.
 */
function tbcf_register_styles() {

	wp_register_style( 'tbcf', tbcf_get_template_directory_uri() . '/tbcf/assets/css/tbcf.css', false, TBCF_VERSION );

}
add_action( 'wp_enqueue_scripts', 'tbcf_register_styles' );
