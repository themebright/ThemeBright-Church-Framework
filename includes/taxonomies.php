<?php
/**
 * Taxonomy Functions
 */

/**
 * Gets a post's terms from a particular taxonomy.
 */
function tbcf_get_terms( $post_id = null, $tax = null ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	if ( ! empty( $tax ) && ! empty( $post_id ) && has_term( '', $tax, $post_id ) ) {
		$terms = wp_get_post_terms( $post_id, $tax );

		return $terms;
	}

	return false;

}

/**
 * Returns a select with all the terms from a taxonomy if it exists and has terms, false if not.
 */
function tbcf_tax_select( $args = null ) {

	$defaults = array(
		'tax'              => null,
		'class'            => 'select-url',
		'id'               => null,
		'select_current'   => true,
		'title_option'     => true,
		'title_option_val' => ''
	);

	$args = wp_parse_args( $args, $defaults );

	if ( empty( $args['tax'] ) ) {
		return false;
	}

	$terms = get_terms( $args['tax'] );

	if ( is_wp_error( $terms ) || count( $terms ) < 1 ) {
		return false;
	}

	global $wp_query;

	$tax        = get_taxonomy( $args['tax'] );
	$is_archive = isset( $wp_query->query[ $tax->name ] );

	ob_start();

	?>

	<select <?php if ( ! empty( $args['id'] ) ) echo 'id="' . $args['id'] . '"'; ?> class="<?php echo $args['class']; ?>">
		<?php if ( $args['title_option' ] ) : ?>
			<option value="<?php echo esc_attr( $args['title_option_val' ] ); ?>"><?php echo $tax->labels->menu_name; ?> &hellip;</option>
		<?php endif; ?>

		<?php foreach ( $terms as $term ) : ?>
			<option value="<?php echo esc_url( get_term_link( $term ) ); ?>" <?php if ( $args['select_current'] && $is_archive && $wp_query->query[ $tax->name ] === $term->slug ) echo 'selected'; ?>><?php echo $term->name; ?></option>
		<?php endforeach; ?>
	</select>

	<?php

	return ob_get_clean();

}
