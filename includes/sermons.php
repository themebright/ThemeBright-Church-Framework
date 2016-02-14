<?php
/**
 * Sermons Functions
 */

/**
 * Returns the sermon meta using tbcf_get_meta without need for prefix.
 */
function tbcf_get_sermon_meta( $post_id = null, $key = null ) {

	if ( ! empty( $key ) ) {
		$data = tbcf_get_meta( $post_id, '_ctc_sermon_' . $key );

		return $data;
	}

	return false;

}

/**
 * Returns truthy value if sermon contains full text; falsey if not.
 */
function tbcf_sermon_has_full_text( $post_id = null ) {

	return tbcf_get_sermon_meta( $post_id, 'has_full_text' );

}

/**
 * Returns the sermon video if it exists; false if not.
 */
function tbcf_sermon_video( $post_id = null ) {

	$video = tbcf_get_sermon_meta( $post_id, 'video' );

	if ( ! empty( $video ) ) {
		return $video;
	}

	return false;

}

/**
 * Returns the sermon audio if it exists; false if not.
 */
function tbcf_sermon_audio( $post_id = null ) {

	$audio = tbcf_get_sermon_meta( $post_id, 'audio' );

	if ( ! empty( $audio ) ) {
		return $audio;
	}

	return false;

}

/**
 * Returns the sermon PDF if it exists; false if not.
 */
function tbcf_sermon_pdf( $post_id = null ) {

	$pdf = tbcf_get_sermon_meta( $post_id, 'pdf' );

	if ( ! empty( $pdf ) ) {
		return $pdf;
	}

	return false;

}

/**
 * Returns a sermons's topics if they exist; false if not.
 */
function tbcf_sermon_topics( $post_id = null ) {

	$topics = tbcf_get_terms( $post_id, 'ctc_sermon_topic' );

	if ( ! empty( $topics ) ) {
		return $topics;
	}

	return false;

}

/**
 * Returns a sermons's books if they exist; false if not.
 */
function tbcf_sermon_books( $post_id = null ) {

	$books = tbcf_get_terms( $post_id, 'ctc_sermon_book' );

	if ( ! empty( $books ) ) {
		return $books;
	}

	return false;

}

/**
 * Returns a sermons's series if they exist; false if not.
 */
function tbcf_sermon_series( $post_id = null ) {

	$series = tbcf_get_terms( $post_id, 'ctc_sermon_series' );

	if ( ! empty( $series ) ) {
		return $series;
	}

	return false;

}

/**
 * Returns a sermons's speakers if they exist; false if not.
 */
function tbcf_sermon_speakers( $post_id = null ) {

	$speakers = tbcf_get_terms( $post_id, 'ctc_sermon_speaker' );

	if ( ! empty( $speakers ) ) {
		return $speakers;
	}

	return false;

}

/**
 * Returns a sermons's tags if they exist; false if not.
 */
function tbcf_sermon_tags( $post_id = null ) {

	$tags = tbcf_get_terms( $post_id, 'ctc_sermon_tag' );

	if ( ! empty( $tags ) ) {
		return $tags;
	}

	return false;

}
