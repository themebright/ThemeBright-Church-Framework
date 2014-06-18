<?php
/**
 * Shortcodes
 *
 * Contains all the default shortcodes in the ThemeBright Framework.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Shortcodes
 */

/**
 * Register shortcodes.
 *
 * Registers all ThemeBright Framework shortcodes.
 * @return type
 */
function tbf_register_shortcodes() {
  add_shortcode( 'events', 'tbf_shortcode_events' );
}
add_action( 'init', 'tbf_register_shortcodes' );

/**
 * Events shortcode.
 *
 * Displays events as specified by parameters.
 *
 * @param array $atts Shortcode attributes.
 * @return string A list of events.
 */
function tbf_shortcode_events( $atts ) {

  extract( shortcode_atts( array(
    'count' => '-1',
    'offset' => '0',
    'order' => 'ASC'
  ), $atts ) );

  global $post;

  $args = array(
    'posts_per_page' => $count,
    'offset' => $offset,
    'orderby' => 'meta_value',
    'order' => $order,
    'meta_key' => '_ctc_event_start_date',
    'post_type' => 'ctc_event',
    'meta_query' => array(
      array(
        'key' => '_ctc_event_end_date',
        'value' => date_i18n( 'Y-m-d' ),
        'compare' => '>=',
        'type' => 'DATE'
      )
    )
  );

  $posts = get_posts( $args );

  if ( $posts ) {
    foreach ( $posts as $post ) { setup_postdata( $post ); ?>

      <h1><?php the_title(); ?></h1>
      <?php tbf_event_date(); ?> @ <?php tbf_event_time(); ?>

    <?php }
  }

}