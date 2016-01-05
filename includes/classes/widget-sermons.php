<?php
/**
 * Sermons Widget
 */

class TBF_Widget_Sermons extends WP_Widget {

	public function __construct() {

		$widget_options = array(
			'description' => __( 'A customizable list of sermons.', 'themebright-framework' ),
			'classname'   => 'tbf-widget tbf-widget--people'
		);

		parent::__construct( 'tbf-sermons', __( 'Sermons', 'themebright-framework' ), $widget_options );

	}

	public function widget( $args, $instance ) {

		$title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Sermons', 'themebright-framework' ) : $instance['title'] );
		$number         = isset( $instance['number'] )         ? absint( $instance['number'] ) : 5;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']   : false;
		$show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']     : true;
		$show_date      = isset( $instance['show_date'] )      ? $instance['show_date']        : false;
		$show_media     = isset( $instance['show_media'] )     ? $instance['show_media']       : true;

		$theme_support = get_theme_support( 'tbf' );
		$theme_support = $theme_support[0]['widgets']['sermons']['fields'];

		$query_args = array(
			'post_type'      => 'ctc_sermon',
			'post_status'    => 'publish',
			'posts_per_page' => $number
		);

		$sermons = new WP_Query( $query_args );

		$override = locate_template( 'widgets/widget-sermons.php' );

		if ( $override ) :

			include $override;

		else :

			echo $args['before_widget'];

				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}

				if ( $sermons->have_posts() ) : ?>

					<ul class="tbf-widget__entries tbf-widget--sermons__entries">
						<?php while ( $sermons->have_posts() ) : $sermons->the_post(); ?>
							<li class="tbf-widget__entry tbf-widget--sermons__entry">
								<?php if ( in_array( 'thumbnail', $theme_support ) && $show_thumbnail && has_post_thumbnail() ) : ?>
									<div class="tbf-widget__entry-thumbnail tbf-widget--sermons__entry-thumbnail">
										<?php the_post_thumbnail( 'large' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( in_array( 'title', $theme_support ) ) : ?>
									<?php the_title( sprintf( '<h4 class="tbf-widget__entry-title tbf-widget--sermons__entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
								<?php endif; ?>

								<div class="tbf-widget__entry-body tbf-widget--sermons__entry-body">
									<?php if ( in_array( 'date', $theme_support ) && $show_date ) : ?>
										<div class="tbf-widget__date tbf-widget--sermons__date"><?php the_time( get_option( 'date_format' ) ); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'excerpt', $theme_support ) && $show_excerpt && get_the_excerpt() ) : ?>
										<div class="tbf-widget__excerpt tbf-widget--sermons__excerpt"><?php the_excerpt(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'media', $theme_support ) && $show_media && ( tbf_sermon_video() || tbf_sermon_audio() || tbf_sermon_pdf() ) ) : ?>
										<div class="tbf-widget__media tbf-widget--sermons__media">
											<?php if ( tbf_sermon_video() ) : ?>
												<a href="<?php echo tbf_sermon_video(); ?>" class="tbf-widget__media-link--video tbf-widget--sermons__media-link--video"><span><?php _e( 'Video', 'themebright-framework' ); ?></span></a>
											<?php endif; ?>

											<?php if ( tbf_sermon_audio() ) : ?>
												<a href="<?php echo tbf_sermon_audio(); ?>" class="tbf-widget__media-link--audio tbf-widget--sermons__media-link--audio"><span><?php _e( 'Audio', 'themebright-framework' ); ?></span></a>
											<?php endif; ?>

											<?php if ( tbf_sermon_pdf() ) : ?>
												<a href="<?php echo tbf_sermon_pdf(); ?>" class="tbf-widget__media-link--pdf tbf-widget--sermons__media-link--pdf"><span><?php _e( 'Transcript', 'themebright-framework' ); ?></span></a>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>

				<?php else : ?>

					<p class="tbf-widget__no-entries-found tbf-widget--sermons__no-entries-found"><?php _e( 'No sermons found.', 'themebright-framework' ); ?></p>

				<?php endif;

			echo $args['after_widget'];

			wp_reset_postdata();

		endif;

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['number']         = (int) $new_instance['number'];
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		$instance['show_excerpt']   = isset( $new_instance['show_excerpt'] )   ? (bool) $new_instance['show_excerpt']   : false;
		$instance['show_date']      = isset( $new_instance['show_date'] )      ? (bool) $new_instance['show_date']      : false;
		$instance['show_media']     = isset( $new_instance['show_media'] )     ? (bool) $new_instance['show_media']     : false;

		return $instance;

	}

	public function form( $instance ) {

		$title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
		$number         = isset( $instance['number'] )         ? absint( $instance['number'] )      : 5;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false;
		$show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : true;
		$show_date      = isset( $instance['show_date'] )      ? (bool) $instance['show_date']      : false;
		$show_media     = isset( $instance['show_media'] )     ? (bool) $instance['show_media']     : true;

		$theme_support = get_theme_support( 'tbf' );
		$theme_support = $theme_support[0]['widgets']['sermons']['fields'];

	?>

		<?php if ( in_array( 'title', $theme_support ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themebright-framework' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'number', $theme_support ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of sermons to show:', 'themebright-framework' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo $number; ?>" min="1" />
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'thumbnail', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_thumbnail ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Show thumbnail', 'themebright-framework' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'excerpt', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Show excerpt', 'themebright-framework' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'date', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Show date', 'themebright-framework' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'media', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_media ); ?> id="<?php echo $this->get_field_id( 'show_media' ); ?>" name="<?php echo $this->get_field_name( 'show_media' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_media' ); ?>"><?php _e( 'Show media links', 'themebright-framework' ); ?></label>
			</p>
		<?php endif; ?>

	<?php

	}
}
