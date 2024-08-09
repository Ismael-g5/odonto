<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Medicall
 */

get_header();

	/**
	 * Before Posts hook
	 * @hooked medicall_content_wrapper_start - 10
	*/
	do_action( 'medicall_before_posts_content' );

		while ( have_posts() ) : the_post();
			
			get_template_part( 'template-parts/content','single' );

		endwhile; // End of the loop.
	
	/**
	 * After Posts hook
	 * @hooked medicall_single_entry_footer_sections - 5
	 * @hooked medicall_content_wrapper_end - 10
	*/
	do_action( 'medicall_after_posts_content' );

get_footer();