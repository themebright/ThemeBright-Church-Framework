<?php
/**
 * People Functions
 *
 * Contains functions used to display people and their meta data.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Get person meta.
 *
 * Gets the person meta using tbf_get_meta without need for prefix.
 *
 * @param string $key Meta key for the data to retrive.
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed The data if it exists; false if not.
 */
function tbf_get_person_meta( $key = null, $post_id = null ) {

  if ( $key ) {
    $data = tbf_get_meta( '_ctc_person_' . $key, $post_id );

    return $data;
  }

}

/**
 * Person position.
 *
 * Displays the person's position.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Position if it exists; false if not.
 */
function tbf_person_position( $post_id = null ) {

  $position = tbf_get_person_meta( 'position', $post_id );

  if ( $position ) {
    return $position;
  }

  return false;

}

/**
 * Person phone.
 *
 * Displays the person's phone if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Person's phone if it exists; false if not.
 */
function tbf_person_phone( $post_id = null ) {

  $phone = tbf_get_person_meta( 'phone', $post_id );

  if ( $phone ) {
    tbf_phone_link( $phone );
  }

  return false;

}

/**
 * Person email.
 *
 * Displays the person's email if it exists; returns false if not.
 *
 * @param type $post_id Post ID to get data for; null for current post.
 * @return mixed Person's email if it exists; false if not.
 */
function tbf_person_email( $post_id = null ) {

  $email = tbf_get_person_meta( 'email', $post_id );

  if ( $email ) {
    return tbf_email_link( $email );
  }

  return false;

}

/**
 * Person URLs.
 *
 * Displays the person's URLs in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Person's URLs if they exist; false if not.
 */
function tbf_person_urls( $post_id = null ) {

  $urls = tbf_get_person_meta( 'urls', $post_id );

  if ( $urls ) {
    $urls = explode( PHP_EOL, $urls );
    $urls = array_map( 'trim', $urls );

    $html = '<ul class="urls person-urls">';

    foreach ( $urls as $url ) {
      $html .= "<li class='" . tbf_url_class( $url ) . "'><a href='$url'>$url</a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}

/**
 * Person groups.
 *
 * Display a person's groups in an unordered list if they exist; returns false if not.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return mixed Groups if they exist; false if not.
 */
function tbf_person_groups( $post_id = null ) {

  $groups = tbf_get_terms( 'ctc_person_group', $post_id );

  if ( $groups ) {
    $html = '<ul class="person-groups">';

    foreach ( $groups as $group ) {
      $html .= "<li><a href='" . get_term_link( $group ) . "'>$group->name</a></li>";
    }

    $html .= '</ul>';

    return $html;
  }

  return false;

}