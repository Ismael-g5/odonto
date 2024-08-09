<?php 
/**
 * The template for displaying the FrontPage
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medicall
 */


$home_sections = medicall_front_page_sections();

if ( 'posts' == get_option( 'show_on_front' ) ) { //Show Static Blog Page
    include( get_home_template() );
}elseif( $home_sections ){
    get_header();
    //If any one section are enabled then show custom home page.
    foreach( $home_sections as $section ){
        get_template_part( 'sections/home/' . $section );
    }
    get_footer();
}else{
    //If all section are disabled then show respective page template.
    include( get_page_template() );
}