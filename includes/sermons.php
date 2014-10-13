<?php
/**
 * Sermons Functions
 *
 * Contains functions used to display sermons and their meta data.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Get sermon meta.
 *
 * Gets the sermon meta using tbf_get_meta without need for prefix.
 *
 * @param string $key Meta key for the data to retrive.
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed The data if it exists; false if not.
 */
function tbf_get_sermon_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_sermon_' . $key, $post_id );

    return $data;
  }

}

/**
 * Sermon video.
 *
 * Displays the sermon video if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Sermon video if it exists; false if not.
 */
function tbf_sermon_video( $post_id = null ) {

  $video = tbf_get_sermon_meta( 'video', $post_id );

  if ( ! empty( $video ) ) {
    return $video;
  }

  return false;

}

/**
 * Sermon audio.
 *
 * Displays the sermon audio if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Sermon audio if it exists; false if not.
 */
function tbf_sermon_audio( $post_id = null ) {

  $audio = tbf_get_sermon_meta( 'audio', $post_id );

  if ( ! empty( $audio ) ) {
    return $audio;
  }

  return false;

}

/**
 * Sermon PDF.
 *
 * Displays the sermon PDF if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Sermon PDF if it exists; false if not.
 */
function tbf_sermon_pdf( $post_id = null ) {

  $pdf = tbf_get_sermon_meta( 'pdf', $post_id );

  if ( ! empty( $pdf ) ) {
    return $pdf;
  }

  return false;

}

/**
 * Sermon topics.
 *
 * Display a sermons's topics in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Topics if they exist; false if not.
 */
function tbf_sermon_topics( $post_id = null ) {

  $topics = tbf_get_terms( 'ctc_sermon_topic', $post_id );

  if ( ! empty( $topics ) ) {
    $html = '';

    $html .= '<ul class="sermon-topics">';

    foreach ( $topics as $topic ) {
      $html .= "<li><a href='" . get_term_link( $topic ) . "'><span>$topic->name</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Sermon books.
 *
 * Display a sermons's books in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Books if they exist; false if not.
 */
function tbf_sermon_books( $post_id = null ) {

  $books = tbf_get_terms( 'ctc_sermon_book', $post_id );

  if ( ! empty( $books ) ) {
    $html = '';

    $html .= '<ul class="sermon-books">';

    foreach ( $books as $book ) {
      $html .= "<li><a href='" . get_term_link( $book ) . "'><span>$book->name</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Sermon series.
 *
 * Display a sermons's series in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Series if they exist; false if not.
 */
function tbf_sermon_series( $post_id = null ) {

  $series = tbf_get_terms( 'ctc_sermon_series', $post_id );

  if ( ! empty( $series ) ) {
    $html = '';

    $html .= '<ul class="sermon-series">';

    foreach ( $series as $single_series ) {
      $html .= "<li><a href='" . get_term_link( $single_series ) . "'><span>$single_series->name</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Sermon speakers.
 *
 * Display a sermons's speakers in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Speakers if they exist; false if not.
 */
function tbf_sermon_speakers( $post_id = null ) {

  $speakers = tbf_get_terms( 'ctc_sermon_speaker', $post_id );

  if ( ! empty( $speakers ) ) {
    $html = '';

    $html .= '<ul class="sermon-speakers">';

    foreach ( $speakers as $speaker ) {
      $html .= "<li><a href='" . get_term_link( $speaker ) . "'><span>$speaker->name</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Sermon tags.
 *
 * Display a sermons's tags in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Tags if they exist; false if not.
 */
function tbf_sermon_tags( $post_id = null ) {

  $tags = tbf_get_terms( 'ctc_sermon_tag', $post_id );

  if ( ! empty( $tags ) ) {
    $html = '';

    $html .= '<ul class="sermon-tags">';

    foreach ( $tags as $tag ) {
      $html .= "<li><a href='" . get_term_link( $tag ) . "'><span>$tag->name</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}