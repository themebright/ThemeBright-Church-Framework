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

  public function __construct() {

    $widget_options = array(
      'classname' => 'tbf-widget tbf-widget-locations',
      'description' => __( 'Locations.', 'themebright-framework' )
    );

    parent::__construct(
      'locations',
      __( 'Locations', 'themebright-framework' ),
      $widget_options
    );

  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Locations', 'themebright-framework' );
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $query_args = array(
      'post_type' => 'ctc_location',
      'posts_per_page' => -1,
      'orderby' => 'menu_order'
    );

    $locations = new WP_Query( apply_filters( 'tbf_widget_locations_args', $query_args ) );

    if ( $locations->have_posts() ) :

?>

      <?php echo $args['before_widget']; ?>
        <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

        <ul class="tbf-widget-locations-list">
          <?php while ( $locations->have_posts() ) : $locations->the_post(); ?>
            <li class="tbf-widget-item tbf-widget-locations-item">

              <?php if ( has_post_thumbnail() ) : ?>
                <div class="tbf-widget-item-thumbnail tbf-widget-locations-item-thumbnail">
                  <?php the_post_thumbnail( 'small' ); ?>
                </div>
              <?php endif; ?>

              <h4 class="tbf-widget-item-title tbf-widget-locations-item-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>

              <div class="tbf-widget-item-content tbf-widget-locations-item-content">
                <?php echo tbf_location_times(); ?>

                <?php echo tbf_location_address(); ?>

                <?php if ( tbf_location_phone() ) : ?>
                  <p class="tbf-widget-location-phone"><?php echo tbf_location_phone(); ?></p>
                <?php endif; ?>
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