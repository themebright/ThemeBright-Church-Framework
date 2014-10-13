<?php
/**
 * ThemeBright Framework
 */

/**
 * Get and save theme data.
 */
$theme_data = wp_get_theme();
$theme_data = is_child_theme() ? wp_get_theme( $theme_data->template ) : $theme_data;

/**
 * Define constants.
 */
if ( ! defined( 'TBF_VERSION' ) )       define( 'TBF_VERSION',       '1.0.0' );
if ( ! defined( 'TBF_DIR' ) )           define( 'TBF_DIR',           basename( __DIR__ ) );

if ( ! defined( 'TBF_THEME_VERSION' ) ) define( 'TBF_THEME_VERSION', $theme_data->Version );

/**
 * Load includes.
 */
$includes = array(
  'addresses.php',
  'ctc.php',
  'dates.php',
  'email.php',
  'events.php',
  'head.php',
  'helpers.php',
  'locations.php',
  'maps.php',
  'meta.php',
  'people.php',
  'phone.php',
  'scripts.php',
  'sermons.php',
  'styles.php',
  'terms.php',
  'urls.php',
  'widgets.php'
);

foreach ( $includes as $include ) {
  locate_template( TBF_DIR . "/includes/$include", true );
}