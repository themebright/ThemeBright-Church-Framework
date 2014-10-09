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

  function TBF_Widget_People() {

    $widget_options = array(
      'description' => __( 'A customizable list of people.', 'themebright-framework' ),
      'classname'   => 'tbf-widget tbf-widget-people'
    );

    parent::WP_Widget( 'tbf-people', __( 'People', 'themebright-framework' ), $widget_options );

  }

  function widget( $args, $instance ) {

    $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'People', 'themebright-framework' ) : $instance['title'] );
    $group          = isset( $instance['group'] )          ? $instance['group']            : 'all';
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] ) : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']   : false;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']     : false;
    $show_position  = isset( $instance['show_position'] )  ? $instance['show_position']    : false;
    $show_phone     = isset( $instance['show_phone'] )     ? $instance['show_phone']       : false;
    $show_email     = isset( $instance['show_email'] )     ? $instance['show_email']       : false;
    $show_urls      = isset( $instance['show_urls'] )      ? $instance['show_urls']        : false;

    $query_args = array(
      'post_type'        => 'ctc_person',
      'ctc_person_group' => ( $group == 'all' ? '' : $group ),
      'post_status'      => 'publish',
      'posts_per_page'   => $number,
      'order'            => 'ASC',
      'orderby'          => 'menu_order'
    );

    $people = new WP_Query( apply_filters( 'tbf_widget_people_args', $query_args ) );

    $override = locate_template( 'widgets/widget-people.php' );

    if ( $override ) :

      include( $override );

    else :

      echo $args['before_widget'];

        if ( $title ) echo $args['before_title'] . $title . $args['after_title'];

        if ( $people->have_posts() ) : ?>

          <ul class="tbf-widget-people-list">
            <?php while ( $people->have_posts() ) : $people->the_post(); ?>
              <li class="tbf-widget-entry tbf-widget-people-entry">

                <?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
                  <div class="tbf-widget-entry-thumbnail tbf-widget-people-entry-thumbnail">
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                  </div>
                <?php endif; ?>

                <h4 class="tbf-widget-entry-title tbf-widget-people-entry-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>

                <div class="tbf-widget-entry-content tbf-widget-people-entry-content">
                  <?php if ( $show_position && tbf_person_position() ) : ?>
                    <p class="tbf-widget-person-position"><?php echo tbf_person_position(); ?></p>
                  <?php endif; ?>

                  <?php if ( $show_excerpt ) the_excerpt(); ?>

                  <?php if ( $show_phone && tbf_person_phone() ) : ?>
                    <p class="tbf-widget-person-phone"><?php echo tbf_person_phone(); ?></p>
                  <?php endif; ?>

                  <?php if ( $show_email && tbf_person_email() ) : ?>
                    <p class="tbf-widget-person-email"><?php echo tbf_person_email(); ?></p>
                  <?php endif; ?>

                  <?php if ( $show_urls ) echo tbf_person_urls(); ?>
                </div>
              </li>
            <?php endwhile; ?>
          </ul>

        <?php else : ?>

          <p class="tbf-widget-no-entries-found tbf-widget-people-no-entries-found"><?php _e( 'No people found.', 'themebright' ); ?></p>

        <?php endif;

      echo $args['after_widget'];

      wp_reset_postdata();

    endif;

  }

  function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title']          = strip_tags( $new_instance['title'] );
    $instance['group']          = esc_attr( $new_instance['group'] );
    $instance['number']         = (int) $new_instance['number'];
    $instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
    $instance['show_excerpt']   = isset( $new_instance['show_excerpt'] )   ? (bool) $new_instance['show_excerpt']   : false;
    $instance['show_position']  = isset( $new_instance['show_position'] )  ? (bool) $new_instance['show_position']  : false;
    $instance['show_phone']     = isset( $new_instance['show_phone'] )     ? (bool) $new_instance['show_phone']     : false;
    $instance['show_email']     = isset( $new_instance['show_email'] )     ? (bool) $new_instance['show_email']     : false;
    $instance['show_urls']      = isset( $new_instance['show_urls'] )      ? (bool) $new_instance['show_urls']      : false;

    return $instance;

  }

  function form( $instance ) {

    $title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
    $group          = isset( $instance['group'] )          ? $instance['group']                 : 'all';
    $number         = isset( $instance['number'] )         ? absint( $instance['number'] )      : 5;
    $show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
    $show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : false;
    $show_position  = isset( $instance['show_position'] )  ? (bool) $instance['show_position']  : true;
    $show_phone     = isset( $instance['show_phone'] )     ? (bool) $instance['show_phone']     : false;
    $show_email     = isset( $instance['show_email'] )     ? (bool) $instance['show_email']     : true;
    $show_urls      = isset( $instance['show_urls'] )      ? (bool) $instance['show_urls']      : false;

    $theme_support = get_theme_support( 'tbf-widget-people' );
    $theme_support = $theme_support[0];

?>

    <?php if ( $theme_support['options']['title'] ) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['group'] ) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'group' ); ?>"><?php _e( 'Group to show:', 'themebright-framework' ); ?></label>
        <select id="<?php echo $this->get_field_id( 'group' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'group' ); ?>">
          <option value="all" <?php if ( $group ) echo 'selected="selected"'; ?>><?php _e( 'All Groups', 'journey' ); ?></option>
          <?php

          $args = array(
            'orderby' => 'menu_order'
          );

          $groups = get_terms( 'ctc_person_group', $args );

          foreach ( $groups as $option ) {
            echo "<option value='" . esc_attr( $option->slug ) . "' " . ( $group == $option->slug ? 'selected="selected"' : '' ) . ">$option->name</option>";
          }

          ?>
        </select>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['number'] ) : ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of people to show:', 'themebright-framework' ); ?></label>
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

    <?php if ( $theme_support['options']['position'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_position ); ?> id="<?php echo $this->get_field_id( 'show_position' ); ?>" name="<?php echo $this->get_field_name( 'show_position' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_position' ); ?>"><?php _e( 'Show position', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['phone'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_phone ); ?> id="<?php echo $this->get_field_id( 'show_phone' ); ?>" name="<?php echo $this->get_field_name( 'show_phone' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_phone' ); ?>"><?php _e( 'Show phone', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['email'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_email ); ?> id="<?php echo $this->get_field_id( 'show_email' ); ?>" name="<?php echo $this->get_field_name( 'show_email' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_email' ); ?>"><?php _e( 'Show email', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

    <?php if ( $theme_support['options']['urls'] ) : ?>
      <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_urls ); ?> id="<?php echo $this->get_field_id( 'show_urls' ); ?>" name="<?php echo $this->get_field_name( 'show_urls' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_urls' ); ?>"><?php _e( 'Show URLs', 'themebright-framework' ); ?></label>
      </p>
    <?php endif; ?>

<?php

  }
}