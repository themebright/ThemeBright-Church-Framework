<?php
/**
 * Widgets
 */

/**
 * Loads widget classes.
 */
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-events.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-locations.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-people.php' );
require_once( get_template_directory() . '/' . TBF_DIR . '/includes/classes/widget-sermons.php' );

/**
 * Registers widgets classes.
 */
function tbf_register_widgets() {

  register_widget( 'TBF_Widget_Events' );
  register_widget( 'TBF_Widget_Locations' );
  register_widget( 'TBF_Widget_People' );
  register_widget( 'TBF_Widget_Sermons' );

}
add_action( 'widgets_init', 'tbf_register_widgets' );
