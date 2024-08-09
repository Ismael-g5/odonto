<?php
/**
 * Blog Section
 * 
 * @package Medicall
 */
$toggle_blog     = get_theme_mod( 'toggle_blog', true ); 
$blog_heading    = get_theme_mod( 'blog_heading_setting', esc_html__( 'What Is New In Medicall Health Care', 'medicall' ) );
$blog_subheading = get_theme_mod( 'blog_subheading_setting', esc_html__( 'Our Blogs', 'medicall' ) );

$args = array(
    'post_type'           => 'post',
    'posts_status'        => 'publish',
);
$query = new WP_Query( $args );

if ( $toggle_blog ) { ?>
    <section class="article front-blog" id="front-blog">
        <div class="container">
            <?php if ( $blog_heading || $blog_subheading ) { ?>
                <article class="center-title-con">
                    <?php if ( $blog_subheading ) { ?>
                        <span class="center-title blog">
                            <?php echo esc_html( $blog_subheading ); ?>
                        </span>
                    <?php }
                    if ( $blog_heading ) {?>
                        <h2 class="center-heading blog"><?php echo esc_html( $blog_heading ); ?></h2>
                    <?php } ?>
                </article>
            <?php } ?>
            <?php if( $query->have_posts() ){ ?>
                <div class="article__bottom">
                    <div class="row gap-2">
                        <div class="col-12-lg col-12-xs">
                            <?php medicall_related_posts( 'latest', 'post', 'blog_button_text');  ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php
}
    