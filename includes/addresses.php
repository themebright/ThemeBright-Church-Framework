<?php
/**
 * Address Functions
 *
 * Contains functions used to process and display addresses.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Address.
 *
 * Displays address in <address> tag with line breaks.
 *
 * @param string $address Address to process.
 * @return string Address in <address> tag with line breaks.
 */
function tbf_address( $address = null ) {

  if ( $address ) {
    $address = nl2br( $address );

    $html  = '<address>';
    $html .= $address;
    $html .= '</address>';

    return $html;
  }

}