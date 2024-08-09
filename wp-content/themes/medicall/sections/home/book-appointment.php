<?php
/**
 * Front Book Appointment Section
 * 
 * @package Medicall
*/
$toggle_appoinment = get_theme_mod( 'toggle_appoinment', false );
$subheading        = get_theme_mod( 'appointment_subheading_setting' );
$heading           = get_theme_mod( 'appointment_heading_setting' );
$description       = get_theme_mod( 'appointment_description' );
$appointment_image = get_theme_mod( 'appointment_image_setting' );
$img_id            = attachment_url_to_postid( $appointment_image );
$form_shortcode    = get_theme_mod( 'appointment_form_shortcode' );

if( $toggle_appoinment && ( $img_id || $subheading || $heading || $description || $form_shortcode ) ) { ?>
    <!-- Book appointment start -->
    <section class="appointment front-appointment" id="book-appointment">
        <div class="container">
            <div class="appointment-wrapper">
                <?php if( $img_id ) {?>
                    <div class="appointment-left">
                        <div class="appointment-img">
                            <?php echo wp_get_attachment_image( $img_id,'full' ); ?>
                        </div>
                    </div>
                <?php }
                if( $subheading || $heading || $description || $form_shortcode ){ ?>
                    <div class="appointment-right">
                        <div class="appointment-form-con">
                            <?php if( $subheading || $heading) { ?>
                                <article class="center-title-con">
                                    <?php if( $subheading ){ ?>
                                        <span class="center-title appoinment">
                                            <?php echo esc_html( $subheading ); ?>
                                        </span>
                                    <?php }
                                    if( $heading ){ ?>
                                        <h2 class="center-heading start-heading appoinment">
                                            <?php echo esc_html( $heading ); ?>
                                        </h2>
                                    <?php } ?>
                                </article>
                            <?php } if( $description || $form_shortcode ){ ?>
                                <div class="appointment-form">
                                    <?php if( $description ){ ?>
                                        <div class="appointment-form__desc"><p><?php echo wp_kses_post( $description ); ?></p></div>
                                    <?php } if ( $form_shortcode ) echo do_shortcode( $form_shortcode ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php
}
