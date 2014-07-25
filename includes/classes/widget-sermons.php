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

  function TBF_Widget_Sermons() {

    $widget_options = array(
      'description' => __( 'A customizable list of sermons.', 'themebright-framework' ),
      'classname'   => 'tbf-widget tbf-widget-people'
    );

    parent::WP_Widget( 'tbf-sermons', __( 'Sermons', 'themebright-framework' ), $widget_options );

  }

  function widget( $args, $instance ) {

    $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Sermons', 'themebright-framework' ) : $instance['title'] );
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] ) : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']   : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']     : false;
    $show_date      = isset( $instance['show_date'] )      ? $instance['show_date']        : false;
    $show_media     = isset( $instance['show_media'] )     ? $instance['show_media']       : false;

    $query_args = array(
      'post_type'      => 'ctc_sermon',
      'post_status'    => 'publish',
      'posts_per_page' => $number
    );

    $sermons = new WP_Query( apply_filters( 'tbf_widget_sermons_args', $query_args ) );

    if ( $sermons->have_posts() ) :

?>

      <?php echo $args['before_widget']; ?>

        <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

        <ul class="tbf-widget-sermons-list">
          <?php while ( $sermons->have_posts() ) : $sermons->the_post(); ?>
            <li class="tbf-widget-entry tbf-widget-sermons-entry">

              <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                <div class="tbf-widget-entry-thumbnail tbf-widget-sermons-entry-thumbnail">
                  <?php the_post_thumbnail( 'medium' ); ?>
                </div>
              <?php endif; ?>

              <h4 class="tbf-widget-entry-title tbf-widget-sermons-entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>

              <div class="tbf-widget-entry-content tbf-widget-sermons-entry-content">
                <?php if ( $show_excerpt ) the_excerpt(); ?>

                <?php if ( $show_media ) : ?>
                  <?php if ( $show_date ) : ?>
                    <p class="tbf-widget-sermon-date">
                      <?php the_time() ?>
                    </p>
                  <?php endif; ?>

                  <?php if ( tbf_sermon_video() ) : ?>
                    <p class="tbf-widget-sermon-video">
                      <a href="<?php echo tbf_sermon_video(); ?> ?>"><?php _e( 'Video', 'themebright-framework' ); ?></a>
                    </p>
                  <?php endif; ?>

                  <?php if ( tbf_sermon_audio() ) : ?>
                    <p class="tbf-widget-sermon-audio">
                      <a href="<?php echo tbf_sermon_audio(); ?> ?>"><?php _e( 'Audio', 'themebright-framework' ); ?></a>
                    </p>
                  <?php endif; ?>

                  <?php if ( tbf_sermon_pdf() ) : ?>
                    <p class="tbf-widget-sermon-pdf">
                      <a href="<?php echo tbf_sermon_pdf(); ?> ?>"><?php _e( 'PDF', 'themebright-framework' ); ?></a>
                    </p>
                  <?php endif; ?>
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

  function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title']          = strip_tags( $new_instance['title'] );
    $instance['number']         = (int) $new_instance['number'];
    $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
    $instance['show_excerpt']   = isset( $new_instance['show_excerpt'] )   ? (bool) $new_instance['show_excerpt']   : false;
    $instance['show_date']      = isset( $new_instance['show_date'] )      ? (bool) $new_instance['show_date']      : false;
    $instance['show_media']     = isset( $new_instance['show_media'] )     ? (bool) $new_instance['show_media']     : false;

    return $instance;

  }

  function form( $instance ) {

    $title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] )      : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : true;
    $show_date      = isset( $instance['show_date'] )      ? (bool) $instance['show_date']      : false;
    $show_media     = isset( $instance['show_media'] )     ? (bool) $instance['show_media']     : true;

?>

    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
      <input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of events to show:', 'themebright-framework' ); ?></label>
      <input id="<?php echo $this->get_field_id( 'number' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo $number; ?>" min="1" />
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
      <input class="checkbox" type="checkbox" <?php checked( $show_media ); ?> id="<?php echo $this->get_field_id( 'show_media' ); ?>" name="<?php echo $this->get_field_name( 'show_media' ); ?>" />
      <label for="<?php echo $this->get_field_id( 'show_media' ); ?>"><?php _e( 'Show media links', 'themebright-framework' ); ?></label>
    </p>

<?php

  }
}