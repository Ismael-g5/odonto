<?php 
/**
 * Front About Section
 * 
 * @package medicall
 * 
 */

$toggle_aboutus   = get_theme_mod( 'toggle_aboutus', false );
$subheading       = get_theme_mod( 'about_subheading_setting' );
$heading          = get_theme_mod( 'about_heading_setting' );
$description      = get_theme_mod( 'about_description_setting' );
$feature_list     = get_theme_mod( 'about_list_repeater');
$feature_repeater = get_theme_mod( 'about_icon_repeater');
$button_text      = get_theme_mod( 'about_button_text' );
$button_link      = get_theme_mod( 'about_button_link' );
$big_image        = get_theme_mod( 'about_big_image', esc_url( get_template_directory_uri() . '/assets/images/about.jpg' ) );
$small_image      = get_theme_mod( 'about_small_image' );
$small_image_id   = attachment_url_to_postid( $small_image );
$big_image_id     = attachment_url_to_postid( $big_image );

if( $toggle_aboutus && ( $subheading || $heading ||  $description || $feature_list || $feature_repeater || ( $button_text && $button_link ) || $big_image || $small_image ) ){ ?>
    <section class="about" id="front-about" >
        <div class="container">
            <div class="about-wrapper">
                <?php if( $subheading || $heading || $description || $feature_list || $feature_repeater || ( $button_link && $button_text ) ){ ?>
                    <div class="about-left">
                        <?php if( $subheading || $heading ){ ?>
                            <article class="center-title-con">
                                <?php if ( $subheading ) { ?>
                                    <span class="center-title"><?php echo esc_html( $subheading ); ?></span>
                                <?php } if ( $heading ) { ?>
                                    <h2 class="center-heading start-heading"><?php echo esc_html( $heading ); ?></h2>
                                <?php } ?>
                            </article>
                        <?php } if ( $description ) { ?>
                            <p class="about-desc"><?php echo esc_html( $description ); ?></p>
                        <?php } if ( $feature_list ) { ?>
                            <ul class="about-points">
                                <?php foreach ( $feature_list as $repeater ) {
                                    $list_title = ( ! empty( $repeater['text'] ) && isset( $repeater['text'] ) ) ? $repeater['text'] : '';
                                    if ( $list_title ) { ?>
                                        <li><?php echo esc_html( $list_title ); ?></li>
                                    <?php }
                                } ?>
                            </ul>
                        <?php } if( $feature_repeater ){ ?>
                            <div class="about-feature-con">
                                <?php foreach( $feature_repeater as $repeater ){
                                    $feature_title = ( !empty( $repeater['title'] ) && isset( $repeater['title'] ) ) ? $repeater['title'] : '';
                                    $feature_image = ( !empty( $repeater['image'] ) && isset( $repeater['image'] ) ) ? $repeater['image'] : '';
                                    $feature_url = ( !empty( $repeater['url'] ) && isset( $repeater['url'] ) ) ? $repeater['url'] : '';
                                    
                                    if( ($feature_title || $feature_image) && $feature_url ){ ?>
                                        <a href="<?php echo esc_url( $feature_url ) ?>">
                                            <div class="about-feature">
                                                <?php if( $feature_image ) echo wp_get_attachment_image( $feature_image, 'thumbnail', true ); ?>
                                                <?php if( $feature_title ){ ?>
                                                    <h3><?php echo esc_html( $feature_title ); ?></h3>
                                                <?php } ?> 
                                            </div>
                                        </a>
                                    <?php
                                    }
                                } ?>
                            </div>
                        <?php } if( $button_link && $button_text ) { ?>
                            <div class="about-btn-con">
                                <a href="<?php echo esc_url($button_link); ?>">
                                    <button class="btn-primary"><?php echo esc_html( $button_text ); ?></button>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } if( $big_image_id || $small_image_id ){ ?>
                    <div class="about-right">
                        <div class="about-image-wrapper">
                            <?php if ( $big_image_id ) { 
                                echo wp_get_attachment_image( $big_image_id, 'full', false, array('class' => "about-img__main")); ?>
                            <?php }if ( $small_image_id ) { 
                                echo wp_get_attachment_image( $small_image_id, 'front_aboutus_smallimg', false, array('class' => "about-img__secondary")); ?>
                            <?php } ?>
                        </div> 
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php 
}