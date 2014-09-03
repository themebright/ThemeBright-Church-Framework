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
 * Template URL.
 *
 * Retrieves the URL of the current template with a trailing slash and no protocol.
 *
 * @return string URL of the template.
 */
function tbf_template_url() {

  $url = tbf_strip_protocol( get_template_directory_uri() );

  return apply_filters( 'tbf_theme_url', $url );

}