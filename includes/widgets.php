<?php

require 'classes/widget-events.php';
require 'classes/widget-locations.php';
require 'classes/widget-people.php';
require 'classes/widget-sermons.php';

function tbf_register_widgets() {

  register_widget( 'TBF_Widget_Events' );
  register_widget( 'TBF_Widget_Locations' );
  register_widget( 'TBF_Widget_People' );
  register_widget( 'TBF_Widget_Sermons' );

}
add_action( 'widgets_init', 'tbf_register_widgets' );