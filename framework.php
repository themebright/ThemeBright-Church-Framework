<?php
/**
 * ThemeBright Framework.
 */

/**
 * Get theme data.
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
locate_template( TBF_DIR . '/includes/addresses.php', true );
locate_template( TBF_DIR . '/includes/breadcrumb.php', true );
locate_template( TBF_DIR . '/includes/ctc.php', true );
locate_template( TBF_DIR . '/includes/dates.php', true );
locate_template( TBF_DIR . '/includes/email.php', true );
locate_template( TBF_DIR . '/includes/events.php', true );
locate_template( TBF_DIR . '/includes/head.php', true );
locate_template( TBF_DIR . '/includes/helpers.php', true );
locate_template( TBF_DIR . '/includes/locations.php', true );
locate_template( TBF_DIR . '/includes/maps.php', true );
locate_template( TBF_DIR . '/includes/meta.php', true );
locate_template( TBF_DIR . '/includes/people.php', true );
locate_template( TBF_DIR . '/includes/phone.php', true );
locate_template( TBF_DIR . '/includes/scripts.php', true );
locate_template( TBF_DIR . '/includes/sermons.php', true );
locate_template( TBF_DIR . '/includes/shortcodes.php', true );
locate_template( TBF_DIR . '/includes/styles.php', true );
locate_template( TBF_DIR . '/includes/terms.php', true );
locate_template( TBF_DIR . '/includes/urls.php', true );
locate_template( TBF_DIR . '/includes/widgets.php', true );