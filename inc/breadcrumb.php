<?php
/**
 * Breadcrumb Functions
 *
 * Contains functions used to build and display breadcrumbs.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Breadcrumb.
 *
 * Builds and displays a breadcrumb based on the current page/post/archive being displayed.
 *
 * @param string $sep Character to use a divider between crumbs.
 * @return string Breadcrumb HTML.
 */
function tbf_breadcrumb( $sep = '&rsaquo;' ) {

  // we're gonna need this
  global $post;

  // store the current post type
  $post_type = get_post_type();

  // store the queried object
  $queried_object = get_queried_object();

  // store the post type object
  $post_type_obj = get_post_type_object( $post_type );

  // store all the Church Themes Content post types
  $ctc_post_types = array(
    'ctc_event',
    'ctc_location',
    'ctc_person',
    'ctc_sermon'
  );

  // store all the Church Themes Content taxonomies
  $ctc_post_taxonomies = array(
      'ctc_sermon_topic',
      'ctc_sermon_book',
      'ctc_sermon_series',
      'ctc_sermon_speaker',
      'ctc_sermon_tag',
      'ctc_person_group'
  );

  // store the home page
  $home_page = get_option( 'page_on_front' );

  // store the posts page
  $posts_page = get_option( 'page_for_posts' );

  // the HTML we'll use as our sep
  $sep = "<span class='sep'>$sep</span>";

  // open the breadcrumbs div
  $html  = '<div class="breadcrumb">';

  // display home link
  if ( get_option( 'show_on_front' ) == 'page' ) {
    $html .= '<a href="' . home_url( '/' ) . '" class="crumb first">' . get_the_title( $home_page ) . '</a>';
  } else {
    $html .= '<a href="' . home_url( '/' ) . '" class="crumb first">' . __( 'Home', 'tb_framework' ) . '</a>';
  }

  // if posts page is set and we're there, display link
  if ( $posts_page > 0 && is_home() ) {
    $html .= $sep;
    $html .= '<span class="crumb">' . get_the_title( $posts_page ) . '</span>';
  }

  // only continue if it's not a 404
  if ( ! is_404() ) {

    // it's an archives page
    if ( is_archive() ) {

      // it's an archive for one of the CTC taxonomies
      if ( is_tax( $ctc_post_taxonomies ) ) {

        // display link to post type archive
        $html .= $sep;
        $html .= "<a href='" . get_post_type_archive_link( $post_type ) . "' class='crumb'>$post_type_obj->label</a>";

      // display posts page link for standard posts
      } elseif ( $posts_page ) {
        $html .= $sep;
        $html .= '<a href="' . get_permalink( $posts_page ) . '" class="crumb">' . get_the_title( $posts_page ) . '</a>';
      }

      // it's an author archive
      if ( is_author() ) {

        $html .= $sep;
        $html .= "<span class='crumb last'>$queried_object->user_nicename</span>";

      // it's a date archive
      } elseif ( is_date() ) {

        $html .= $sep;

        if ( is_day() ) {
          $html .= '<span class="crumb last">' . get_the_date() . '</span>';
        } elseif ( is_month() ) {
          $html .= '<span class="crumb last">' . get_the_date( 'F Y' ) . '</span>';
        } elseif ( is_year() ) {
          $html .= '<span class="crumb last">' . get_the_date( 'Y' ) . '</span>';
        }

      // it's another type of archive
      } else {

        $html .= $sep;
        $html .= "<span class='crumb last'>$queried_object->name</span>";

      }

    }

    // it's a search results page
    if ( is_search() ) {
      $html .= $sep;
      $html .= '<span class="crumb last">' . get_search_query() . '</span>';
    }

    // prefixes for single posts
    if ( is_single() ) {

      // are we dealing with a standard post?
      if ( $post_type == 'post' ) {

        // if a posts page is setup, include it in the breacrumb
        if ( $posts_page ) {
          $html .= $sep;
          $html .= '<a href="' . get_permalink( $posts_page ) . '" class="crumb">' . get_the_title( $posts_page ) . '</a>';
        }

      // or one of the Church Themes Content post types?
      } elseif ( is_singular( $ctc_post_types ) ) {

        // display link to post type archive in the breadcrumb
        $html .= $sep;
        $html .= "<a href='" . get_post_type_archive_link( $post_type ) . "' class='crumb'>$post_type_obj->label</a>";

      }

    }

    // if we're on a post/page, display it
    if ( is_single() || is_page() || is_attachment() ) {

      // store post/page parents
      $parents = array_reverse( get_post_ancestors( $post->ID ) );

      // if the post has parents, display them
      if ( $parents ) {
        foreach ( $parents as $parent ) {
          $html .= $sep;
          $html .= '<a href="' . get_permalink( $parent ) . '" class="crumb">' . get_the_title( $parent ) . '</a>';
        }
      }

      // display link to post/page
      $html .= $sep;
      $html .= '<span class="crumb last">' . get_the_title( $post->ID ) . '</span>';

    }

  // it's a 404
  } else {

    // display a 404 link
    $html .= $sep;
    $html .= "<span class='crumb last'>404</span>";

  }

  // close .breadcrumb
  $html .= '</div>';

  // echo the result
  echo $html;

}