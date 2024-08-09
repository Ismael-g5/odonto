<?php
/**
 * Front CTA Section
 * 
 * @package Medicall
 */

$toggle_cta          = get_theme_mod( 'toggle_cta', false );
$heading_setting     = get_theme_mod( 'front_cta_heading_setting', __( '30% off on All Our Services for this Week', 'medicall' ) );
$description_setting = get_theme_mod( 'front_cta_description_setting', esc_html__( 'I am so grateful for the care and attention that I received from my healthcare provider. They were incredibly kind and understanding.', 'medicall' ) );
$image_url           = get_theme_mod( 'front_cta_image', esc_url( get_template_directory_uri() . '/assets/images/granny-doctor.jpg' ) );
$image_id            = attachment_url_to_postid( $image_url );
$button_text_setting = get_theme_mod( 'front_cta_button_text_setting', esc_html__( 'Book Now', 'medicall' ) );
$button_link_setting = get_theme_mod( 'front_cta_button_link_setting', '#' );

if ( $toggle_cta && ( $heading_setting || $description_setting || $image_id || ( $button_text_setting && $button_link_setting ) ) ) { ?>
    <!-- CTA start -->
    <div class="cta front-cta" id="front-cta" >
        <?php if ( $image_id ) { ?>
            <div class="cta-img">
                <?php echo wp_get_attachment_image( $image_id,'full' ); ?>
            </div>
        <?php } ?>
        <div class="cta-overlay">
            <div class="container">
                <?php if( $heading_setting || $description_setting || ( $button_text_setting && $button_link_setting ) ) { ?>
                    <div class="cta-content-wrapper">
                        <?php if ( $heading_setting ) { ?>
                            <h2 class="cta-heading"><?php echo esc_html( $heading_setting ); ?></h2>
                        <?php } if ( $description_setting ) {
                            echo wpautop( esc_html( $description_setting ) );
                        } if ( ( $button_text_setting && $button_link_setting ) ) { ?>
                            <a href="<?php echo esc_url( $button_link_setting );  ?>" class="btn-white">
                                <?php echo esc_html( $button_text_setting ); ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- CTA end -->
<?php
}