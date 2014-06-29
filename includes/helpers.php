<?php
/**
 * Helper Functions
 *
 * Various helpers used by the ThemeBright framework.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Theme URL.
 *
 * Retrieves the URL of the current theme with a trailing slash and no protocol.
 *
 * @return string URL of the theme.
 */
function tbf_theme_url() {

  $url = tbf_strip_protocol( trailingslashit( get_stylesheet_directory() ) );

  return apply_filters( 'tbf_theme_url', $url );

}