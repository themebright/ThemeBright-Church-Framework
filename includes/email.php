<?php
/**
 * Email Functions
 *
 * Contains functions used to process and display email addresses.
 */

/**
 * Converts email address to mailto link.
 */
function tbf_email_link( $email = null ) {

  if ( ! empty( $email ) ) {
    $html = "<a href='mailto:" . esc_attr( $email ) . "' class='email'><span>$email</span></a>";

    return $html;
  }

}