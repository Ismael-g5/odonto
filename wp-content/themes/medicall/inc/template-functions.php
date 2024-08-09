<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Medicall
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

if( ! function_exists( 'medicall_doctype' ) ) :
	/**
	 * Doctype Declaration
	*/
	function medicall_doctype(){ ?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action( 'medicall_doctype', 'medicall_doctype' );

if( ! function_exists( 'medicall_head' ) ) :
	/**
	 * Before wp_head 
	*/
	function medicall_head(){ ?>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php
	}
endif;
add_action( 'medicall_before_wp_head', 'medicall_head' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if( ! function_exists( 'medicall_page_start' ) ) :
	/**
	 * Page Start
	*/
	function medicall_page_start(){ ?>
		<div id="page" class="site">
        	<a class="skip-link screen-reader-text" href="#gl-content"><?php esc_html_e('Skip to content', 'medicall'); ?></a>
		<?php
	}
endif;
add_action( 'medicall_before_header', 'medicall_page_start', 20 );
	
if( ! function_exists( 'medicall_header_inclusion' ) ) :
    /**
     * Header Function
     */
    function medicall_header_inclusion(){
		$toggle_header  = get_theme_mod( 'topbar_toggle', false );
		$facebook_link  = get_theme_mod( 'social_facebook_link' );
		$instagram_link = get_theme_mod( 'social_instagram_link' );
		$linkedin_link  = get_theme_mod( 'social_linkedin_link' );
		$pinterest_link = get_theme_mod( 'social_pinterest_link' );
		$md_checkbox    = get_theme_mod( 'md_social_checkbox' );
		?>
		<header id="masthead" class="site-header style-one" itemscope itemtype="https://schema.org/WPHeader">
			<?php if( $toggle_header ){ ?>
				<div class="header-top clearfix">
					<section class="social social-head">
						<div class="container">
							<div class="row">
								<div class="col-10-md col-12-xs">
									<?php medicall_header_information(); ?>
								</div>
								<div class="col-2-md col-12-xs">
									<?php medicall_social_media_repeater( $facebook_link, $instagram_link, $linkedin_link, $pinterest_link, $md_checkbox ); ?> 
								</div>
							</div>
						</div>
					</section>
				</div>
			<?php } ?>
			<main class="desktop-header">
				<div class="container">
					<div class="desktop-header__wrapper">
						<div class="header-left">
							<?php medicall_site_branding(); ?>
						</div>
						<nav class="header-nav-con">
							<?php medicall_primary_nagivation(); ?>
						</nav>
						<div class="header-right">
							<?php medicall_front_header_one_appointment(); ?>
						</div>
					</div>
				</div>
			</main>
			<?php medicall_mobile_header(); ?>
			<!-- navbar-end -->
		</header>
    <?php }
endif;
add_action( 'medicall_header', 'medicall_header_inclusion', 10 );

if( ! function_exists( 'medicall_background_header' ) ) :
    /**
     * Breadcrumbs section
     *
     * @return void
     */
    function medicall_background_header(){
        if( ! is_front_page() ){ ?>
            <!-- breadcrumb start -->
            <div class="breadcrumb-wrapper">
                <div class="container">
                    <div class="row"> 
                        <div class="col-6-lg col-8-md col-12-xs">
                            <?php medicall_header_title(); ?>
                        </div>
                        <div class="col-6-lg col-4-md col-12-xs">
                            <?php medicall_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb end -->
        <?php 
        }
    }
endif;
add_action( 'medicall_after_header', 'medicall_background_header', 10 );

if( ! function_exists( 'medicall_skip_content_div' ) ) :
    /**
     * Div Started for accessibility Content
     *
     * @return void
     */
    function medicall_skip_content_div(){
		?>
		<div id="gl-content">
		<?php 
	}
endif;
add_action( 'medicall_after_header', 'medicall_skip_content_div', 20 );

if ( ! function_exists( 'medicall_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function medicall_entry_footer() {
		if ( ! is_single() ) { ?>
				<a class="btn__text archive-button" href="<?php the_permalink(); ?>">
					<?php echo esc_html__( "Read More", "medicall" );
					echo  wp_kses( medicall_handle_all_svgs( 'readmore-button-arrow' ), medicall_get_kses_extended_ruleset() ); ?>
				</a>
			<?php 
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'medicall' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
		if( is_singular( 'post' ) ){ ?>
			<footer class="entry-footer">
				<div class="entry-footer__top">
					<div class="entry-footer__meta">
						<div class="entry-footer__author">
							<span><?php esc_html_e( 'By', 'medicall' ); ?></span>
							<span><?php the_author(); ?><span>
						</div>
						<div class="entry-footer__cmt">
							<?php medicall_get_comment_count();?>
						</div>
					</div>
				</div>
				<?php medicall_tags(); ?> 
			</footer>
		<?php 
		}
	}
endif;
add_action( 'medicall_post_entry_content', 'medicall_entry_footer', 20 );

if ( ! function_exists( 'medicall_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function medicall_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() && has_post_thumbnail() ){ ?>
			<div class="post-image">
				<div class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div><!-- .post-thumbnail -->
			</div>
		<?php } else { ?>
				<div class="article__img">
					<?php
						the_post_thumbnail(
							'post-thumbnail',
							array(
								'alt' => the_title_attribute(
									array(
										'echo' => false,
									)
								),
							)
						);
					?>
				</div>
			<?php
		} // End is_singular().
	}
endif;
add_action( 'medicall_before_post_entry_content', 'medicall_post_thumbnail', 10 );

if( ! function_exists( 'medicall_content_wrapper_start' ) ){
	/**
    * Content Wrapper
    * 
    * @return void
    */
	function medicall_content_wrapper_start(){ 
		?>
	    <div class="content-area" id="primary">
            <div class="container">
                <div class="row gap-2">
					<?php if( is_404() ) return false; ?>
					<?php get_sidebar(); ?>
					<div class="col-8-lg col-12-xs site-main">
						<div id="main" class="site-main-wrap">
							<?php if( ! is_singular() && ! is_404() ) echo '<div class="grid-layout-wrap layout-col-2"><div class="row gap-2">';
	}
}
add_action( 'medicall_before_posts_content', 'medicall_content_wrapper_start' );

if( ! function_exists( 'medicall_single_entry_footer_sections' ) ) :
	/**
	 * Entry Footer
	 */
	function medicall_single_entry_footer_sections(){
		$post_type = get_post_type( get_the_ID() );
				
		if( is_singular( 'post' ) ){
			medicall_pagination();
			medicall_author_box();
			medicall_related_posts( 'related', $post_type );
			medicall_comment();
		}
	}
endif;
add_action( 'medicall_after_posts_content', 'medicall_single_entry_footer_sections', 5 );

if( ! function_exists( 'medicall_content_wrapper_end' ) ) :
	/**
	 * Content Wrapper
	*/
	function medicall_content_wrapper_end(){ 
							if( ! is_singular() && ! is_404() ) echo '</div></div>'; //End grid-layout
						    if( is_archive() || is_home() ) medicall_pagination(); ?>
						</div> <!-- End site-main -->
					</div> <!-- End col-8-lg -->
				</div> <!-- End row -->
			</div> <!-- End container -->
		</div> <!-- End content area -->
	<?php 
	}
endif;
add_action( 'medicall_after_posts_content', 'medicall_content_wrapper_end', 10 );

if( ! function_exists( 'medicall_entry_content' ) ) :
	/**
	 * Entry Content
	*/
	function medicall_entry_content(){ 
		if( is_singular() ){ ?>
			<div class="entry-content" itemprop="text">
				<?php the_content(); ?>
			</div>
		<?php } elseif( is_home() || is_archive() || is_author() || is_search() ){ ?>
			<div class="article__body">
				<div class="article__body__bottom">
					<?php 
						if( has_excerpt() ) the_excerpt();
						else echo wpautop( esc_html( wp_trim_words( get_the_content(), 15, '.....' ) ) );
					?>
				</div> 
			</div>
		<?php
		} 
	}  
endif;
add_action( 'medicall_post_entry_content', 'medicall_entry_content', 15 );

if( ! function_exists( 'medicall_entry_header' ) ) :
	/**
	 * Meta Details
	*/
	function medicall_entry_header(){ ?> 
		<header class="entry-header">
			<div class="entry-meta">
				<div class="blog__date">
					<?php medicall_posted_on(); ?>
				</div>
				<div class="entry-categories">
					<?php medicall_category(); ?>
				</div> 
			</div>
			<?php if( ! is_single() ){ ?>
				<h2 class="entry-title artile__title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
			<?php } ?>
		</header>
		<?php
	}
endif;
add_action( 'medicall_before_post_entry_content', 'medicall_entry_header', 15 );

if( ! function_exists( 'medicall_footer_start' ) ) {
	/**
	 * Footer Start
	*/
	function medicall_footer_start(){ ?>
		<footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
			<div class="container">
		<?php
	}
}
add_action( 'medicall_footer', 'medicall_footer_start', 20 );

if ( ! function_exists( 'medicall_footer_middle' ) ) {
    /**
     * Footer Middle Widgets Section
     *
     * @return void
     */

    function medicall_footer_middle() {
        $footer_one   = 'footer-one';
        $footer_two   = 'footer-two';
        $footer_three = 'footer-three';
        $footer_four  = 'footer-four';
		
        if ( is_active_sidebar($footer_one) || is_active_sidebar($footer_two) || is_active_sidebar($footer_three) || is_active_sidebar($footer_four) ) { ?>
            <!-- Footer's Widgets Section -->
            <main class="site-footer__main">
                <div class="row gap-2 gap-3-lg">
                    <?php
                    $footer_widgets = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
                    foreach ($footer_widgets as $footer_sidebar) {
                        if ( is_active_sidebar( $footer_sidebar )) { ?>
                            <div class="col-3-lg col-6-sm col-12-xs">
                                <?php dynamic_sidebar( $footer_sidebar ); ?>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </main>
        <?php
        }
    }
}
add_action( 'medicall_footer', 'medicall_footer_middle', 30 );

if ( ! function_exists( 'medicall_footer_bottom' ) ) {
    /**
     * Footer Bottom 
	 * -Calling the Footer Copyright function
	 * -Calling the Footer Social Icon function 
     *  
     *
     * @return void
     */
    function medicall_footer_bottom() {
		$facebook_link  = get_theme_mod( 'social_facebook_link' );
		$instagram_link = get_theme_mod( 'social_instagram_link' );
		$linkedin_link  = get_theme_mod( 'social_linkedin_link' );
		$pinterest_link = get_theme_mod( 'social_pinterest_link' );
		$md_checkbox    = get_theme_mod( 'md_social_checkbox' );
		?>
			<section class="site-footer__bottom">
				<div class="site-info">
				<div class="site-meta">
						<?php 
							medicall_footer_copyright();
							medicall_toggle_author_link();
							medicall_toggle_wp_link();
							if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link();
							}
						?>
					</div>
					<?php
						if( $facebook_link || $instagram_link || $linkedin_link || $pinterest_link ){ ?> 				
							<div class="site-links">
								<?php medicall_social_media_repeater( $facebook_link, $instagram_link, $linkedin_link, $pinterest_link, $md_checkbox ); ?>  
							</div>
						<?php 
						}
					?>
				</div>
			</section>
		<?php
	} 
}
add_action( 'medicall_footer', 'medicall_footer_bottom', 40 );

if( ! function_exists( 'medicall_footer_end' ) ) {
	/**
	 * Footer end
	*/
	function medicall_footer_end(){ ?>
				</div>
			</footer>
		</div>
		<?php
	}
}
add_action( 'medicall_footer', 'medicall_footer_end', 50 );

if( ! function_exists( 'medicall_page_end' ) ) {
	/**
	 * Page End
	 *
	 * @return void
	 */
	function medicall_page_end(){ ?>
			<span id="sideMenuOverlay"></span>
		</div><!-- #page -->
	<?php 
	}
}
add_action( 'medicall_after_footer', 'medicall_page_end', 20 );