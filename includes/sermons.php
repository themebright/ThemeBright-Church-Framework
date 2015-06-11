<?php
/**
 * Sermons Functions
 */

/**
 * Returns the sermon meta using tbf_get_meta without need for prefix.
 */
function tbf_get_sermon_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbf_get_meta( $post_id, '_ctc_sermon_' . $key );

		return $data;
	}

	return false;

}

/**
 * Returns truthy value if sermon contains full text; falsey if not.
 */
function tbf_sermon_has_full_text( $post_id = null ) {

	return tbf_get_sermon_meta( $post_id, 'has_full_text' );

}

/**
 * Returns the sermon video if it exists; false if not.
 */
function tbf_sermon_video( $post_id = null ) {

	$video = tbf_get_sermon_meta( $post_id, 'video' );

	if ( ! empty( $video ) ) {
		return $video;
	}

	return false;

}

/**
 * Returns the sermon audio if it exists; false if not.
 */
function tbf_sermon_audio( $post_id = null ) {

	$audio = tbf_get_sermon_meta( $post_id, 'audio' );

	if ( ! empty( $audio ) ) {
		return $audio;
	}

	return false;

}

/**
 * Returns the sermon PDF if it exists; false if not.
 */
function tbf_sermon_pdf( $post_id = null ) {

	$pdf = tbf_get_sermon_meta( $post_id, 'pdf' );

	if ( ! empty( $pdf ) ) {
		return $pdf;
	}

	return false;

}

/**
 * Returns a sermons's topics if they exist; false if not.
 */
function tbf_sermon_topics( $post_id = null ) {

	$topics = tbf_get_terms( $post_id, 'ctc_sermon_topic' );

	if ( ! empty( $topics ) ) {
		return $topics;
	}

	return false;

}

/**
 * Returns a sermons's books if they exist; false if not.
 */
function tbf_sermon_books( $post_id = null ) {

	$books = tbf_get_terms( $post_id, 'ctc_sermon_book' );

	if ( ! empty( $books ) ) {
		return $books;
	}

	return false;

}

/**
 * Returns a sermons's series if they exist; false if not.
 */
function tbf_sermon_series( $post_id = null ) {

	$series = tbf_get_terms( $post_id, 'ctc_sermon_series' );

	if ( ! empty( $series ) ) {
		return $series;
	}

	return false;

}

/**
 * Returns a sermons's speakers if they exist; false if not.
 */
function tbf_sermon_speakers( $post_id = null ) {

	$speakers = tbf_get_terms( $post_id, 'ctc_sermon_speaker' );

	if ( ! empty( $speakers ) ) {
		return $speakers;
	}

	return false;

}

/**
 * Returns a sermons's tags if they exist; false if not.
 */
function tbf_sermon_tags( $post_id = null ) {

	$tags = tbf_get_terms( $post_id, 'ctc_sermon_tag' );

	if ( ! empty( $tags ) ) {
		return $tags;
	}

	return false;

}
