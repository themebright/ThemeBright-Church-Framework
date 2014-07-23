<?php
/**
 * Events Widget
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Classes
 */

/**
 * Events widget class.
 */
class TBF_Widget_Events extends WP_Widget {

  public function __construct() {

    $widget_options = array(
      'classname' => 'tbf_widget tbf_widget_events',
      'description' => __( 'Events.', 'themebright-framework' )
    );

    parent::__construct(
      'events',
      __( 'Events', 'themebright-framework' ),
      $widget_options
    );

  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Events', 'themebright-framework' );
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $query_args = array(
      'post_type'      => 'ctc_event'
    );

    $events = new WP_Query( apply_filters( 'tbf_widget_events_args', $query_args ) );

    if ( $events->have_posts() ) :

?>

      <?php echo $args['before_widget']; ?>
        <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

        <ul class="tbf-widget-events-list">
          <?php while ( $events->have_posts() ) : $events->the_post(); ?>
            <li class="tbf-widget-entry tbf-widget-events-entry">

              <?php if ( has_post_thumbnail() ) : ?>
                <div class="tbf-widget-entry-thumbnail tbf-widget-events-entry-thumbnail">
                  <?php the_post_thumbnail( 'medium' ); ?>
                </div>
              <?php endif; ?>

              <h4 class="tbf-widget-entry-title tbf-widget-events-entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>

              <div class="tbf-widget-entry-content tbf-widget-events-entry-content">
                <?php if ( tbf_event_date() ) : ?>
                  <p class="tbf-widget-event-date"><?php echo tbf_event_date(); ?></p>
                <?php endif; ?>

                <?php if ( tbf_event_time() ) : ?>
                  <p class="tbf-widget-event-time"><?php echo tbf_event_time(); ?></p>
                <?php endif; ?>

                <?php if ( tbf_event_venue() ) : ?>
                  <p class="tbf-widget-event-venue"><?php echo tbf_event_venue(); ?></p>
                <?php endif; ?>

                <?php echo tbf_event_address(); ?></p>
              </div>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php echo $args['after_widget']; ?>

<?php

    wp_reset_postdata();

    endif;

  }

  public function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

    return $instance;

  }

  public function form( $instance ) {

    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

?>

    <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
    <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'themebright-framework' ); ?></label></p>

<?php

  }
}