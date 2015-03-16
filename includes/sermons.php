<?php
/**
 * Sermons Functions
 */

/**
 * Returns the sermon meta using tbf_get_meta without need for prefix.
 */
function tbf_get_sermon_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_sermon_' . $key, $post_id );

    return $data;
  }

  return false;

}

/**
 * Returns truthy value if sermon contains full text; falsey if not.
 */
function tbf_sermon_has_full_text( $post_id = null ) {

  return tbf_get_sermon_meta( 'has_full_text', $post_id );

}

/**
 * Returns the sermon video if it exists; false if not.
 */
function tbf_sermon_video( $post_id = null ) {

  $video = tbf_get_sermon_meta( 'video', $post_id );

  if ( ! empty( $video ) ) {
    return $video;
  }

  return false;

}

/**
 * Returns the sermon audio if it exists; false if not.
 */
function tbf_sermon_audio( $post_id = null ) {

  $audio = tbf_get_sermon_meta( 'audio', $post_id );

  if ( ! empty( $audio ) ) {
    return $audio;
  }

  return false;

}

/**
 * Returns the sermon PDF if it exists; false if not.
 */
function tbf_sermon_pdf( $post_id = null ) {

  $pdf = tbf_get_sermon_meta( 'pdf', $post_id );

  if ( ! empty( $pdf ) ) {
    return $pdf;
  }

  return false;

}

/**
 * Returns a sermons's topics if they exist; false if not.
 */
function tbf_sermon_topics( $post_id = null ) {

  $topics = tbf_get_terms( 'ctc_sermon_topic', $post_id );

  if ( ! empty( $topics ) ) {
    return $topics;
  }

  return false;

}

/**
 * Returns a sermons's books if they exist; false if not.
 */
function tbf_sermon_books( $post_id = null ) {

  $books = tbf_get_terms( 'ctc_sermon_book', $post_id );

  if ( ! empty( $books ) ) {
    return $books;
  }

  return false;

}

/**
 * Returns a sermons's series if they exist; false if not.
 */
function tbf_sermon_series( $post_id = null ) {

  $series = tbf_get_terms( 'ctc_sermon_series', $post_id );

  if ( ! empty( $series ) ) {
    return $series;
  }

  return false;

}

/**
 * Returns a sermons's speakers if they exist; false if not.
 */
function tbf_sermon_speakers( $post_id = null ) {

  $speakers = tbf_get_terms( 'ctc_sermon_speaker', $post_id );

  if ( ! empty( $speakers ) ) {
    return $speakers;
  }

  return false;

}

/**
 * Returns a sermons's tags if they exist; false if not.
 */
function tbf_sermon_tags( $post_id = null ) {

  $tags = tbf_get_terms( 'ctc_sermon_tag', $post_id );

  if ( ! empty( $tags ) ) {
    return $tags;
  }

  return false;

}
