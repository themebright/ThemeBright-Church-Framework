<?php
/**
 * Framework Scripts
 *
 * Enqueues the various scripts required by the ThemeBright framework.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Assets
 */

/**
 * Enqueue framework scripts.
 */
function tbf_scripts() {

  // Google Maps API
  wp_enqueue_script( 'tbf-google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', TBF_VERSION );

  // maps script
  wp_enqueue_script( 'tbf-maps', trailingslashit( tbf_template_url() ) . TBF_DIR . '/assets/js/maps.js', array( 'jquery', 'tbf-google-maps' ), TBF_VERSION );

  // fitvids
  wp_enqueue_script( 'tbf-fitvids', trailingslashit( tbf_template_url() ) . TBF_DIR . '/assets/js/jquery.fitvids.js', array( 'jquery' ), TBF_VERSION );

  // framework
  wp_enqueue_script( 'tbf', trailingslashit( tbf_template_url() ) . TBF_DIR . '/assets/js/tbf.js', array( 'jquery', 'tbf-fitvids' ), TBF_VERSION );

}
add_action( 'wp_enqueue_scripts', 'tbf_scripts' );