<?php
/**
 *  Contact Template, Contact Form Section
 * 
 *  @package Medicall
 */

$featured_img     = get_theme_mod( 'contact_form_featured_img' );
$featured_img_id  = attachment_url_to_postid( $featured_img );
$form_heading     = get_theme_mod( 'contact_form_heading' );
$form_subheading  = get_theme_mod( 'contact_form_subheading' );
$form_shortcode   = get_theme_mod( 'contact_form_shortcode' );

if( $featured_img || $featured_img_id || $form_heading || $form_subheading || $form_shortcode ) { ?>
    <section class="contact-form-wrap">
        <div class="container">
            <?php if( $featured_img || $featured_img_id || $form_heading || $form_subheading || $form_shortcode ){ ?>
                <div class="row gap-2">
                    <?php if( $featured_img_id || $featured_img ){ ?>
                        <div class="col-6-lg col-12-xs" >
                            <div class="contact-img">
                                <?php if( $featured_img_id ){
                                    echo wp_get_attachment_image( $featured_img_id, 'full' );				
                                } ?>
                            </div>
                        </div>
                    <?php } 
                    if( $form_heading || $form_subheading || $form_shortcode ){ ?>
                        <div class="col-6-lg col-12-xs" >
                            <div class="contact-form-con">
                                <?php if( $form_heading || $form_subheading ){ ?>
                                    <article class="center-title-con">
                                        <span class="center-title contact-form"><?php echo esc_html( $form_subheading ); ?></span>
                                        <h2 class="center-heading start-heading contact-form"><?php echo esc_html( $form_heading ); ?></h2>
                                    </article>
                                <?php } if( $form_shortcode ){
                                    echo do_shortcode( $form_shortcode );
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } medicall_contact_social_icons(); ?>
        </div>
    </section>
<?php 
}