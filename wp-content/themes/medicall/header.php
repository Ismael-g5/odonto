<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medicall
 */
    /**
     * Doctype Hook
     * 
     * @hooked medicall_doctype
    */
    do_action( 'medicall_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
    <?php 
    /**
     * Before wp_head
     * 
     * @hooked medicall_head
    */
    do_action( 'medicall_before_wp_head' );

    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
    <?php wp_body_open(); ?>
    <?php 
    /**
     * Before Header
     * 
     * @hooked medicall_page_start - 20 
    */
    do_action( 'medicall_before_header' );
    
    /**
     * Header
     * 
     * @hooked medicall_header_inclusion - 10     
    */
    do_action( 'medicall_header' );
    
    /**
     * Before Content
     * 
     * @hooked medicall_background_header   -10
    */
    do_action( 'medicall_after_header' );