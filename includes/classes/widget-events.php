<?php
/**
 * Events Widget
 */

class TBF_Widget_Events extends WP_Widget {

  function TBF_Widget_Events() {

    $widget_options = array(
      'description' => __( 'A customizable list of events.', 'themebright-framework' ),
      'classname'   => 'tbf-widget tbf-widget-events'
    );

    parent::WP_Widget( 'tbf-events', __( 'Events', 'themebright-framework' ), $widget_options );

  }

  function widget( $args, $instance ) {

    $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Events', 'themebright-framework' ) : $instance['title'] );
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] ) : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']   : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']     : false;
    $show_date      = isset( $instance['show_date'] )      ? $instance['show_date']        : false;
    $show_time      = isset( $instance['show_time'] )      ? $instance['show_time']        : false;
    $show_venue     = isset( $instance['show_venue'] )     ? $instance['show_venue']       : false;
    $show_address   = isset( $instance['show_address'] )   ? $instance['show_address']     : false;
    $show_map       = isset( $instance['show_map'] )       ? $instance['show_map']         : false;

    $query_args = array(
      'post_type'      => 'ctc_event',
      'post_status'    => 'publish',
      'posts_per_page' => $number,
      'order'          => 'ASC',
      'orderby'        => 'meta_value',
      'meta_key'       => '_ctc_event_start_date',
      'meta_query'     => array(
        array(
          'key'     => '_ctc_event_end_date',
          'value'   => date_i18n( 'Y-m-d' ),
          'compare' => '>=',
          'type'    => 'DATE'
        )
      )
    );

    $events = new WP_Query( $query_args );

    $override = locate_template( 'widgets/widget-events.php' );

    if ( $override ) :

      include( $override );

    else :

      echo $args['before_widget'];

        if ( $title ) echo $args['before_title'] . $title . $args['after_title'];

        if ( $events->have_posts() ) : ?>

          <ul class="tbf-widget-events-list">
            <?php while ( $events->have_posts() ) : $events->the_post(); ?>
              <li class="tbf-widget-entry tbf-widget-events-entry">

                <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                  <div class="tbf-widget-entry-thumbnail tbf-widget-events-entry-thumbnail">
                    <?php the_post_thumbnail( 'large' ); ?>
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

                  <?php if ( $show_address ) echo tbf_event_address(); ?>

                  <?php if ( $show_map ) echo tbf_event_map(); ?>
                </div>
              </li>
            <?php endwhile; ?>
          </ul>

        <?php else : ?>

          <p class="tbf-widget-no-entries-found tbf-widget-events-no-entries-found"><?php _e( 'No events found.', 'themebright' ); ?></p>

        <?php endif;

      echo $args['after_widget'];

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

  function form( $instance ) {

    $title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] )      : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : false;
    $show_date      = isset( $instance['show_date'] )      ? (bool) $instance['show_date']      : true;
    $show_time      = isset( $instance['show_time'] )      ? (bool) $instance['show_time']      : true;
    $show_venue     = isset( $instance['show_venue'] )     ? (bool) $instance['show_venue']     : true;
    $show_address   = isset( $instance['show_address'] )   ? (bool) $instance['show_address']   : true;
    $show_map       = isset( $instance['show_map'] )       ? (bool) $instance['show_map']       : false;

    $theme_support = get_theme_support( 'tbf-widget-events' );
    $theme_support = $theme_support[0];

?>

    <?php if ( $theme_support['options']['title'] ) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['number'] ) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of events to show:', 'themebright-framework' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo $number; ?>" min="1" />
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['thumbnail'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Show thumbnail', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['excerpt'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Show excerpt', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['date'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['time'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_time ); ?> id="<?php echo $this->get_field_id( 'show_time' ); ?>" name="<?php echo $this->get_field_name( 'show_time' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_time' ); ?>"><?php _e( 'Show time', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['venue'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_venue ); ?> id="<?php echo $this->get_field_id( 'show_venue' ); ?>" name="<?php echo $this->get_field_name( 'show_venue' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_venue' ); ?>"><?php _e( 'Show venue', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['address'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_address ); ?> id="<?php echo $this->get_field_id( 'show_address' ); ?>" name="<?php echo $this->get_field_name( 'show_address' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_address' ); ?>"><?php _e( 'Show address', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['map'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_map ); ?> id="<?php echo $this->get_field_id( 'show_map' ); ?>" name="<?php echo $this->get_field_name( 'show_map' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_map' ); ?>"><?php _e( 'Show map', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

<?php

  }
}
