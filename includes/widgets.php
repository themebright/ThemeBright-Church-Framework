<?php

require_once 'classes/widget-locations.php';

function tbf_register_widgets() {

  register_widget( 'TBF_Widget_Locations' );

}
add_action( 'widgets_init', 'tbf_register_widgets' );