<?php




$theme_data = wp_get_theme();
$theme_data = is_child_theme() ? wp_get_theme( $theme_data->template ) : $theme_data;

if ( ! defined( 'TBF_VERSION' ) )             define( 'TBF_VERSION',             '1.0.0' );                             // framework version

if ( ! defined( 'TBF_THEME_VERSION' ) )       define( 'TBF_THEME_VERSION',       $theme_data->Version );                // parent theme version
if ( ! defined( 'TBF_THEME_NAME' ) )          define( 'TBF_THEME_NAME',          $theme_data->Name );                   // parent theme name, specified in style.css
if ( ! defined( 'TBF_THEME_SLUG' ) )          define( 'TBF_THEME_SLUG',          $theme_data->template );               // parent theme's folder (theme slug)
if ( ! defined( 'TBF_THEME_AUTHOR' ) )        define( 'TBF_THEME_AUTHOR',        strip_tags( $theme_data->Author ) );   // parent theme's author
if ( ! defined( 'TBF_THEME_PATH' ) )          define( 'TBF_THEME_PATH',          get_template_directory() );            // parent theme path
if ( ! defined( 'TBF_THEME_URL' ) )           define( 'TBF_THEME_URL',           get_template_directory_uri() );        // parent theme URI
if ( ! defined( 'TBF_THEME_CHILD_PATH' ) )    define( 'TBF_THEME_CHILD_PATH',    get_stylesheet_directory() );          // child theme path
if ( ! defined( 'TBF_THEME_CHILD_URL' ) )     define( 'TBF_THEME_CHILD_URL',     get_stylesheet_directory_uri() );      // child theme URI

if ( ! defined( 'TBF_THEME_INC_DIR' ) )       define( 'TBF_THEME_INC_DIR',      'inc' );                                // includes directory
if ( ! defined( 'TBF_THEME_PAGE_TPL_DIR' ) )  define( 'TBF_THEME_PAGE_TPL_DIR', 'page-templates' );                     // page templates directory
if ( ! defined( 'TBF_THEME_CSS_DIR' ) )       define( 'TBF_THEME_CSS_DIR',      'styles/css' );                         // stylesheets directory
if ( ! defined( 'TBF_THEME_JS_DIR' ) )        define( 'TBF_THEME_JS_DIR',       'scripts' );                            // JavaScript directory
if ( ! defined( 'TBF_THEME_IMG_DIR' ) )       define( 'TBF_THEME_IMG_DIR',      'images' );                             // images directory
if ( ! defined( 'TBF_THEME_LANG_DIR' ) )      define( 'TBF_THEME_LANG_DIR',     'languages' );                          // languages directory

if ( ! defined( 'TBF_DIR' ) )                 define( 'TBF_DIR',                basename( dirname( __FILE__) ) );       // framework directory (where this file is)
if ( ! defined( 'TBF_INC_DIR' ) )             define( 'TBF_INC_DIR',            TBF_DIR . '/' . TBF_THEME_INC_DIR );    // framework includes directory
if ( ! defined( 'TBF_ADMIN_DIR' ) )           define( 'TBF_ADMIN_DIR',          TBF_DIR . '/' . TBF_THEME_ADMIN_DIR );  // framework admin directory
if ( ! defined( 'TBF_CLASS_DIR' ) )           define( 'TBF_CLASS_DIR',          TBF_DIR . '/' . TBF_THEME_CLASS_DIR );  // framework classes directory
if ( ! defined( 'TBF_LIB_DIR' ) )             define( 'TBF_LIB_DIR',            TBF_DIR . '/' . TBF_THEME_LIB_DIR );    // framework libraries directory
if ( ! defined( 'TBF_CSS_DIR' ) )             define( 'TBF_CSS_DIR',            TBF_DIR . '/' . TBF_THEME_CSS_DIR );    // framework stylesheets directory
if ( ! defined( 'TBF_JS_DIR' ) )              define( 'TBF_JS_DIR',             TBF_DIR . '/' . TBF_THEME_JS_DIR );     // framework JavaScript directory
if ( ! defined( 'TBF_IMG_DIR' ) )             define( 'TBF_IMG_DIR',            TBF_DIR . '/' . TBF_THEME_IMG_DIR );    // framework images directory



require_once 'inc/helpers.php';
require_once 'inc/locations.php';
require_once 'inc/events.php';
require_once 'inc/people.php';
require_once 'inc/theme-support.php';
require_once 'inc/scripts.php';
require_once 'inc/styles.php';
