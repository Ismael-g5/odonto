<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medicall
 */

    /**
     * Footer
     * 
     * @hooked medicall_footer_start  - 20
     * @hooked medicall_footer_middle - 30
     * @hooked medicall_footer_bottom - 40
     * @hooked medicall_footer_end    - 50
    */
    do_action( 'medicall_footer' );

    /**
     * After Footer
     * 
     * @hooked medicall_page_end            - 20
    */
    do_action( 'medicall_after_footer' );
    
    wp_footer(); ?>

</body>
</html>