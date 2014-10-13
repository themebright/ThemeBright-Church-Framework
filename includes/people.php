<?php
/**
 * People Functions
 *
 * Contains functions used to display people and their meta data.
 */

/**
 * Gets the person meta using tbf_get_meta without need for prefix.
 */
function tbf_get_person_meta( $key = null, $post_id = null ) {

  if ( ! empty( $key ) ) {
    $data = tbf_get_meta( '_ctc_person_' . $key, $post_id );

    return $data;
  }

}

/**
 * Displays the person's position if it exists; returns false if not.
 */
function tbf_person_position( $post_id = null ) {

  $position = tbf_get_person_meta( 'position', $post_id );

  if ( ! empty( $position ) ) {
    return $position;
  }

  return false;

}

/**
 * Displays the person's phone if it exists; returns false if not.
 */
function tbf_person_phone( $post_id = null ) {

  $phone = tbf_get_person_meta( 'phone', $post_id );

  if ( ! empty( $phone ) ) {
    return tbf_phone_link( $phone );
  }

  return false;

}

/**
 * Displays the person's email if it exists; returns false if not.
 */
function tbf_person_email( $post_id = null ) {

  $email = tbf_get_person_meta( 'email', $post_id );

  if ( ! empty( $email ) ) {
    return tbf_email_link( $email );
  }

  return false;

}

/**
 * Displays the person's URLs in an <ul> if they exist; returns false if not.
 */
function tbf_person_urls( $post_id = null ) {

  $urls = tbf_get_person_meta( 'urls', $post_id );

  if ( ! empty( $urls ) ) {
    $html = '';

    $urls = explode( PHP_EOL, $urls );
    $urls = array_map( 'trim', $urls );

    $html .= '<ul class="urls person-urls">';

    foreach ( $urls as $url ) {
      $html .= "<li><a href='$url'><span>$url</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Display a person's groups in an <ul> if they exist; returns false if not.
 */
function tbf_person_groups( $post_id = null ) {

  $groups = tbf_get_terms( 'ctc_person_group', $post_id );

  if ( ! empty( $groups ) ) {
    $html = '';

    $html .= '<ul class="person-groups">';

    foreach ( $groups as $group ) {
      $html .= "<li><a href='" . get_term_link( $group ) . "'><span>$group->name</span></a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}