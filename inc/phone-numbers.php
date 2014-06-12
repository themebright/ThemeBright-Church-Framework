<?php
/**
 * Phone Number Functions
 *
 * Contains functions used to process and display phone numbers.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Phone number HTML.
 *
 * Cleans phone number and converts it into a tel: link.
 *
 * @param string $number Phone number to clean and convert.
 * @return string Cleaned, linked phone number.
 */
function tbf_phone_html( $number ) {

  if ( empty( $number ) ) {
    return null;
  }

  if ( $number ) {
    $html  = '<a href="tel:+' . tbf_clean_phone( $number ) . '" class="phone">';
    $html .= $number;
    $html .= '</a>';

    echo $html;
  }

}

/**
 * Description
 * @param type $number
 * @return type
 */
function tbf_clean_phone( $number = null ) {

  if ( isset( $number ) ) {
    $number = preg_replace( '/\D+/', '', $number );

    return $number;
  }

}