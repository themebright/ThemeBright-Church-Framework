<?php
/**
 * Email Functions
 *
 * Contains functions used to process and display email addresses.
 *
 * @link https://bitbucket.org/themebright/themebright-framework
 * @since 1.0.0
 *
 * @package ThemeBright_Framework
 * @subpackage Functions
 */

/**
 * Email link.
 *
 * Cleans email address and converts it into a mailto: link.
 *
 * @param string $number Email to clean and convert.
 * @return string Cleaned, linked email.
 */
function tbf_email_link( $email = null ) {

  if ( $email ) {
    $html  = "<a href='mailto:$email' class='email'>";
    $html .= $email;
    $html .= '</a>';

    echo $html;
  }

}