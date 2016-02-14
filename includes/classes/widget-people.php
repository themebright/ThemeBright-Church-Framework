<?php
/**
 * People Widget
 */

class TBCF_Widget_People extends WP_Widget {

	public function __construct() {

		$widget_options = array(
			'description' => esc_html__( 'A customizable list of people.', 'tbcf' ),
			'classname'   => 'tbcf-widget tbcf-widget--people'
		);

		parent::__construct( 'tbcf-people', esc_html__( 'People', 'tbcf' ), $widget_options );

	}

	public function widget( $args, $instance ) {

		$title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'People', 'tbcf' ) : $instance['title'] );
		$group          = isset( $instance['group'] )          ? $instance['group']            : 'all';
		$number         = isset( $instance['number'] )         ? absint( $instance['number'] ) : 5;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail']   : true;
		$show_excerpt   = isset( $instance['show_excerpt'] )   ? $instance['show_excerpt']     : false;
		$show_position  = isset( $instance['show_position'] )  ? $instance['show_position']    : true;
		$show_phone     = isset( $instance['show_phone'] )     ? $instance['show_phone']       : false;
		$show_email     = isset( $instance['show_email'] )     ? $instance['show_email']       : true;
		$show_urls      = isset( $instance['show_urls'] )      ? $instance['show_urls']        : false;

		$theme_support = get_theme_support( 'tbcf' );
		$theme_support = $theme_support[0]['widgets']['people']['fields'];

		$people = tbcf_query_people( array(
			'posts_per_page'   => $number,
			'ctc_person_group' => ( $group === 'all' ? '' : $group ),
			'no_found_rows'    => true
		) );

		$override = locate_template( 'widgets/widget-people.php' );

		if ( $override ) :

			include $override;

		else :

			echo $args['before_widget'];

				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				}

				if ( $people->have_posts() ) : ?>

					<ul class="tbcf-widget__entries tbcf-widget--people__entries">
						<?php while ( $people->have_posts() ) : $people->the_post(); ?>
							<li class="tbcf-widget__entry tbcf-widget--people__entry">
								<?php if ( in_array( 'thumbnail', $theme_support ) && $show_thumbnail && has_post_thumbnail() ) : ?>
									<div class="tbcf-widget__entry-thumbnail tbcf-widget--people__entry-thumbnail">
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									</div>
								<?php endif; ?>

								<?php if ( in_array( 'title', $theme_support ) ) : ?>
									<?php the_title( sprintf( '<h4 class="tbcf-widget__entry-title tbcf-widget--people__entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
								<?php endif; ?>

								<div class="tbcf-widget__entry-body tbcf-widget--people__entry-body">
									<?php if ( in_array( 'position', $theme_support ) && $show_position && tbcf_person_position() ) : ?>
										<div class="tbcf-widget__position tbcf-widget--people__position"><?php echo tbcf_person_position(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'excerpt', $theme_support ) && $show_excerpt && get_the_excerpt() ) : ?>
										<div class="tbcf-widget__excerpt tbcf-widget--people__excerpt"><?php the_excerpt(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'phone', $theme_support ) && $show_phone && tbcf_person_phone() ) : ?>
										<div class="tbcf-widget__phone tbcf-widget--people__phone"><?php echo tbcf_person_phone(); ?></div>
									<?php endif; ?>

									<?php if ( in_array( 'email', $theme_support ) && $show_email && tbcf_person_email() ) : ?>
										<div class="tbcf-widget__email tbcf-widget--people__email">
											<a href="mailto:<?php echo tbcf_person_email(); ?>"><?php echo tbcf_person_email(); ?></a>
										</div>
									<?php endif; ?>

									<?php if ( in_array( 'urls', $theme_support ) && $show_urls && tbcf_person_urls() ) : ?>
										<div class="tbcf-widget__urls tbcf-widget--people__urls">
											<?php foreach ( tbcf_person_urls() as $url ) : ?>
												<a href="<?php echo $url; ?>"><?php echo $url; ?></a>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>

				<?php else : ?>

					<p class="tbcf-widget__no-entries-found tbcf-widget--people__no-entries-found"><?php esc_html_e( 'No people found.', 'tbcf' ); ?></p>

				<?php endif;

			echo $args['after_widget'];

			wp_reset_postdata();

		endif;

	}

	public function update( $new_instance, $old_instance ) {

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

	public function form( $instance ) {

		$title          = isset( $instance['title'] )          ? esc_attr( $instance['title'] )     : '';
		$group          = isset( $instance['group'] )          ? $instance['group']                 : 'all';
		$number         = isset( $instance['number'] )         ? absint( $instance['number'] )      : 5;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : true;
		$show_excerpt   = isset( $instance['show_excerpt'] )   ? (bool) $instance['show_excerpt']   : false;
		$show_position  = isset( $instance['show_position'] )  ? (bool) $instance['show_position']  : true;
		$show_phone     = isset( $instance['show_phone'] )     ? (bool) $instance['show_phone']     : false;
		$show_email     = isset( $instance['show_email'] )     ? (bool) $instance['show_email']     : true;
		$show_urls      = isset( $instance['show_urls'] )      ? (bool) $instance['show_urls']      : false;

		$theme_support = get_theme_support( 'tbcf' );
		$theme_support = $theme_support[0]['widgets']['people']['fields'];

	?>

		<?php if ( in_array( 'title', $theme_support ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'tbcf' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'group', $theme_support ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'group' ); ?>"><?php esc_html_e( 'Group to show:', 'tbcf' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'group' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'group' ); ?>">
					<option value="all" <?php if ( $group ) echo 'selected="selected"'; ?>><?php esc_html_e( 'All Groups', 'tbcf' ); ?></option>
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

		<?php if ( in_array( 'number', $theme_support ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of people to show:', 'tbcf' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo $number; ?>" min="1" />
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

		<?php if ( in_array( 'position', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_position ); ?> id="<?php echo $this->get_field_id( 'show_position' ); ?>" name="<?php echo $this->get_field_name( 'show_position' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_position' ); ?>"><?php esc_html_e( 'Show position', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'phone', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_phone ); ?> id="<?php echo $this->get_field_id( 'show_phone' ); ?>" name="<?php echo $this->get_field_name( 'show_phone' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_phone' ); ?>"><?php esc_html_e( 'Show phone', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'email', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_email ); ?> id="<?php echo $this->get_field_id( 'show_email' ); ?>" name="<?php echo $this->get_field_name( 'show_email' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_email' ); ?>"><?php esc_html_e( 'Show email', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

		<?php if ( in_array( 'urls', $theme_support ) ) : ?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $show_urls ); ?> id="<?php echo $this->get_field_id( 'show_urls' ); ?>" name="<?php echo $this->get_field_name( 'show_urls' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_urls' ); ?>"><?php esc_html_e( 'Show URLs', 'tbcf' ); ?></label>
			</p>
		<?php endif; ?>

	<?php

	}
}
