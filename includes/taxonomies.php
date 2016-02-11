<?php
/**
 * Taxonomy Functions
 */

/**
 * Gets a post's terms from a particular taxonomy.
 */
function tbf_get_terms( $post_id = null, $tax = null ) {

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
function tbf_tax_select( $tax = null, $class = 'select-url', $id = null ) {

	if ( empty( $tax ) ) {
		return false;
	}

	$terms = get_terms( $tax );

	if ( is_wp_error( $terms ) || count( $terms ) < 1 ) {
		return false;
	}

	global $wp_query;

	$tax        = get_taxonomy( $tax );
	$is_archive = isset( $wp_query->query[ $tax->name ] );

	ob_start();

	?>

	<select <?php if ( $id ) echo "id='$id'"; ?> class="<?php echo $class; ?>">
		<option><?php echo $tax->labels->menu_name; ?> &hellip;</option>

		<?php foreach ( $terms as $term ) : ?>
			<option value="<?php echo esc_url( get_term_link( $term ) ); ?>" <?php if ( $is_archive && $wp_query->query[ $tax->name ] === $term->slug ) echo 'selected'; ?>><?php echo $term->name; ?></option>
		<?php endforeach; ?>
	</select>

	<?php

	return ob_get_clean();

}
