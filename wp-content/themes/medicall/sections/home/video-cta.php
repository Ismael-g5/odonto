<?php
/**
 * Front Video CTA Section
 * 
 * @package Medicall
 */

$toggle_videocta    = get_theme_mod( 'toggle_videocta', false ); 
$subheading_setting = get_theme_mod( 'front_video_cta_subheading_setting' );
$heading_setting    = get_theme_mod( 'front_video_cta_heading_setting' );
$video_link_setting = get_theme_mod( 'front_video_cta_video_link_setting' );
$image_setting      = get_theme_mod( 'front_video_CTA_image_setting' );
$image_id           = attachment_url_to_postid( $image_setting );

if( $toggle_videocta && ( $subheading_setting || $heading_setting || $image_setting || $video_link_setting || $image_id ) ) {  ?>
    <!-- Ads Video start -->
    <section class="ad-video front-ads" id="front-video-cta" >
        <?php if( $image_id || $image_setting ){ 
            echo $image_id 
            ? wp_get_attachment_image( $image_id,'full','',array( 'class' => 'cover' ))
            : '<img class="cover" src="' . esc_url( $image_setting ) . '" />';
        } else { ?>
            <div class="cover" style="background:var(--medi-fallback-bg-color)"></div>
        <?php } if( $subheading_setting || $heading_setting || $video_link_setting ){ ?>
            <div class="content">
                <?php if( $subheading_setting || $heading_setting ) { ?>
                    <article class="center-title-con">
                        <?php if( $subheading_setting ){ ?>
                            <span class="center-title videocta front-videocta">
                                <?php echo esc_html( $subheading_setting ); ?>    
                            </span>
                        <?php } if( $heading_setting ) { ?>
                            <h2 class="center-heading videocta front-videocta">
                                <?php echo esc_html( $heading_setting ); ?>
                            </h2>
                        <?php } ?>
                    </article>
                <?php } if( $video_link_setting ){ ?>
                    <a class="play-btn-con"
                       href="<?php echo esc_url( $video_link_setting  ); ?>" target="_blank";>
                        <?php echo wp_kses( medicall_handle_all_svgs( 'video-play-button' ), medicall_get_kses_extended_ruleset() ); ?>
                    </a>  
                <?php } ?>
            </div>
        <?php } ?>
    </section>
    <!-- Ads Video end -->
<?php
}