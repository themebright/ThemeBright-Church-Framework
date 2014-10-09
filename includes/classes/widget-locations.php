<?php
/**
 * Locations Widget
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Classes
 */

/**
 * Locations widget class.
 */
class TBF_Widget_Locations extends WP_Widget {

  function TBF_Widget_Locations() {

    $widget_options = array(
      'description' => __( 'A customizable list of locations.', 'themebright-framework' ),
      'classname'   => 'tbf-widget tbf-widget-locations'
    );

    parent::WP_Widget( 'tbf-locations', __( 'Locations', 'themebright-framework' ), $widget_options );

  }

  function widget( $args, $instance ) {

    $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Locations', 'themebright-framework' ) : $instance['title'] );
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']   : false;
    $show_address   = isset( $instance['show_address'] )   ? $instance['show_address']   : false;
    $show_phone     = isset( $instance['show_phone'] )     ? $instance['show_phone']     : false;
    $show_times     = isset( $instance['show_times'] )     ? $instance['show_times']     : false;

    $query_args = array(
      'post_type'      => 'ctc_location',
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'order'          => 'ASC',
      'orderby'        => 'menu_order'
    );

    $locations = new WP_Query( apply_filters( 'tbf_widget_locations_args', $query_args ) );

    $override = locate_template( 'widgets/widget-locations.php' );

    if ( $override ) :

      include( $override );

    else :

      echo $args['before_widget'];

        if ( $title ) echo $args['before_title'] . $title . $args['after_title'];

        if ( $locations->have_posts() ) : ?>

          <ul class="tbf-widget-locations-list">
            <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>
              <li class="tbf-widget-entry tbf-widget-locations-entry">

                <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                  <div class="tbf-widget-entry-thumbnail tbf-widget-locations-entry-thumbnail">
                    <?php the_post_thumbnail( 'large' ); ?>
                  </div>
                <?php endif; ?>

                <h4 class="tbf-widget-entry-title tbf-widget-locations-entry-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>

                <div class="tbf-widget-entry-content tbf-widget-locations-entry-content">
                  <?php if ( $show_excerpt ) the_excerpt(); ?>

                  <?php if ( $show_times ) echo tbf_location_times(); ?>

                  <?php if ( $show_address ) echo tbf_location_address(); ?>

                  <?php if ( $show_phone && tbf_location_phone() ) : ?>
                    <p class="tbf-widget-location-phone"><?php echo tbf_location_phone(); ?></p>
                  <?php endif; ?>
                </div>
              </li>
            <?php endwhile; ?>
          </ul>

        <?php else : ?>

          <p class="tbf-widget-no-entries-found tbf-widget-locations-no-entries-found"><?php _e( 'No locations found.', 'themebright' ); ?></p>

        <?php endif;

      echo $args['after_widget'];

      wp_reset_postdata();

    endif;

  }

  function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title']          = strip_tags( $new_instance['title'] );
    $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
    $instance['show_excerpt']   = isset( $new_instance['show_excerpt'] )   ? (bool) $new_instance['show_excerpt']   : false;
    $instance['show_address']   = isset( $new_instance['show_address'] )   ? (bool) $new_instance['show_address']   : false;
    $instance['show_phone']     = isset( $new_instance['show_phone'] )     ? (bool) $new_instance['show_phone']     : false;
    $instance['show_times']     = isset( $new_instance['show_times'] )     ? (bool) $new_instance['show_times']     : false;

    return $instance;

  }

  function form( $instance ) {

    $title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : false;
    $show_address   = isset( $instance['show_address'] )   ? (bool) $instance['show_address']   : true;
    $show_phone     = isset( $instance['show_phone'] )     ? (bool) $instance['show_phone']     : true;
    $show_times     = isset( $instance['show_times'] )     ? (bool) $instance['show_times']     : true;

    $theme_support = get_theme_support( 'tbf-widget-locations' );
    $theme_support = $theme_support[0];

?>

    <?php if ( $theme_support['options']['title'] ) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
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

    <?php if ( $theme_support['options']['address'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_address ); ?> id="<?php echo $this->get_field_id( 'show_address' ); ?>" name="<?php echo $this->get_field_name( 'show_address' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_address' ); ?>"><?php _e( 'Show address', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['phone'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_phone ); ?> id="<?php echo $this->get_field_id( 'show_phone' ); ?>" name="<?php echo $this->get_field_name( 'show_phone' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_phone' ); ?>"><?php _e( 'Show phone', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['times'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_times ); ?> id="<?php echo $this->get_field_id( 'show_times' ); ?>" name="<?php echo $this->get_field_name( 'show_times' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_times' ); ?>"><?php _e( 'Show times', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

<?php

  }
}