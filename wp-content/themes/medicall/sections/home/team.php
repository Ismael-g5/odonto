<?php
/**
 * Front Team Section
 * 
 * @package Medicall
 */

$toggle_team                   = get_theme_mod( 'toggle_team', false ); 
$front_team_subheading_setting = get_theme_mod( 'front_team_subheading_setting', esc_html__( 'Our Experts', 'medicall' ) );
$front_team_heading_setting    = get_theme_mod( 'front_team_heading_setting', esc_html__( 'Professional & Friendly Care Provider','medicall' ) );
$team_repeater                 = get_theme_mod( 'front_team_repeater', array() );

if( $toggle_team && ( $front_team_subheading_setting || $front_team_heading_setting || $team_repeater ) ){ ?>
    <!-- teams section carousel start -->
    <section class="team-con" id="front-team" >
        <div class="container">
            <?php if( $front_team_subheading_setting || $front_team_heading_setting  ) {?>
                <article class="center-title-con">
                    <?php if( $front_team_subheading_setting ) { ?>
                        <span class="center-title">
                            <?php echo esc_html( $front_team_subheading_setting ); ?>
                        </span>
                    <?php }
                    if( $front_team_heading_setting ) { ?>
                        <h2 class="center-heading">
                            <?php echo esc_html( $front_team_heading_setting ); ?>
                        </h2>
                    <?php } ?>
                </article>
            <?php } if( $team_repeater ){ ?>
                <div class="services-con">
                    <div class="row gap-2">
                        <?php foreach( $team_repeater as $repeater ){
                           $icon         = ( isset( $repeater['icon'] ) && !empty( $repeater['icon'] ) ) ? $repeater['icon'] : "";
                           $name         = ( isset( $repeater['name'] ) && !empty( $repeater['name'] ) ) ? $repeater['name'] : "";
                           $faculty      = ( isset( $repeater['faculty'] ) && !empty( $repeater['faculty'] ) ) ? $repeater['faculty'] : "";
                           $designation  = ( isset( $repeater['designation'] ) && !empty( $repeater['designation'] ) ) ? $repeater['designation'] : "";
                           $excerpt      = ( isset( $repeater['excerpt'] ) && !empty( $repeater['excerpt'] ) ) ? $repeater['excerpt'] : "";
                           
                           if( $icon || $name || $faculty || $designation || $excerpt  ){ ?>
                                <div class="col-4-lg col-6-md col-12-xs">
                                    <div class="item">
                                        <div class="team-card">
                                            <?php if( $icon  ){ ?>
                                                <div class="team-profile">
                                                    <?php echo wp_get_attachment_image( $icon, 'team_feature_img' ); ?>
                                                </div>
                                            <?php } ?>
                                            <div class="team-info">
                                                <div class="team-bio">
                                                    <?php if( $name  ){ ?>
                                                        <h3 class="team-name">
                                                            <?php echo esc_html( $name  ); ?>
                                                        </h3>
                                                    <?php }  if( $designation ){ ?>
                                                        <p class="team-profession"><?php echo esc_html( $designation ); ?></p>
                                                    <?php  } if( $faculty  ){ ?>
                                                        <p class="team-uni"><?php echo esc_html( $faculty ); ?></p>
                                                    <?php } ?>
                                                </div>
                                                <?php if( $excerpt  ){ ?>
                                                    <p class="team-desc">
                                                        <?php echo esc_html( $excerpt ); ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } 
                        } ?>
                    </div>
                </div> 
            <?php } ?>
        </div>
    </section>
    <!-- teams section carousel end -->
<?php }