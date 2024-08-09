<?php 
/**
 * Front Department Section
 * 
 * @package Medicall
 */
$toggle_frontdepartment    = get_theme_mod( 'toggle_department', false ); 
$heading_setting           = get_theme_mod( 'department_heading_setting', __( 'Our Medical Services', 'medicall' ) );
$subheading_setting        = get_theme_mod( 'department_subheading_setting', __( 'Our Departments', 'medicall' ) );
$front_department_repeater = get_theme_mod( 'front_department_repeater');

if( $toggle_frontdepartment && ( $heading_setting || $subheading_setting || $front_department_repeater ) ){ ?>
    <section class="departments" id="front-department" >
        <div class="container">
            <?php if( $heading_setting || $subheading_setting ){ ?>
                <article class="center-title-con">
                    <?php if( $subheading_setting ){ ?>
                        <span class="center-title depart"><?php echo esc_html( $subheading_setting ); ?></span>
                    <?php } if( $heading_setting ){ ?>
                        <h2 class="center-heading depart"><?php echo esc_html( $heading_setting ); ?></h2>
                    <?php } ?>
                </article>
            <?php } if( $front_department_repeater ){ ?>
                <main class="services-con">
                    <div class="row gap-2">      
                    <?php foreach( $front_department_repeater as $repeater ){
                        $icons      = ( isset( $repeater['icon'] ) && !empty( $repeater['icon'] ) ) ? $repeater['icon'] : "";
                        $headings   = ( isset( $repeater['headings'] ) && !empty( $repeater['headings'] ) ) ? $repeater['headings'] : "";
                        $excerpts   = ( isset( $repeater['excerpt'] ) && !empty( $repeater['excerpt'] ) ) ? $repeater['excerpt'] : "";
                        $features   = ( isset( $repeater['features'] ) && !empty( $repeater['features'] ) ) ? $repeater['features'] : "";
                        $btns_label = ( isset( $repeater['btn_label'] ) && !empty( $repeater['btn_label'] ) ) ? $repeater['btn_label'] : "";
                        $btns_url   = ( isset( $repeater['btn_url'] ) && !empty( $repeater['btn_url'] ) ) ? $repeater['btn_url'] : "";
                        if( $icons || $headings || $excerpts || $features || $btns_label || $btns_url ){ ?>
                        <div class="col-4-lg col-6-md col-12-xs">
                            <div class="item">
                                <div class="department-card">
                                    <?php if( $icons ){ ?>
                                        <div class="department-card-icon">
                                            <?php echo wp_get_attachment_image( $icons, 'full' );?>
                                        </div>
                                    <?php } if( $headings ){ ?>
                                        <h4 class="department-card-title"><?php echo esc_html( $headings ); ?></h4>
                                    <?php } if( $excerpts ){ ?>
                                        <p class="department-card-desc"><?php echo esc_html( $excerpts ); ?></p>
                                    <?php }
                                    ?>
                                    <ul class="tick-points">
                                        <?php 
                                            if( $features ){ 
                                                $bullet_list = explode("\n",$features ); 
                                                foreach( $bullet_list as $list ) {
                                                    $list= trim( $list );
                                                    if ( ! empty( $list ) ) { ?>
                                                        <li><?php echo wp_kses_post( $list ); ?></li>
                                                        <?php 
                                                    }
                                                } 
                                            }
                                        ?>  
                                    </ul>
                                    <?php if( $btns_label && $btns_url ){ ?>
                                        <a href="<?php echo esc_url( $btns_url ); ?>" class="btn-primary"><?php echo esc_html( $btns_label ); ?></a>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                        } 
                    } ?>
                    </div>
                </main>
            <?php } ?>
        </div>
    </section>
<?php }
