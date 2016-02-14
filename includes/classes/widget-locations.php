<?php
/**
 * Locations Widget
*/

class TBCF_Widget_Locations extends WP_Widget {

	public function __construct() {

		$widget_options = array(
			'description' => esc_html__( 'A customizable list of locations.', 'tbcf' ),
			'classname'   => 'tbcf-widget tbcf-widget--locations'
		);

		parent::__construct( 'tbcf-locations', esc_html__( 'Locations', 'tbcf' ), $widget_options );

	}

	public function widget( $args, $instance ) {

		$title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Locations', 'tbcf' ) : $instance['title'] );
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']  : true;
		$show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']    : false;
		$show_address   = isset( $instance['show_address'] )   ? $instance['show_address']    : true;
		$show_phone     = isset( $instance['show_phone'] )     ? $instance['show_phone']      : true;
		$show_times     = isset( $instance['show_times'] )     ? $instance['show_times']      : true;
		$show_map       = isset( $instance['show_map'] )       ? (bool) $instance['show_map'] : false;

		$theme_support = get_theme_support( 'tbcf' );
		$theme_support = $theme_support[0]['widgets']['locations']['fields'];

		$locations = tbcf_query_locations();

		$override = locate_template( 'widgets/widget-locations.php' );

		if ( $override ) :

			include $override;

		else :

			echo $args['before_widget'];

				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}

				if ( $locations->have_posts() ) : ?>

					<ul class="tbcf-widget__entries tbcf-widget--locations__entries">
						<?php while ( $locations->have_posts() ) : $locations->the_post(); ?>
							<li class="tbcf-widget__entry tbcf-widget--locations__entry">
								<?php if ( in_array( 'thumbnail', $theme_support ) && $show_thumbnail && has_post_thumbnail() ) : ?>
									<div class="tbcf-widget__entry-thumbnail tbcf-widget--locations__entry-thumbnail">
										<?php the_post_thumbnail( 'large' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( in_array( 'title', $theme_support ) ) : ?>
									<?php the_title( sprintf( '<h4 class="tbcf-widget__entry-title tbcf-widget--locations__entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
								<?php endif; ?>

								<div class="tbcf-widget__entry-body tbcf-widget--locations__entry-body">
									<?php if ( in_array( 'excerpt', $theme_support ) && $show_excerpt && get_the_excerpt() ) : ?>
										<div class="tbcf-widget__excerpt tbcf-widget--locations__excerpt"><?php the_excerpt(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'address', $theme_support ) && $show_address && tbcf_location_address() ) : ?>
										<div class="tbcf-widget__address tbcf-widget--locations__address"><?php echo tbcf_location_address(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'phone', $theme_support ) && $show_phone && tbcf_location_phone() ) : ?>
										<div class="tbcf-widget__phone tbcf-widget--locations__phone"><?php echo tbcf_location_phone(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'times', $theme_support ) && $show_times && tbcf_location_times() ) : ?>
										<div class="tbcf-widget__times tbcf-widget--locations__times"><?php echo tbcf_location_times(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'map', $theme_support ) && $show_map && tbcf_location_map() ) : ?>
										<div class="tbcf-widget__map tbcf-widget--locations__map"><?php echo tbcf_location_map(); ?></div>
									<?php endif; ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>

				<?php else : ?>

					<p class="tbcf-widget__no-entries-found tbcf-widget--locations__no-entries-found"><?php esc_html_e( 'No locations found.', 'tbcf' ); ?></p>

				<?php endif;

			echo $args['after_widget'];

			wp_reset_postdata();

		endif;

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$instance['show_excerpt']   = isset( $new_instance['show_excerpt'] )   ? (bool) $new_instance['show_excerpt']   : false;
		$instance['show_address']   = isset( $new_instance['show_address'] )   ? (bool) $new_instance['show_address']   : false;
		$instance['show_phone']     = isset( $new_instance['show_phone'] )     ? (bool) $new_instance['show_phone']     : false;
		$instance['show_times']     = isset( $new_instance['show_times'] )     ? (bool) $new_instance['show_times']     : false;
		$instance['show_map']       = isset( $new_instance['show_map'] )       ? (bool) $new_instance['show_map']       : false;

		return $instance;

	}

	public function form( $instance ) {

		$title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
		$show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : false;
		$show_address   = isset( $instance['show_address'] )   ? (bool) $instance['show_address']   : true;
		$show_phone     = isset( $instance['show_phone'] )     ? (bool) $instance['show_phone']     : true;
		$show_times     = isset( $instance['show_times'] )     ? (bool) $instance['show_times']     : true;
		$show_map       = isset( $instance['show_map'] )       ? (bool) $instance['show_map']       : false;

		$theme_support = get_theme_support( 'tbcf' );
		$theme_support = $theme_support[0]['widgets']['locations']['fields'];

	?>

		<?php if ( in_array( 'title', $theme_support ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'tbcf' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'thumbnail', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php esc_html_e( 'Show thumbnail', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'excerpt', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php esc_html_e( 'Show excerpt', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'address', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_address ); ?> id="<?php echo $this->get_field_id( 'show_address' ); ?>" name="<?php echo $this->get_field_name( 'show_address' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_address' ); ?>"><?php esc_html_e( 'Show address', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'phone', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_phone ); ?> id="<?php echo $this->get_field_id( 'show_phone' ); ?>" name="<?php echo $this->get_field_name( 'show_phone' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_phone' ); ?>"><?php esc_html_e( 'Show phone', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'times', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_times ); ?> id="<?php echo $this->get_field_id( 'show_times' ); ?>" name="<?php echo $this->get_field_name( 'show_times' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_times' ); ?>"><?php esc_html_e( 'Show times', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'map', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_map ); ?> id="<?php echo $this->get_field_id( 'show_map' ); ?>" name="<?php echo $this->get_field_name( 'show_map' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_map' ); ?>"><?php esc_html_e( 'Show map', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

	<?php

	}
}
