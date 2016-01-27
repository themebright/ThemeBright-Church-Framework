<?php
/**
 * ThemeBright Framework
 */

/**
 * Saves theme data.
 */
$theme_data = wp_get_theme();
$theme_data = is_child_theme() ? wp_get_theme( $theme_data->get( 'Template' ) ) : $theme_data;

/**
 * Define constants.
 */
if ( ! defined( 'TBF_DIR' ) )              define( 'TBF_DIR',              basename( dirname( __FILE__ ) ) );
if ( ! defined( 'TBF_VERSION' ) )          define( 'TBF_VERSION',          '1.1.1' );

if ( ! defined( 'TBF_THEME_AUTHOR' ) )     define( 'TBF_THEME_AUTHOR',     $theme_data->get( 'Author' ) );
if ( ! defined( 'TBF_THEME_AUTHOR_URI' ) ) define( 'TBF_THEME_AUTHOR_URI', $theme_data->get( 'AuthorURI' ) );
if ( ! defined( 'TBF_THEME_NAME' ) )       define( 'TBF_THEME_NAME',       $theme_data->get( 'Name' ) );
if ( ! defined( 'TBF_THEME_URI' ) )        define( 'TBF_THEME_URI',        $theme_data->get( 'ThemeURI' ) );
if ( ! defined( 'TBF_THEME_VERSION' ) )    define( 'TBF_THEME_VERSION',    $theme_data->get( 'Version' ) );

/**
 * Loads includes.
 */
require_once get_template_directory() . '/' . TBF_DIR . '/includes/events.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/helpers.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/locations.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/maps.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/meta.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/people.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/scripts.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/sermons.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/styles.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/terms.php';
require_once get_template_directory() . '/' . TBF_DIR . '/includes/widgets.php';
