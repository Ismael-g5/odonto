<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Medicall
 */

get_header();

/**
 * Before Posts hook
 * @hooked medicall_content_wrapper_start
*/
do_action( 'medicall_before_posts_content' );

if (have_posts()) {
	 while( have_posts() ) {
		the_post();
		/*
		* Include the Post-Type-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Type name) and that will be used instead.
		*/
		?>
		<div class="col-6-md col-12-xs">
			<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
		</div>
		<?php 
		}	
}
else {
	get_template_part('template-parts/content', 'none');
}
/**
* After Posts hook
* @hooked medicall_content_wrapper_end - 10
*/
do_action( 'medicall_after_posts_content' );

get_footer();
