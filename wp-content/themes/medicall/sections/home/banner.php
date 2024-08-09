<?php

/**
 * Static Banner/ Video Banner
 */
$toggle_banner                   = get_theme_mod('toggle_banner', true);
$hero_heading_settings           = get_theme_mod('hero_heading_setting', __('WELCOME TO MEDICALL HEALTH CARE', 'medicall'));
$hero_title_one                  = get_theme_mod('hero_title_one', __('The Best Medical', 'medicall'));
$hero_title_two                  = get_theme_mod('hero_title_two', __('Services You Deserve', 'medicall'));
$hero_banner_description_setting = get_theme_mod('hero_banner_description_setting', __('Our specialists are highly compassionate and professional in dealing with your health. They are very much experienced.', 'medicall'));
$btn_one_text                    = get_theme_mod('banner_btn_one_text', __('Find A Doctor', 'medicall'));
$btn_one_link                    = get_theme_mod('banner_btn_one_link', "#");

if (has_custom_header() && ( $toggle_banner && ( $hero_heading_settings || $hero_title_one || $hero_title_two || $hero_banner_description_setting || ( $btn_one_text && $btn_one_link ) ) ) ) { ?>
    <section id="banner-section" class="banner-six <?php if (has_header_video()) echo esc_attr(' banner-video '); ?>">
        <?php the_custom_header_markup(); ?>
        <div class="banner__content">
            <div class="container">
                <div class="banner-content-wrap">
                    <?php if ( $hero_heading_settings || $hero_title_one || $hero_title_two || $hero_banner_description_setting || ($btn_one_text && $btn_one_link) ) { ?>
                        <div class="banner-left">
                            <div class="banner-left-wrap">
                                <?php if ( $hero_heading_settings ) { ?>
                                    <span class="greating banner-greet"><?php echo esc_html( $hero_heading_settings ); ?></span>
                                <?php } if ( $hero_title_one || $hero_title_two ) { ?>
                                    <div class="banner__title-wrapper">
                                        <?php if( $hero_title_one ){ ?>
                                            <h2 class="banner__title is-plain"><?php echo esc_html( $hero_title_one ); ?></h2>
                                        <?php } if( $hero_title_two ){ ?>
                                            <h2 class="banner__title is-bold"><?php echo esc_html( $hero_title_two ); ?></h2>
                                        <?php } ?>
                                    </div>
                                <?php } if ($hero_banner_description_setting) { ?>
                                    <p class="banner-description"><?php echo esc_html($hero_banner_description_setting); ?></p>
                                <?php } if ( ( $btn_one_text && $btn_one_link ) ) { ?>
                                    <div class="banner-left-btm">
                                        <?php if ( $btn_one_text && $btn_one_link ) { ?>
                                            <a href=<?php echo esc_url( $btn_one_link ); ?> class="btn-primary">
                                                <?php echo esc_html( $btn_one_text ); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </section>
<?php }
