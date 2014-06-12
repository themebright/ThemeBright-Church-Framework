<?php
/**
 * Framework Styles
 *
 * Enqueues the various styles required by the ThemeBright framework.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Assets
 */

/**
 * Enqueue framework styles.
 */
function tbf_styles() {

  wp_enqueue_style( 'tbf', tbf_strip_protocol( get_template_directory_uri() . '/' . TBF_CSS_DIR . '/tbf.css' ), false, TBF_VERSION );

}
add_action('wp_enqueue_scripts', 'tbf_styles');