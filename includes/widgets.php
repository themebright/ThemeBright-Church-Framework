<?php
/**
 * Widgets
 *
 * Loads and registers framework widgets.
 */

/**
 * Load individual widget classes.
 */
$widgets = array(
  'widget-events.php',
  'widget-locations.php',
  'widget-people.php',
  'widget-sermons.php'
);

foreach ( $widgets as $widget ) {
  locate_template( TBF_DIR . "/includes/classes/$widget", true );
}

/**
 * Register widgets classes.
 */
function tbf_register_widgets() {

  register_widget( 'TBF_Widget_Events' );
  register_widget( 'TBF_Widget_Locations' );
  register_widget( 'TBF_Widget_People' );
  register_widget( 'TBF_Widget_Sermons' );

}
add_action( 'widgets_init', 'tbf_register_widgets' );