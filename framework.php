<?php
/**
 * ThemeBright Framework
 */

/**
 * Saves theme data.
 */
$theme_data = wp_get_theme();
$theme_data = ( is_child_theme() ? wp_get_theme( $theme_data->template ) : $theme_data );

/**
 * Define constants.
 */
if ( ! defined( 'TBF_VERSION' ) )       define( 'TBF_VERSION',       '1.0.0' );
if ( ! defined( 'TBF_DIR' ) )           define( 'TBF_DIR',           basename( __DIR__ ) );

if ( ! defined( 'TBF_THEME_VERSION' ) ) define( 'TBF_THEME_VERSION', $theme_data->Version );

/**
 * Loads includes.
 */
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/events.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/helpers.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/locations.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/maps.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/meta.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/people.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/scripts.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/sermons.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/styles.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/terms.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/widgets.php' );
