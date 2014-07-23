<?php
/**
 * People Widget
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Classes
 */

/**
 * People widget class.
 */
class TBF_Widget_People extends WP_Widget {

  public function __construct() {

    $widget_options = array(
      'classname' => 'tbf_widget tbf_widget_people',
      'description' => __( 'People.', 'themebright-framework' )
    );

    parent::__construct(
      'people',
      __( 'People', 'themebright-framework' ),
      $widget_options
    );

  }

  public function widget( $args, $instance ) {

    if ( ! isset( $args['widget_id'] ) ) {
      $args['widget_id'] = $this->id;
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'People', 'themebright-framework' );
    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $query_args = array(
      'post_type'      => 'ctc_person',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC'
    );

    $people = new WP_Query( apply_filters( 'tbf_widget_people_args', $query_args ) );

    if ( $people->have_posts() ) :

?>

      <?php echo $args['before_widget']; ?>
        <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

        <ul class="tbf-widget-people-list">
          <?php while ( $people->have_posts() ) : $people->the_post(); ?>
            <li class="tbf-widget-entry tbf-widget-people-entry">

              <?php if ( has_post_thumbnail() ) : ?>
                <div class="tbf-widget-entry-thumbnail tbf-widget-people-entry-thumbnail">
                  <?php the_post_thumbnail( 'medium' ); ?>
                </div>
              <?php endif; ?>

              <h4 class="tbf-widget-entry-title tbf-widget-people-entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>

              <div class="tbf-widget-entry-content tbf-widget-people-entry-content">
                <?php if ( tbf_person_position() ) : ?>
                  <p class="tbf-widget-person-position"><?php echo tbf_person_position(); ?></p>
                <?php endif; ?>

                <?php if ( tbf_person_phone() ) : ?>
                  <p class="tbf-widget-person-phone"><?php echo tbf_person_phone(); ?></p>
                <?php endif; ?>

                <?php if ( tbf_person_email() ) : ?>
                  <p class="tbf-widget-person-email"><?php echo tbf_person_email(); ?></p>
                <?php endif; ?>

                <?php echo tbf_person_urls(); ?>
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