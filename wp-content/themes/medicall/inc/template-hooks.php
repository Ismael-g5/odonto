<?php
/**
 * Functions which hooking all the sections of the templates
 *
 * @package Medicall
 */

/* Contact Page Template Contact Form sections */
if( !function_exists( 'medicall_contact_social_icons' ) ){
	/**
	 * Medicall Contact Template Form Section
	 * 
	 * @return void 
	 */
	function medicall_contact_social_icons(){
		$contact_followus_title = get_theme_mod( 'contact_followus_title', __( 'Follow Us On :', 'medicall' ) );
		$facebook_link          = get_theme_mod( 'social_facebook_link' );
		$instagram_link         = get_theme_mod( 'social_instagram_link' );
		$linkedin_link          = get_theme_mod( 'social_linkedin_link' );
		$pinterest_link         = get_theme_mod( 'social_pinterest_link' );
		$md_checkbox            = get_theme_mod( 'md_social_checkbox' );
		
		if( $contact_followus_title ) { ?>
			<div class="contact-social-links">
				<?php if( $contact_followus_title ){ ?>
					<h3 class="follow-us"><?php echo esc_html( $contact_followus_title ); ?></h3>
				<?php }
				 medicall_social_media_repeater( $facebook_link, $instagram_link, $linkedin_link, $pinterest_link, $md_checkbox ); ?> 
        	</div>
		<?php 
		}
	}
}