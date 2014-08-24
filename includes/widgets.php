<?php

locate_template( TBF_DIR . '/includes/classes/widget-events.php', true );
locate_template( TBF_DIR . '/includes/classes/widget-locations.php', true );
locate_template( TBF_DIR . '/includes/classes/widget-people.php', true );
locate_template( TBF_DIR . '/includes/classes/widget-sermons.php', true );

function tbf_register_widgets() {

  register_widget( 'TBF_Widget_Events' );
  register_widget( 'TBF_Widget_Locations' );
  register_widget( 'TBF_Widget_People' );
  register_widget( 'TBF_Widget_Sermons' );

}
add_action( 'widgets_init', 'tbf_register_widgets' );