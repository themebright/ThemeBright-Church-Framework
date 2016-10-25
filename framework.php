<?php
/**
 * ThemeBright Church Framework
 */

/**
 * Saves theme data.
 */
$theme_data = wp_get_theme();
$theme_data = is_child_theme() ? wp_get_theme( $theme_data->get( 'Template' ) ) : $theme_data;

/**
 * Define constants.
 */
if ( ! defined( 'TBCF_VERSION' ) )          define( 'TBCF_VERSION',          '1.2.3' );
if ( ! defined( 'TBCF_THEME_AUTHOR' ) )     define( 'TBCF_THEME_AUTHOR',     $theme_data->get( 'Author' ) );
if ( ! defined( 'TBCF_THEME_AUTHOR_URI' ) ) define( 'TBCF_THEME_AUTHOR_URI', $theme_data->get( 'AuthorURI' ) );
if ( ! defined( 'TBCF_THEME_NAME' ) )       define( 'TBCF_THEME_NAME',       $theme_data->get( 'Name' ) );
if ( ! defined( 'TBCF_THEME_URI' ) )        define( 'TBCF_THEME_URI',        $theme_data->get( 'ThemeURI' ) );
if ( ! defined( 'TBCF_THEME_VERSION' ) )    define( 'TBCF_THEME_VERSION',    $theme_data->get( 'Version' ) );

/**
 * Loads includes.
 */
require_once get_template_directory() . '/tbcf/includes/archives.php';
require_once get_template_directory() . '/tbcf/includes/events.php';
require_once get_template_directory() . '/tbcf/includes/helpers.php';
require_once get_template_directory() . '/tbcf/includes/locations.php';
require_once get_template_directory() . '/tbcf/includes/maps.php';
require_once get_template_directory() . '/tbcf/includes/meta.php';
require_once get_template_directory() . '/tbcf/includes/people.php';
require_once get_template_directory() . '/tbcf/includes/queries.php';
require_once get_template_directory() . '/tbcf/includes/scripts.php';
require_once get_template_directory() . '/tbcf/includes/sermons.php';
require_once get_template_directory() . '/tbcf/includes/styles.php';
require_once get_template_directory() . '/tbcf/includes/taxonomies.php';
require_once get_template_directory() . '/tbcf/includes/widgets.php';
