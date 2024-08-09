<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Medicall
 */

get_header();

/**
 * Before Posts hook
 * @hooked medicall_content_wrapper_start
*/
do_action( 'medicall_before_posts_content' );
?>
	<div class="col-12-lg">
		<section class="error-404 not-found">
			<h2> <?php esc_html_e( '404', 'medicall' ) ?> </h2>
			<header class="page-header">
				<h3 class="page-title"><?php esc_html_e( 'Page Not Found', 'medicall' ); ?></h3>
			</header><!-- .page-header -->
			<div class="page-content">
				<p><?php esc_html_e( 'Opps! The page you looking for doesn\'t exist. It might have been moved or deleted. ', 'medicall' ); ?></p>
				<a href=<?php echo esc_url( get_home_url() ); ?>>
					<button><?php esc_html_e( 'Back To Home', 'medicall' ) ?></button>
				</a>
			</div><!-- .page-content -->
		</section>
	</div>
<?php

/**
* After Posts hook
* @hooked medicall_content_wrapper_end - 10
*/
do_action( 'medicall_after_posts_content' );
    
get_footer();

