<?php
/**
 * Widgets
 */

/**
 * Loads and registers widgets classes.
 */
function tbcf_register_widgets() {

	$theme_support = get_theme_support( 'tbcf' );

	if ( isset( $theme_support[0]['widgets'] ) && defined( 'CTC_VERSION' ) ) {
		$theme_support = $theme_support[0]['widgets'];

		if ( array_key_exists( 'events', $theme_support ) || in_array( 'events', $theme_support ) ) {
			require_once get_template_directory() . '/tbcf/includes/classes/widget-events.php';
			register_widget( 'TBCF_Widget_Events' );
		}

		if ( array_key_exists( 'locations', $theme_support ) || in_array( 'locations', $theme_support ) ) {
			require_once get_template_directory() . '/tbcf/includes/classes/widget-locations.php';
			register_widget( 'TBCF_Widget_Locations' );
		}

		if ( array_key_exists( 'people', $theme_support ) || in_array( 'people', $theme_support ) ) {
			require_once get_template_directory() . '/tbcf/includes/classes/widget-people.php';
			register_widget( 'TBCF_Widget_People' );
		}

		if ( array_key_exists( 'sermons', $theme_support ) || in_array( 'sermons', $theme_support ) ) {
			require_once get_template_directory() . '/tbcf/includes/classes/widget-sermons.php';
			register_widget( 'TBCF_Widget_Sermons' );
		}
	}

}
add_action( 'widgets_init', 'tbcf_register_widgets' );
