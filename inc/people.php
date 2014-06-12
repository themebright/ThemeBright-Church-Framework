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

  if ( isset( $key ) ) {
    $data = tbf_get_meta( '_ctc_person_' . $key, $post_id );

    return $data;
  }

}

/**
 * Person URLs HTML.
 *
 * Displays the person's URLs in an unordered list.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return string Person's URLs in an unordered list.
 */
function tbf_person_urls_html( $post_id = null ) {

  $urls = tbf_get_person_meta( 'urls', $post_id );

  if ( $urls ) {
    $urls = explode( PHP_EOL, $urls );
    $urls = array_map( 'trim', $urls );

    $html = '<ul class="urls person-urls">';

    foreach ( $urls as $url ) {
      $html .= "<li class='" . tbf_url_class( $url ) . "'><a href='$url'>$url</a></li>";
    }

    $html .= '</ul>';

    echo $html;
  }

}

/**
 * Person groups HTML.
 *
 * Display a person's groups in an unordered list.
 *
 * @param int $post_id Post ID to get data for; null for current post.
 * @return string Person's groups in an unordered list.
 */
function tbf_person_groups_html( $post_id = null ) {

  $groups = tbf_get_terms( 'ctc_person_group', $post_id );

  if ( $groups ) {
    $html = '<ul class="person-groups">';

    foreach ($groups as $group) {
      $html .= "<li><a href='" . get_term_link( $group ) . "'>$group->name</a></li>";
    }

    $html .= '</ul>';

    echo $html;
  }

}