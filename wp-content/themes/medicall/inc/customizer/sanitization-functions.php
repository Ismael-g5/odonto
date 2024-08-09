<?php
/**
 * Sanitization Functions
 * 
 * @package Medicall
*/

if( ! function_exists( 'medicall_sanitize_checkbox' ) ) :
    /**
     * Sanitize Checkbox
     */
	function medicall_sanitize_checkbox( $checked ){
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif;

if ( ! function_exists( 'medicall_radio_sanitization_header' ) ) {
	/**
	 * Function for Sanitization Header
	 */
    function medicall_radio_sanitization_header( $input, $setting ) {
        //get the list of possible radio box or select options
        $choices = $setting->manager->get_control( $setting->id )->choices;
            if ( array_key_exists( $input, $choices ) ) {
                return $input;
            } else {
                return $setting->default;
            }
        }
}

if( ! function_exists( 'medicall_sanitize_code' ) ) :
	/**
	 * Function for Sanitizing Code
	 */
	function medicall_sanitize_code( $value ){
		return htmlspecialchars_decode( stripslashes( $value ) );
	}
endif;