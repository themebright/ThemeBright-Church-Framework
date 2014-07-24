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

  function TBF_Widget_Events() {

    $widget_options = array(
      'description' => __( 'A customizable list of events.', 'themebright-framework' ),
      'classname'   => 'tbf-widget tbf-widget-events'
    );

    parent::WP_Widget( 'tbf-events', __( 'Events', 'themebright-framework' ), $widget_options );

  }

  public function widget( $args, $instance ) {

    $title          = apply_filters( 'widget_title', $instance['title'] );
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] ) : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']   : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']     : false;
    $show_date      = isset( $instance['show_date'] )      ? $instance['show_date']        : false;
    $show_time      = isset( $instance['show_time'] )      ? $instance['show_time']        : false;
    $show_venue     = isset( $instance['show_venue'] )     ? $instance['show_venue']       : false;
    $show_address   = isset( $instance['show_address'] )   ? $instance['show_address']     : false;
    $show_map       = isset( $instance['show_map'] )       ? $instance['show_map']         : false;

    $query_args = array(
      'post_type'           => 'ctc_event',
      'post_status'         => 'publish',
      'posts_per_page'      => $number,
      'ignore_sticky_posts' => true
    );

    $events = new WP_Query( apply_filters( 'tbf_widget_events_args', $query_args ) );

    if ( $events->have_posts() ) :

?>

      <?php echo $args['before_widget']; ?>

        <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

        <ul class="tbf-widget-events-list">
          <?php while ( $events->have_posts() ) : $events->the_post(); ?>
            <li class="tbf-widget-entry tbf-widget-events-entry">

              <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                <div class="tbf-widget-entry-thumbnail tbf-widget-events-entry-thumbnail">
                  <?php the_post_thumbnail( 'medium' ); ?>
                </div>
              <?php endif; ?>

              <h4 class="tbf-widget-entry-title tbf-widget-events-entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>

              <div class="tbf-widget-entry-content tbf-widget-events-entry-content">
                <?php if ( $show_excerpt ) the_excerpt(); ?>

                <?php if ( $show_date && tbf_event_date() ) : ?>
                  <p class="tbf-widget-event-date"><?php echo tbf_event_date(); ?></p>
                <?php endif; ?>

                <?php if ( $show_time && tbf_event_time() ) : ?>
                  <p class="tbf-widget-event-time"><?php echo tbf_event_time(); ?></p>
                <?php endif; ?>

                <?php if ( $show_venue && tbf_event_venue() ) : ?>
                  <p class="tbf-widget-event-venue"><?php echo tbf_event_venue(); ?></p>
                <?php endif; ?>

                <?php if ( $show_address ) echo tbf_event_address(); ?></p>

                <?php if ( $show_map ) echo tbf_event_map(); ?>
              </div>
            </li>
          <?php endwhile; ?>
        </ul>

      <?php echo $args['after_widget']; ?>

<?php

    wp_reset_postdata();

    endif;

  }

  function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title']          = strip_tags( $new_instance['title'] );
    $instance['number']         = (int) $new_instance['number'];
    $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
    $instance['show_excerpt']   = isset( $new_instance['show_excerpt'] )   ? (bool) $new_instance['show_excerpt']   : false;
    $instance['show_date']      = isset( $new_instance['show_date'] )      ? (bool) $new_instance['show_date']      : false;
    $instance['show_time']      = isset( $new_instance['show_time'] )      ? (bool) $new_instance['show_time']      : false;
    $instance['show_venue']     = isset( $new_instance['show_venue'] )     ? (bool) $new_instance['show_venue']     : false;
    $instance['show_address']   = isset( $new_instance['show_address'] )   ? (bool) $new_instance['show_address']   : false;
    $instance['show_map']       = isset( $new_instance['show_map'] )       ? (bool) $new_instance['show_map']       : false;

    return $instance;

  }

  public function form( $instance ) {

    $title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] )      : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : false;
    $show_date      = isset( $instance['show_date'] )      ? (bool) $instance['show_date']      : true;
    $show_time      = isset( $instance['show_time'] )      ? (bool) $instance['show_time']      : true;
    $show_venue     = isset( $instance['show_venue'] )     ? (bool) $instance['show_venue']     : true;
    $show_address   = isset( $instance['show_address'] )   ? (bool) $instance['show_address']   : true;
    $show_map       = isset( $instance['show_map'] )       ? (bool) $instance['show_map']       : false;

?>

    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of events to show:', 'themebright-framework' ); ?></label>
      <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Show thumbnail', 'themebright-framework' ); ?></label>
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Show excerpt', 'themebright-framework' ); ?></label>
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'themebright-framework' ); ?></label>
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_time ); ?> id="<?php echo $this->get_field_id( 'show_time' ); ?>" name="<?php echo $this->get_field_name( 'show_time' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_time' ); ?>"><?php _e( 'Show time', 'themebright-framework' ); ?></label>
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_venue ); ?> id="<?php echo $this->get_field_id( 'show_venue' ); ?>" name="<?php echo $this->get_field_name( 'show_venue' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_venue' ); ?>"><?php _e( 'Show venue', 'themebright-framework' ); ?></label>
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_address ); ?> id="<?php echo $this->get_field_id( 'show_address' ); ?>" name="<?php echo $this->get_field_name( 'show_address' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_address' ); ?>"><?php _e( 'Show address', 'themebright-framework' ); ?></label>
    </p>

    <p>
      <input class="checkbox" type="checkbox" <?php checked( $show_map ); ?> id="<?php echo $this->get_field_id( 'show_map' ); ?>" name="<?php echo $this->get_field_name( 'show_map' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_map' ); ?>"><?php _e( 'Show map', 'themebright-framework' ); ?></label>
    </p>

<?php

  }
}