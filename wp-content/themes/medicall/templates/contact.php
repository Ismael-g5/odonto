<?php
/**
 * Template Name: Contact Us
 * @package Medicall
 */ 

get_header(); 
    $about_sections = apply_filters( 
        'medicall_contact_sections',
        array( 'contact_information', 'contact_form','contact_map' )
    );
    foreach( $about_sections as $section ){
        get_template_part( 'sections/contact/' . $section );
    }

get_footer();
