<?php


/********************************************
 * CONSTANTS
 ********************************************/

/**
 * Get theme data.
 *
 * If child theme, get parent theme data.
 */
$theme_data = wp_get_theme();
$theme_data = is_child_theme() ? wp_get_theme( $theme_data->template ) : $theme_data;

/**
 * Framework constants.
 */
if ( ! defined( 'TBF_VERSION' ) )             define( 'TBF_VERSION',             '1.0.0' );                             // framework version

/**
 * Theme constants.
 */
if ( ! defined( 'TBF_THEME_VERSION' ) )       define( 'TBF_THEME_VERSION',       $theme_data->Version );                // parent theme version
if ( ! defined( 'TBF_THEME_NAME' ) )          define( 'TBF_THEME_NAME',          $theme_data->Name );                   // parent theme name, specified in style.css
if ( ! defined( 'TBF_THEME_SLUG' ) )          define( 'TBF_THEME_SLUG',          $theme_data->template );               // parent theme's folder (theme slug)
if ( ! defined( 'TBF_THEME_AUTHOR' ) )        define( 'TBF_THEME_AUTHOR',        strip_tags( $theme_data->Author ) );   // parent theme's author
if ( ! defined( 'TBF_THEME_PATH' ) )          define( 'TBF_THEME_PATH',          get_template_directory() );            // parent theme path
if ( ! defined( 'TBF_THEME_URL' ) )           define( 'TBF_THEME_URL',           get_template_directory_uri() );        // parent theme URI
if ( ! defined( 'TBF_THEME_CHILD_PATH' ) )    define( 'TBF_THEME_CHILD_PATH',    get_stylesheet_directory() );          // child theme path
if ( ! defined( 'TBF_THEME_CHILD_URL' ) )     define( 'TBF_THEME_CHILD_URL',     get_stylesheet_directory_uri() );      // child theme URI

/**
 * Theme directory constants.
 *
 * Theme and framework structures mirror each other.
 */
if ( ! defined( 'TBF_THEME_INC_DIR' ) )       define( 'TBF_THEME_INC_DIR',      'inc' );                                // includes directory
if ( ! defined( 'TBF_THEME_PAGE_TPL_DIR' ) )  define( 'TBF_THEME_PAGE_TPL_DIR', 'page-templates' );                     // page templates directory
if ( ! defined( 'TBF_THEME_ASSETS_DIR' ) )    define( 'TBF_THEME_ASSETS_DIR',   'assets' );                             // framework stylesheets directory
if ( ! defined( 'TBF_THEME_CSS_DIR' ) )       define( 'TBF_THEME_CSS_DIR',      TBF_THEME_ASSETS_DIR . '/css' );        // framework stylesheets directory
if ( ! defined( 'TBF_THEME_JS_DIR' ) )        define( 'TBF_THEME_JS_DIR',       TBF_THEME_ASSETS_DIR . '/js' );         // framework JavaScript directory
if ( ! defined( 'TBF_THEME_IMG_DIR' ) )       define( 'TBF_THEME_IMG_DIR',      TBF_THEME_ASSETS_DIR . '/img' );        // framework images directory
if ( ! defined( 'TBF_THEME_LANG_DIR' ) )      define( 'TBF_THEME_LANG_DIR',     'languages' );                          // languages directory

/**
 * Framework directory constants.
 *
 * Note use of theme constants. Theme & framework structures mirror each other.
 */
if ( ! defined( 'TBF_DIR' ) )                 define( 'TBF_DIR',                basename( dirname( __FILE__) ) );       // framework directory (where this file is)
if ( ! defined( 'TBF_INC_DIR' ) )             define( 'TBF_INC_DIR',            TBF_DIR . '/inc' );                     // framework includes directory
if ( ! defined( 'TBF_LIB_DIR' ) )             define( 'TBF_LIB_DIR',            TBF_DIR . '/lib' );                     // framework libraries directory
if ( ! defined( 'TBF_ASSETS_DIR' ) )          define( 'TBF_ASSETS_DIR',         TBF_DIR . '/assets' );                  // framework stylesheets directory
if ( ! defined( 'TBF_CSS_DIR' ) )             define( 'TBF_CSS_DIR',            TBF_ASSETS_DIR . '/css' );              // framework stylesheets directory
if ( ! defined( 'TBF_JS_DIR' ) )              define( 'TBF_JS_DIR',             TBF_ASSETS_DIR . '/js' );               // framework JavaScript directory
if ( ! defined( 'TBF_IMG_DIR' ) )             define( 'TBF_IMG_DIR',            TBF_ASSETS_DIR . '/img' );              // framework images directory

/********************************************
 * INCLUDES
 ********************************************/

/**
 * Includes to load.
 */
$tbf_includes = array(
  'always' => array(
    TBF_INC_DIR . '/addresses.php',
    TBF_INC_DIR . '/breadcrumb.php',
    TBF_INC_DIR . '/ctc.php',
    TBF_INC_DIR . '/events.php',
    TBF_INC_DIR . '/helpers.php',
    TBF_INC_DIR . '/locations.php',
    TBF_INC_DIR . '/maps.php',
    TBF_INC_DIR . '/meta.php',
    TBF_INC_DIR . '/people.php',
    TBF_INC_DIR . '/phone-numbers.php',
    TBF_INC_DIR . '/scripts.php',
    TBF_INC_DIR . '/styles.php',
    TBF_INC_DIR . '/terms.php',
    TBF_INC_DIR . '/urls.php'
  ),
  'admin' => array(),
  'frontend' => array()
);

/**
 * Load includes.
 */
tbf_load_includes( $tbf_includes );

/**
 * Include loader.
 *
 * Used by framework above and functions.php for theme-specific includes. If
 * include exists in child theme, it will be used. Otherwise, parent theme
 * file is used.
 */
function tbf_load_includes( $includes ) {

  foreach ( $includes as $condition => $files ) {

    $do_includes = false;

    switch( $condition ) {
      case 'admin':
        if ( is_admin() )
          $do_includes = true;
        break;

      case 'frontend':
        if ( ! is_admin() )
          $do_includes = true;
        break;

      default:
        $do_includes = true;
        break;
    }

    if ( $do_includes ) {
      foreach ( $files as $file ) {
        locate_template( $file, true );
      }
    }

  }

}