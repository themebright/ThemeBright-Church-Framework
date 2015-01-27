<?php
/**
 * Helper Functions
 *
 * Various helpers used by the ThemeBright framework.
 */

/**
 * Retrieves the URL of the current template with a trailing slash and no protocol.
 */
function tbf_get_template_directory_uri() {

  $url = untrailingslashit( tbf_strip_protocol( get_template_directory_uri() ) );

  return $url;

}