<?php
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
if ( ! defined( 'TBF_VERSION' ) )             define( 'TBF_VERSION',            '1.0.0' );                                            // framework version

/**
 * Framework directory constants.
 */
if ( ! defined( 'TBF_DIR' ) )                 define( 'TBF_DIR',                trailingslashit( basename( dirname( __FILE__ ) ) ) ); // framework directory (where this file is)
if ( ! defined( 'TBF_INC_DIR' ) )             define( 'TBF_INC_DIR',            'includes/' );                                        // framework includes directory
if ( ! defined( 'TBF_ADMIN_DIR' ) )           define( 'TBF_ADMIN_DIR',          TBF_INC_DIR . 'admin/' );                             // framework admin directory
if ( ! defined( 'TBF_CLASS_DIR' ) )           define( 'TBF_CLASS_DIR',          TBF_INC_DIR . 'classes/' );                           // framework classes directory
if ( ! defined( 'TBF_LIB_DIR' ) )             define( 'TBF_LIB_DIR',            TBF_INC_DIR . 'library/' );                           // framework libraries directory
if ( ! defined( 'TBF_ASSETS_DIR' ) )          define( 'TBF_ASSETS_DIR',         TBF_DIR . 'assets/' );                                // framework assets directory
if ( ! defined( 'TBF_CSS_DIR' ) )             define( 'TBF_CSS_DIR',            TBF_ASSETS_DIR . 'css/' );                            // framework CSS directory
if ( ! defined( 'TBF_JS_DIR' ) )              define( 'TBF_JS_DIR',             TBF_ASSETS_DIR . 'js/' );                             // framework JavaScript directory
if ( ! defined( 'TBF_IMG_DIR' ) )             define( 'TBF_IMG_DIR',            TBF_ASSETS_DIR . 'img/' );                            // framework images directory

/**
 * Theme constants.
 */
if ( ! defined( 'TBF_THEME_VERSION' ) )       define( 'TBF_THEME_VERSION',      $theme_data->Version );                               // parent theme version
if ( ! defined( 'TBF_THEME_NAME' ) )          define( 'TBF_THEME_NAME',         $theme_data->Name );                                  // parent theme name, specified in style.css
if ( ! defined( 'TBF_THEME_SLUG' ) )          define( 'TBF_THEME_SLUG',         $theme_data->template );                              // parent theme's folder (theme slug)
if ( ! defined( 'TBF_THEME_AUTHOR' ) )        define( 'TBF_THEME_AUTHOR',       strip_tags( $theme_data->Author ) );                  // parent theme's author
if ( ! defined( 'TBF_THEME_PATH' ) )          define( 'TBF_THEME_PATH',         get_template_directory() );                           // parent theme path
if ( ! defined( 'TBF_THEME_URL' ) )           define( 'TBF_THEME_URL',          get_template_directory_uri() );                       // parent theme URI
if ( ! defined( 'TBF_THEME_CHILD_PATH' ) )    define( 'TBF_THEME_CHILD_PATH',   get_stylesheet_directory() );                         // child theme path
if ( ! defined( 'TBF_THEME_CHILD_URL' ) )     define( 'TBF_THEME_CHILD_URL',    get_stylesheet_directory_uri() );                     // child theme URI

/**
 * Theme directory constants.
 */
if ( ! defined( 'TBF_THEME_INC_DIR' ) )       define( 'TBF_THEME_INC_DIR',      'includes/' );                                        // includes directory
if ( ! defined( 'TBF_THEME_PAGE_TPL_DIR' ) )  define( 'TBF_THEME_PAGE_TPL_DIR', 'page-templates/' );                                  // page templates directory
if ( ! defined( 'TBF_THEME_WIDGETS_DIR' ) )   define( 'TBF_THEME_WIDGETS_DIR',  'widgets/' );                                         // includes directory
if ( ! defined( 'TBF_THEME_ASSETS_DIR' ) )    define( 'TBF_THEME_ASSETS_DIR',   'assets/' );                                          // framework assets directory
if ( ! defined( 'TBF_THEME_CSS_DIR' ) )       define( 'TBF_THEME_CSS_DIR',      TBF_THEME_ASSETS_DIR . 'css/' );                      // framework CSS directory
if ( ! defined( 'TBF_THEME_JS_DIR' ) )        define( 'TBF_THEME_JS_DIR',       TBF_THEME_ASSETS_DIR . 'js/' );                       // framework JavaScript directory
if ( ! defined( 'TBF_THEME_IMG_DIR' ) )       define( 'TBF_THEME_IMG_DIR',      TBF_THEME_ASSETS_DIR . 'img/' );                      // framework images directory
if ( ! defined( 'TBF_THEME_LANG_DIR' ) )      define( 'TBF_THEME_LANG_DIR',     'languages/' );                                       // languages directory

/**
 * Load includes.
 */
require_once TBF_INC_DIR . 'addresses.php';
require_once TBF_INC_DIR . 'breadcrumb.php';
require_once TBF_INC_DIR . 'ctc.php';
require_once TBF_INC_DIR . 'dates.php';
require_once TBF_INC_DIR . 'email.php';
require_once TBF_INC_DIR . 'events.php';
require_once TBF_INC_DIR . 'head.php';
require_once TBF_INC_DIR . 'helpers.php';
require_once TBF_INC_DIR . 'locations.php';
require_once TBF_INC_DIR . 'maps.php';
require_once TBF_INC_DIR . 'meta.php';
require_once TBF_INC_DIR . 'people.php';
require_once TBF_INC_DIR . 'phone.php';
require_once TBF_INC_DIR . 'scripts.php';
require_once TBF_INC_DIR . 'sermons.php';
require_once TBF_INC_DIR . 'shortcodes.php';
require_once TBF_INC_DIR . 'styles.php';
require_once TBF_INC_DIR . 'terms.php';
require_once TBF_INC_DIR . 'urls.php';
require_once TBF_INC_DIR . 'widgets.php';