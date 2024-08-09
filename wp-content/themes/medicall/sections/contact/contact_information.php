<?php 
/**
 * Contact Template, Contact Detail Section
 * 
 * @package Medicall
 * 
 */

$num_heading          = get_theme_mod( 'contact_info_number_heading' );
$num_one_title  	  = get_theme_mod( 'contact_info_phone_number_one_title' );
$ph_one_detail 		  = get_theme_mod( 'contact_info_phone_number_one_detail' );
$num_two_title  	  = get_theme_mod( 'contact_info_phone_number_two_title' );
$ph_two_detail 		  = get_theme_mod( 'contact_info_phone_number_two_detail' );
$location_heading     = get_theme_mod( 'contact_info_location_heading' );
$location_one_detail  = get_theme_mod( 'contact_info_location_one_detail' );
$location_two_detail  = get_theme_mod( 'contact_info_location_two_detail' );
$email_heading        = get_theme_mod( 'contact_info_email_heading' );
$email_one_detail     = get_theme_mod( 'contact_info_email_one_detail' );
$email_two_detail     = get_theme_mod( 'contact_info_email_two_detail' );

if( $num_heading || $num_one_title || $ph_one_detail || $num_two_title || $ph_two_detail || $location_heading || $location_one_detail || $location_two_detail || $email_heading || $email_one_detail || $email_two_detail ){ ?>
    <section class="contact-info-wrap">
        <div class="container">
            <div class="row gap-2-lg gap-1-md gap-2-xs ">
                <?php 
                if( $num_heading || ( $num_one_title && $ph_one_detail ) || ( $num_two_title && $ph_two_detail ) ) { ?>
                    <div class="col-4-md col-12-xs">
                        <div class="card">
                            <div class="card-icon">
                                <span>
                                    <?php echo wp_kses( medicall_handle_all_svgs( 'contact-phone-icon' ), medicall_get_kses_extended_ruleset() ); ?>
                                </span>
                            </div>
                            <div>
                                <?php if( $num_heading ) { ?>
                                    <div class="card-title contact-heading">
                                        <h3><?php echo esc_html( $num_heading ); ?></h3>
                                    </div>
                                <?php }  
                                if( ( $num_one_title && $ph_one_detail ) || ( $num_two_title && $ph_two_detail ) ) { ?> 
                                    <div class="card-desc">
                                        <?php if( $num_one_title && $ph_one_detail ){ ?>
                                            <p>
                                                <?php echo esc_html( $num_one_title ) ?>: 
                                                <?php echo esc_html( $ph_one_detail ) ?>
                                            </p>
                                        <?php } if( $num_two_title && $ph_two_detail ){ ?>
                                            <p>
                                                <?php echo esc_html( $num_two_title ) ?>: 
                                                <?php echo esc_html( $ph_two_detail ) ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } 
                if( $location_heading || $location_one_detail || $location_two_detail ){ ?>
                    <div class="col-4-md col-12-xs">
                        <div class="card">
                            <div class="card-icon">
                                <span>
                                    <?php echo wp_kses( medicall_handle_all_svgs( 'contact-location-icon' ), medicall_get_kses_extended_ruleset() ); ?>
                                </span>
                            </div>
                            <div>
                                <?php if( $location_heading ){ ?>
                                    <div class="card-title location-heading">
                                        <h3><?php echo esc_html( $location_heading ); ?></h3>
                                    </div>
                                <?php } if( $location_one_detail || $location_two_detail ) { ?>
                                    <div class="card-desc">
                                        <?php 
                                            echo wpautop( esc_html( $location_one_detail ) );
                                            echo wpautop( esc_html( $location_two_detail ) );
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } if( $email_heading || $email_one_detail || $email_two_detail ) { ?>
                    <div class="col-4-md col-12-xs">
                        <div class="card">
                            <div class="card-icon">
                                <span>
                                <?php echo wp_kses( medicall_handle_all_svgs( 'contact-email-icon' ), medicall_get_kses_extended_ruleset() ); ?>
                                </span>
                            </div>
                            <div>
                                <?php if( $email_heading ){ ?>
                                    <div class="card-title email-heading">
                                        <h3><?php echo esc_html( $email_heading ); ?></h3>
                                    </div>
                                <?php } if( $email_one_detail || $email_two_detail ){ ?>
                                    <div class="card-desc">
                                        <?php 
                                            echo wpautop( esc_html( $email_one_detail) );
                                            echo wpautop( esc_html( $email_two_detail) );
                                        ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php 
}