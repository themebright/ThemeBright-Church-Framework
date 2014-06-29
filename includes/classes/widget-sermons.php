<?php
/**
 * Sermons Widget
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Classes
 */

/**
 * Sermons widget class.
 */
class TBF_Widget_Sermons extends WP_Widget {

  public function __construct() {

    $widget_options = array(
      'classname' => 'tbf_widget tbf_widget_sermons',
      'description' => __( 'Sermons.', 'themebright-framework' )
    );

    parent::__construct(
      'sermons',
      __( 'Sermons', 'themebright-framework' ),
      $widget_options
    );

  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Sermons', 'themebright-framework' );
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $query_args = array(
      'post_type' => 'ctc_sermon',
      'posts_per_page' => -1,
      'orderby' => 'menu_order'
    );

    $sermons = new WP_Query( apply_filters( 'tbf_widget_sermons_args', $query_args ) );

    if ( $sermons->have_posts() ) :

?>

      <?php echo $args['before_widget']; ?>
        <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

        <ul>
          <?php while ( $events->have_posts() ) : $events->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
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