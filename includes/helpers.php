<?php
/**
 * Helper Functions
 *
 * Various helpers used by the ThemeBright framework.
 */

/**
 * Retrieves the URL of the current template with a trailing slash and no protocol.
 */
function tbf_template_url() {

  $url = trailingslashit( tbf_strip_protocol( get_template_directory_uri() ) );

  return $url;

}