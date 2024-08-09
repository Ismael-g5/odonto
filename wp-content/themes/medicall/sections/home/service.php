<?php

/**
 * Front Service Section
 * 
 * @package Medicall
 */
$toggle_service          = get_theme_mod( 'toggle_service', false );
$heading_setting         = get_theme_mod( 'service_heading_setting' );
$subheading_setting      = get_theme_mod( 'service_subheading_setting' );
$front_services_repeater = get_theme_mod( 'front_service_repeater' );

if ( $toggle_service && ( $heading_setting || $subheading_setting || $front_services_repeater ) ) { ?>
    <section class="services front-service" id="front-service">
        <div class="container">
            <?php if ( $heading_setting ||  $subheading_setting ) { ?>
                <article class="center-title-con">
                    <?php
                    if ( $heading_setting ) echo '<span class="center-title service">' . esc_html( $heading_setting ) . '</span>';
                    if ( $subheading_setting ) echo '<h2 class="center-heading serv">' . esc_html( $subheading_setting ) . '</h2>';
                    ?>
                </article>
            <?php }
            if ( $front_services_repeater ) { ?>
                <main class="services-con">
                    <div class="row gap-2">
                        <?php foreach ($front_services_repeater as $repeater) {
                            $icon      = ( isset( $repeater['icon'] ) && !empty( $repeater['icon'] ) ) ? $repeater['icon'] : "";
                            $heading   = ( isset( $repeater['heading'] ) && !empty( $repeater['heading'] ) ) ? $repeater['heading'] : "";
                            $excerpt   = ( isset( $repeater['excerpt'] ) && !empty( $repeater['excerpt'] ) ) ? $repeater['excerpt'] : "";
                            $btn_label = ( isset( $repeater['btn_label'] ) && !empty( $repeater['btn_label'] ) ) ? $repeater['btn_label'] : "";
                            $btn_url   = ( isset( $repeater['btn_url'] ) && !empty( $repeater['btn_url'] ) ) ? $repeater['btn_url'] : "";

                            if ( $icon || $heading || $excerpt || $btn_label || $btn_url ) { ?>
                                <div class="col-4-lg col-6-md col-12-xs">
                                    <div class="card">
                                        <?php if ( $icon ) { ?>
                                            <span class="card-icon">
                                                <?php echo wp_get_attachment_image($icon, 'full'); ?>
                                            </span>
                                        <?php }
                                        if ( $heading ) { ?>
                                            <div class="card-title">
                                                <h3><?php echo esc_html( $heading ); ?></h3>
                                            </div>
                                        <?php }
                                        if ( $excerpt ) {
                                            echo '<div class="card-desc">';
                                                echo wpautop( esc_html( $excerpt ) );
                                            echo '</div>';
                                        }
                                        if ( $btn_label && $btn_url ) { ?>
                                            <a href="<?php echo esc_url( $btn_url ); ?>" class="btn__text front-service-btn">
                                                <?php echo esc_html( $btn_label ); ?>
                                                <?php echo wp_kses( medicall_handle_all_svgs( 'service-readmore-icon' ), medicall_get_kses_extended_ruleset() ); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </main>
            <?php } ?>
        </div>
    </section>
<?php }
