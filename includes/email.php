<?php
/**
 * Email Functions
 *
 * Contains functions used to process and display email addresses.
 */

/**
 * Cleans email address and converts it into a mailto: link.
 */
function tbf_email_link( $email = null ) {

  if ( ! empty( $email ) ) {
    $html = "<a href='mailto:" . esc_attr( $email ) . "' class='email'><span>$email</span></a>";

    return $html;
  }

}