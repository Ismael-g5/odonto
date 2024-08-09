<?php
/**
 * Template part for displaying archive posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Medicall
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); echo ' itemscope itemtype="https://schema.org/Blog"'; ?>>
	<?php if( !is_single() ) echo '<div class="article__card">'; 
		
		/**
		* @hooked medicall_post_thumbnail - 10
		* @hooked medicall_entry_header   - 15 
		*/
		do_action( 'medicall_before_post_entry_content' );
	 
		/**
		 * Entry Content
		 * @hooked medicall_entry_content - 15
		 * @hooked medicall_entry_footer  - 20
		*/
		do_action( 'medicall_post_entry_content' );
	?> 
</article>

