<?php
/**
 * Widgets
 */

/**
 * Loads and registers widgets classes.
 */
function tbf_register_widgets() {

	$theme_support = get_theme_support( 'tbf' );
	$theme_support = $theme_support[0]['widgets'];

	if ( $theme_support && defined( 'CTC_VERSION' ) ) {
		require_once get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-events.php';
		require_once get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-locations.php';
		require_once get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-people.php';
		require_once get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-sermons.php';

		if ( array_key_exists( 'events',    $theme_support ) ) register_widget( 'TBF_Widget_Events' );
		if ( array_key_exists( 'locations', $theme_support ) ) register_widget( 'TBF_Widget_Locations' );
		if ( array_key_exists( 'people',    $theme_support ) ) register_widget( 'TBF_Widget_People' );
		if ( array_key_exists( 'sermons',   $theme_support ) ) register_widget( 'TBF_Widget_Sermons' );
	}

}
add_action( 'widgets_init', 'tbf_register_widgets' );
