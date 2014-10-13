<?php
/**
 * Church Themes Content
 *
 * Handles all neccesary Church Themes Content integrations and customizations.
 */

/**
 * Enables and customizes the the desired Church Themes Content post types and taxonomies.
 */
function tbf_ctc_support() {

  add_theme_support( 'church-theme-content' );

  add_theme_support( 'ctc-sermons', array(
    'taxonomies' => array(
      'ctc_sermon_topic',
      'ctc_sermon_book',
      'ctc_sermon_series',
      'ctc_sermon_speaker',
      'ctc_sermon_tag'
     ),
    'fields' => array(
      '_ctc_sermon_video',
      '_ctc_sermon_audio',
      '_ctc_sermon_pdf'
     ),
    'field_overrides' => array()
  ) );

  add_theme_support( 'ctc-events', array(
    'taxonomies' => array(),
    'fields' => array(
      '_ctc_event_start_date',
      '_ctc_event_end_date',
      '_ctc_event_time',
      '_ctc_event_recurrence',
      '_ctc_event_recurrence_end_date',
      '_ctc_event_venue',
      '_ctc_event_address',
      '_ctc_event_map_lat',
      '_ctc_event_map_lng'
     ),
    'field_overrides' => array()
  ) );

  add_theme_support( 'ctc-people', array(
    'taxonomies' => array(
      'ctc_person_group'
    ),
    'fields' => array(
      '_ctc_person_position',
      '_ctc_person_phone',
      '_ctc_person_email',
      '_ctc_person_urls'
    ),
    'field_overrides' => array(
      '_ctc_person_urls' => array(
        'desc' => __( 'Enter one per line.', 'tbf' )
       )
     )
    ) );

  add_theme_support( 'ctc-locations', array(
    'taxonomies' => array(),
    'fields' => array(
      '_ctc_location_address',
      '_ctc_location_map_lat',
      '_ctc_location_map_lng',
      '_ctc_location_phone',
      '_ctc_location_times'
    ),
    'field_overrides' => array(
      '_ctc_location_times' => array(
        'desc' => __( 'Enter one per line.', 'tbf' )
      )
    )
   ) );

}
add_action( 'after_setup_theme', 'tbf_ctc_support' );