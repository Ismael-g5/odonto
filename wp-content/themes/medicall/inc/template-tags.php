<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Medicall
 */

 if ( ! function_exists( 'medicall_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see medicall_custom_header_setup().
	 */
	function medicall_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if( ! function_exists( 'medicall_header_title' ) ) :
    /**
     * Page Title
     *
     * @return void
     */
    function medicall_header_title(){ ?>
        <header class="entry-header">
            <?php 
                if ( is_home() && ! is_front_page() ){ 
                    echo '<h1 class="entry-title">';
                    single_post_title();
                    echo '</h1>';
                }   
                        
                if( is_archive() ){ 
                    the_archive_title( '<h1 class="entry-title">', '</h1>' );
                }
                
                if( is_search() ){
                    echo '<h1 class="entry-title">';
                    printf( esc_html__( 'Search Results for: %s', 'medicall' ), '<span>' . get_search_query() . '</span>' );
                    echo '</h1>';
                }
        
                if( is_singular() ){
                    the_title( '<h1 class="entry-title">', '</h1>' );
                }
                if( is_404() ){
                    echo '<h1 class="entry-title">';
                    esc_html_e( 'Error Page', 'medicall' );
                    echo '</h1>';
                }
            ?>
        </header>
        <?php 
    }
endif;

if ( ! function_exists( 'medicall_mobile_ham_wrapper' ) ) {
	function medicall_mobile_ham_wrapper(){ ?>
		<button class="ham-wrapper" id="sideMenuOpener">
			<div class="ham-bar"></div>
            <div class="ham-bar"></div>
            <div class="ham-bar"></div>
	</button>
	<?php
	}
}

if( ! function_exists( 'medicall_site_branding' ) ) :
    /**
     * Site Branding
    */
    function medicall_site_branding(){ 
		$description = get_bloginfo('description', 'display');
		?>		
		<div class="site-branding" itemscope itemtype="https://schema.org/Organization">
			<div class="text-logo">
				<?php  
					if( function_exists( 'has_custom_logo' ) && has_custom_logo() )the_custom_logo(); 
				?>
			</div>
			<?php if ( is_front_page() && get_bloginfo('name') ) : ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
				</h1>
			<?php elseif ( get_bloginfo('name') ) : ?>
				<p class="site-title">
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
				</p>
			<?php endif;
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description">
					<?php 
						echo esc_html( $description );
					?>
				</p>
			<?php endif; ?>
		</div> 
    <?php 
    }
endif;

if( ! function_exists( 'medicall_mobile_site_branding' ) ) :
    /**
     * Mobile Site Branding
    */
    function medicall_mobile_site_branding(){ 
		$description = get_bloginfo('description', 'display');
		?>		
		<div class="site-branding" itemscope itemtype="https://schema.org/Organization">
			<div class="text-logo">
				<?php  
					if( function_exists( 'has_custom_logo' ) && has_custom_logo() )the_custom_logo(); 
				?>
			</div>
			<?php if ( is_front_page() && get_bloginfo('name') ) : ?>
				<h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
			<?php elseif ( get_bloginfo('name') ) : ?>
				<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
			<?php endif;
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description">
					<?php 
						echo esc_html( $description ); 
					?>
				</p>
			<?php endif; ?>
		</div> 
    <?php 
    }
endif;

if( ! function_exists( 'medicall_mobile_portal' ) ) :
    /**
     * Primary Navigation Mobile Portal.
    */
    function medicall_mobile_portal(){ 
        $header_plain_title = get_theme_mod( 'header_plain_title' );
        $plain_title_link   = get_theme_mod( 'plain_title_link' );

        if ( $header_plain_title && $plain_title_link ) {
            if( $header_plain_title && $plain_title_link ){ ?>
                <a href="<?php echo esc_url( $plain_title_link ); ?>">
                    <button class="btn-primary"><?php echo esc_html( $header_plain_title ); ?></button>
                </a>
            <?php 
            }
        }
    }
endif;

if( ! function_exists( 'medicall_mobile_contact' ) ) :
    /**
     * Mobile Contact Details
    */
    function medicall_mobile_contact(){ 
        $email        = get_theme_mod( 'email', __( 'info@medical.com', 'medicall' ) );
        $phone_number = get_theme_mod( 'phone_number', __( '+1-202-555-0133', 'medicall' ) );
        $location     = get_theme_mod( 'location', __( 'Oklahoma', 'medicall' ) );

        if( $email || $phone_number || $location ) { ?>
			<div class="sidebar-footer-bottom">
            	<div class="social-left">
					<?php if( $email ){ ?>
						<div class="social-info">
							<?php
								echo '<a href="' . esc_url('mailto:' . sanitize_email( $email )) . '" class="email-link">' . wp_kses( medicall_handle_all_svgs( 'email' ), medicall_get_kses_extended_ruleset() );
								echo '<span>' . esc_html( $email ) . '</span>' . '</a>';
							?>
						</div>
					<?php } if( $phone_number ){ ?>
						<div class="social-info">
							<?php
								echo '<a href="' . esc_url('tel:' .  preg_replace('/[^\d+]/', '', $phone_number)) . '" class="tel-link">' . wp_kses( medicall_handle_all_svgs( 'phone' ), medicall_get_kses_extended_ruleset() );
								echo '<span>' . esc_html( $phone_number ) . '</span>' . '</a>';
							?>
						</div>
					<?php } if( $location ){ ?>
						<div class="social-info">
							<?php
								echo wp_kses( medicall_handle_all_svgs( 'location' ), medicall_get_kses_extended_ruleset() );
								echo '<span class="location-link">' . esc_html( $location ) . '</span>';
							?>
						</div>
					<?php } ?>
				</div>
			</div>
        <?php
        }
    }
endif;

if( ! function_exists( 'medicall_mobile_followus' ) ) :
    /**
     * Mobile Followus
    */
    function medicall_mobile_followus(){ 
        $contact_followus_title = get_theme_mod( 'contact_followus_title', __( 'Follow Us On :', 'medicall' ) );
		$facebook_link  		= get_theme_mod( 'social_facebook_link' );
		$instagram_link 		= get_theme_mod( 'social_instagram_link' );
		$linkedin_link  		= get_theme_mod( 'social_linkedin_link' );
		$pinterest_link 		= get_theme_mod( 'social_pinterest_link' );
		$md_checkbox 			= get_theme_mod( 'md_social_checkbox' );
		if( $contact_followus_title ){ ?>
            <p><?php echo esc_html( $contact_followus_title ); ?></p>
        <?php } medicall_social_media_repeater( $facebook_link, $instagram_link, $linkedin_link, $pinterest_link, $md_checkbox );
    }
endif;

if ( ! function_exists( 'medicall_front_header_one_appointment' ) ) :
    /**
     * Medicall Front Header One Appointment
     *
     * @return void
     */
    function medicall_front_header_one_appointment() { 
        $header_plain_title = get_theme_mod( 'header_plain_title' );
        $plain_title_link   = get_theme_mod( 'plain_title_link');

        if( $header_plain_title && $plain_title_link ){ ?>
            <a href="<?php echo esc_url( $plain_title_link ); ?>" class="btn-primary">
            	<?php echo esc_html( $header_plain_title ); ?>
        	</a>
    <?php }
    }
endif;

if ( ! function_exists( 'medicall_header_information' ) ) {
	/**
	 * Header information like email, phone, location and timing
	 *
	 * @return void
	 */
	 function medicall_header_information(){
		 $email          = get_theme_mod( 'email', __( 'info@medical.com', 'medicall' ) );
		 $phone_number   = get_theme_mod( 'phone_number', __('+1-202-555-0133', 'medicall' ) );
		 $location       = get_theme_mod( 'location', __('Oklahoma', 'medicall' ) );   
		 $timing_info    = get_theme_mod( 'timing_info', __( 'Mon - Fri: 9:00AM - 5:00PM', 'medicall' ) );
	 ?>
		 <!-- social links start -->
		 <div class="social-left">
			<?php 
				if ( $email || $phone_number || $location || $timing_info  ) {
					if( $email ){ ?>
						<div class="social-info">
							<?php
								echo '<a href="' . esc_url('mailto:' . sanitize_email( $email ) ) . '" class="email-link">' .  wp_kses( medicall_handle_all_svgs( 'email' ), medicall_get_kses_extended_ruleset() );
								echo '<span>' . esc_html( $email ) . '</span>' . '</a>';
							?>
						</div>
					<?php } if( $phone_number ){ ?>
						<div class="social-info">
							<?php
								echo '<a href="' . esc_url('tel:' .  preg_replace('/[^\d+]/', '', $phone_number) ) . '" class="tel-link">' .   wp_kses( medicall_handle_all_svgs( 'phone' ), medicall_get_kses_extended_ruleset() );
								echo '<span>' . esc_html( $phone_number ) . '</span>' . '</a>';
							?>
						</div>
					<?php } if( $location ){ ?>
						<div class="social-info">
							<?php
								echo  wp_kses( medicall_handle_all_svgs( 'location' ), medicall_get_kses_extended_ruleset() );
								echo '<span class="location-link">' . esc_html( $location ) . '</span>';
							?>
						</div>
					<?php } if( $timing_info ){ ?>
						<div class="social-info">
							<?php
								echo  wp_kses( medicall_handle_all_svgs( 'topbar-headerthree' ), medicall_get_kses_extended_ruleset() );
								echo '<span class="timing-link">' . esc_html( $timing_info  ) . '</span>';
							?>
						</div>
					<?php 
					} 
				}
			?>
		 </div>
		 <!-- social links end -->
	 <?php
	}
}

if( !function_exists( 'medicall_sidebar_layout' ) ){
	/**
	 * Sidebar Layout 
	 *
	 * @return void
	 */
	function medicall_sidebar_layout(){
		$sidebar_layout = get_post_meta( get_the_ID(), 'medicall_sidebar_layout', true);

		$default_layout = 'gl-right-wrap';

		if( is_page() ){
			$default_layout = get_theme_mod( 'single_page_layouts','gl-right-wrap' );
		}
		if( is_single() ){
			$default_layout = get_theme_mod( 'single_post_layouts','gl-right-wrap' );
		}

		if( is_archive() || is_search() || is_home() ){
			$default_layout = get_theme_mod( 'archive_page_layouts','gl-right-wrap' );
		}

		if( is_singular() ){
			if( isset( $sidebar_layout ) && ! empty( $sidebar_layout ) ){
				if ( $sidebar_layout == 'default' ) {
					if ( !is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'gl-full-wrap';
					}else{
						$layout = $default_layout;
					}
					
				}elseif ( $sidebar_layout == 'left-sidebar' ) {
					if ( !is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'gl-full-wrap';
					}else{
						$layout = 'gl-left-wrap';
					}
					
				}elseif ( $sidebar_layout == 'right-sidebar' ) {
					if ( !is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'gl-full-wrap';
					}else{
						$layout = 'gl-right-wrap';
					}
					
				}elseif ( $sidebar_layout == 'full-width' ) {
					if ( !is_active_sidebar( 'primary-sidebar' ) ) {
						$layout = 'gl-full-wrap';
					}else{
						$layout = 'gl-full-wrap';
					}
				}else {
					$layout = $default_layout;
				}
				return esc_attr( $layout );
			}else{
				if ( !is_active_sidebar( 'primary-sidebar' ) ) {
					return esc_attr('gl-full-wrap');
				}else{
					return $default_layout;
				}
			}
		}else{
			if( is_archive() || is_search() || is_home() ){
				if ( !is_active_sidebar( 'primary-sidebar' ) ) {
					$layout = 'gl-full-wrap';
				}else{
					$layout = $default_layout;
				}
				return $layout;
			}
			return false;
		}
		
	}
}

if( ! function_exists( 'medicall_related_posts' ) ) :
	/**
	 * Related Posts
	*/
	function medicall_related_posts( $status, $post_type, $btn_key='' ){ 
		global $post;
		$readmore       = get_theme_mod( $btn_key, __( 'Read More', 'medicall' ) );
		$toggle_excerpt = get_theme_mod( 'toggle_related_post_excerpt', true );
	
		$args = array(
			'post_type'           => $post_type,
			'posts_status'        => 'publish',
			'ignore_sticky_posts' => true
		);
		
		switch( $status ){
			case 'latest':  
				$args['posts_per_page'] = 3;
				$title                  = '';
				$class                  = 'recent-posts';
			break;

			case 'related':
				$readmore       = get_theme_mod( 'post_readmore_button', __( 'Read More', 'medicall' ) );
				$args['posts_per_page'] = 2;
				$args['post__not_in']   = array( $post->ID );
				$args['orderby']        = 'rand';
				$title                  = get_theme_mod( 'related_post_title', __( 'Related Posts', 'medicall' ) );
				$class                  = 'related-posts';
			break;       
		}
        $query = new WP_Query( $args );

		if( $query->have_posts() && ( $status === 'related' || $status === 'latest' ) ){ 
				if( $title && $status === 'related' ){ ?>
					<h2 class="section-heading"> <?php echo esc_html( $title ) ?></h2>
				<?php } ?> 
				<div class="article__card__wrapper <?php echo esc_attr( $class ); ?>">
					<?php while ( $query->have_posts() ) {
						$query->the_post(); ?>
						<div class="article__card">
							<div class="article__img">
								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail('full', ['class' => 'w-100', 'title' => 'Feature image']); 
								}?>
							</div>
							<div class="article__body">
								<div class="article__body__top">
									<?php
									// Category
									$categories = get_the_category( $post->ID );
									if ( ! empty( $categories ) ) { ?>
										<ul class="article__tags">
											<?php foreach ( $categories as $category ) {
												$categories_url = get_category_link( $category->term_id ); ?>
												<li class="tag">
													<a href=<?php echo esc_url( $categories_url ); ?>>
														<?php
														echo esc_html( $category->name );
														?>
													</a>
												</li>
											<?php } ?>
										</ul>
									<?php } ?> 
									<a href="<?php the_permalink(); ?>">
										<h3 class="artile__title"><?php the_title(); ?></h3>  
									</a>                                                  
								</div>
								<?php if( $toggle_excerpt ){ ?>
									<div class="article__body__bottom">
										<?php 
											if( has_excerpt() ){
												echo the_excerpt();
											}else{
												echo wpautop( esc_html( wp_trim_words( get_the_content(), 15, '.....' ) ) );
											}											
										?>
									</div>
								<?php } if ( $readmore ) { ?>
									<a class="btn__text" href="<?php the_permalink(); ?>">
										<?php echo esc_html( $readmore );
										echo wp_kses( medicall_handle_all_svgs( 'readmore-button-arrow' ), medicall_get_kses_extended_ruleset() ); ?>
									</a>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php
			wp_reset_postdata();
		}
	}
endif;

if (!function_exists('medicall_handle_all_svgs')) :
	/**
	 * Lists all the svg
	 *
	 * @param [type] $svg
	 * @return void
	 */
	function medicall_handle_all_svgs($svg){
		switch ($svg) {
			case 'facebook': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><path
				d    = "M5.55448 12.8333H8.01062V7.91491H10.2236L10.4668 5.47105H8.01062V4.23684C8.01062 4.07399 8.07531 3.91781 8.19047 3.80265C8.30562 3.6875 8.4618 3.62281 8.62466 3.62281H10.4668V1.16667H8.62466C7.81039 1.16667 7.02948 1.49013 6.45371 2.0659C5.87794 2.64167 5.55448 3.42258 5.55448 4.23684V5.47105H4.32641L4.08325 7.91491H5.55448V12.8333Z"
				fill = "currentColor" />
				</svg>';
			break;

			case 'instagram': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
				<path
				d    = "M7.00008 1.16667C8.585 1.16667 8.78275 1.1725 9.40458 1.20167C10.0258 1.23083 10.4487 1.32825 10.8209 1.47292C11.2059 1.62108 11.5302 1.82175 11.8546 2.1455C12.1512 2.43711 12.3807 2.78984 12.5272 3.17917C12.6712 3.55075 12.7692 3.97425 12.7984 4.5955C12.8258 5.21733 12.8334 5.41508 12.8334 7C12.8334 8.58492 12.8276 8.78267 12.7984 9.4045C12.7692 10.0257 12.6712 10.4487 12.5272 10.8208C12.3811 11.2104 12.1516 11.5632 11.8546 11.8545C11.5629 12.151 11.2102 12.3805 10.8209 12.5271C10.4493 12.6712 10.0258 12.7692 9.40458 12.7983C8.78275 12.8257 8.585 12.8333 7.00008 12.8333C5.41516 12.8333 5.21741 12.8275 4.59558 12.7983C3.97433 12.7692 3.55141 12.6712 3.17925 12.5271C2.78977 12.3809 2.43697 12.1514 2.14558 11.8545C1.8489 11.5629 1.61937 11.2102 1.473 10.8208C1.32833 10.4492 1.23091 10.0257 1.20175 9.4045C1.17433 8.78267 1.16675 8.58492 1.16675 7C1.16675 5.41508 1.17258 5.21733 1.20175 4.5955C1.23091 3.97367 1.32833 3.55133 1.473 3.17917C1.61897 2.7896 1.84855 2.43677 2.14558 2.1455C2.43706 1.84872 2.78983 1.61918 3.17925 1.47292C3.55141 1.32825 3.97375 1.23083 4.59558 1.20167C5.21741 1.17425 5.41516 1.16667 7.00008 1.16667ZM7.00008 4.08333C6.22653 4.08333 5.48467 4.39062 4.93769 4.9376C4.39071 5.48459 4.08341 6.22645 4.08341 7C4.08341 7.77355 4.39071 8.51541 4.93769 9.06239C5.48467 9.60938 6.22653 9.91667 7.00008 9.91667C7.77363 9.91667 8.51549 9.60938 9.06248 9.06239C9.60946 8.51541 9.91675 7.77355 9.91675 7C9.91675 6.22645 9.60946 5.48459 9.06248 4.9376C8.51549 4.39062 7.77363 4.08333 7.00008 4.08333ZM10.7917 3.9375C10.7917 3.74411 10.7149 3.55865 10.5782 3.4219C10.4414 3.28516 10.256 3.20833 10.0626 3.20833C9.86919 3.20833 9.68373 3.28516 9.54698 3.4219C9.41024 3.55865 9.33341 3.74411 9.33341 3.9375C9.33341 4.13089 9.41024 4.31635 9.54698 4.4531C9.68373 4.58984 9.86919 4.66667 10.0626 4.66667C10.256 4.66667 10.4414 4.58984 10.5782 4.4531C10.7149 4.31635 10.7917 4.13089 10.7917 3.9375ZM7.00008 5.25C7.46421 5.25 7.90933 5.43437 8.23752 5.76256C8.56571 6.09075 8.75008 6.53587 8.75008 7C8.75008 7.46413 8.56571 7.90925 8.23752 8.23744C7.90933 8.56563 7.46421 8.75 7.00008 8.75C6.53595 8.75 6.09083 8.56563 5.76264 8.23744C5.43446 7.90925 5.25008 7.46413 5.25008 7C5.25008 6.53587 5.43446 6.09075 5.76264 5.76256C6.09083 5.43437 6.53595 5.25 7.00008 5.25Z"
				fill = "currentColor" />
				</svg>';
			break;

			case 'twitter': 
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M13.1018 3.5C12.6526 3.70417 12.1684 3.83834 11.6668 3.9025C12.1801 3.59334 12.5768 3.10334 12.7634 2.51417C12.2793 2.80584 11.7426 3.01 11.1768 3.12667C10.7159 2.625 10.0684 2.33334 9.33344 2.33334C7.9626 2.33334 6.8426 3.45334 6.8426 4.83584C6.8426 5.03417 6.86594 5.22667 6.90677 5.4075C4.8301 5.3025 2.98094 4.305 1.7501 2.79417C1.53427 3.16167 1.41177 3.59334 1.41177 4.04834C1.41177 4.9175 1.84927 5.6875 2.52594 6.125C2.11177 6.125 1.72677 6.00834 1.38844 5.83334V5.85084C1.38844 7.06417 2.25177 8.07917 3.3951 8.30667C3.02803 8.40712 2.64266 8.4211 2.26927 8.3475C2.42771 8.84478 2.738 9.27991 3.15653 9.59171C3.57506 9.90352 4.08078 10.0763 4.6026 10.0858C3.71805 10.7861 2.6216 11.1646 1.49344 11.1592C1.2951 11.1592 1.09677 11.1475 0.898438 11.1242C2.00677 11.8358 3.3251 12.25 4.73677 12.25C9.33344 12.25 11.8593 8.435 11.8593 5.1275C11.8593 5.01667 11.8593 4.91167 11.8534 4.80084C12.3434 4.45084 12.7634 4.0075 13.1018 3.5Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'linkedin': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
				<path
				d    = "M3.61491 2.97482C3.61475 3.2995 3.48562 3.61082 3.25592 3.84028C3.02622 4.06975 2.71478 4.19858 2.3901 4.19841C2.06542 4.19825 1.7541 4.06912 1.52463 3.83942C1.29516 3.60972 1.16634 3.29828 1.1665 2.9736C1.16667 2.64892 1.2958 2.3376 1.5255 2.10813C1.7552 1.87866 2.06664 1.74984 2.39132 1.75C2.716 1.75017 3.02732 1.8793 3.25678 2.109C3.48625 2.3387 3.61508 2.65014 3.61491 2.97482ZM3.65164 5.10494H1.20323V12.7685H3.65164V5.10494ZM7.52012 5.10494H5.08396V12.7685H7.49564V8.74694C7.49564 6.50665 10.4154 6.29854 10.4154 8.74694V12.7685H12.8332V7.91448C12.8332 4.13781 8.51173 4.2786 7.49564 6.13327L7.52012 5.10494Z"
				fill = "currentColor" />
				</svg>';
			break;

			case 'pinterest': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
				<path
				d    = "M5.27317 12.565C5.83317 12.7342 6.399 12.8333 6.99984 12.8333C8.54693 12.8333 10.0307 12.2188 11.1246 11.1248C12.2186 10.0308 12.8332 8.5471 12.8332 7C12.8332 6.23396 12.6823 5.47541 12.3891 4.76768C12.096 4.05995 11.6663 3.41689 11.1246 2.87521C10.583 2.33354 9.93989 1.90386 9.23216 1.6107C8.52442 1.31755 7.76588 1.16667 6.99984 1.16667C6.23379 1.16667 5.47525 1.31755 4.76752 1.6107C4.05978 1.90386 3.41672 2.33354 2.87505 2.87521C1.78109 3.96917 1.1665 5.4529 1.1665 7C1.1665 9.47917 2.724 11.6083 4.92317 12.4483C4.87067 11.9933 4.81817 11.2408 4.92317 10.7217L5.594 7.84C5.594 7.84 5.42484 7.50167 5.42484 6.965C5.42484 6.16 5.9265 5.55917 6.49817 5.55917C6.99984 5.55917 7.23317 5.92667 7.23317 6.39917C7.23317 6.90083 6.90067 7.61833 6.7315 8.30667C6.63234 8.87833 7.03484 9.38 7.61817 9.38C8.6565 9.38 9.4615 8.27167 9.4615 6.70833C9.4615 5.30833 8.45817 4.35167 7.01734 4.35167C5.37234 4.35167 4.404 5.57667 4.404 6.86583C4.404 7.3675 4.56734 7.875 4.83567 8.2075C4.88817 8.2425 4.88817 8.28917 4.87067 8.37667L4.7015 9.0125C4.7015 9.11167 4.63734 9.14667 4.53817 9.07667C3.7915 8.75 3.35984 7.68833 3.35984 6.83083C3.35984 4.9875 4.6665 3.31333 7.1865 3.31333C9.19317 3.31333 10.7565 4.75417 10.7565 6.6675C10.7565 8.67417 9.514 10.2842 7.73484 10.2842C7.169 10.2842 6.61484 9.98083 6.4165 9.625L6.02567 11.0075C5.8915 11.5092 5.524 12.18 5.27317 12.5825V12.565Z"
				fill = "currentColor" />
				</svg>';
			break;

			case 'location': 
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="location"><path id="Vector" d="M10.1273 10.1592C10.5944 10.1592 10.9944 9.99278 11.3273 9.65987C11.6596 9.32753 11.8258 8.92781 11.8258 8.46072C11.8258 7.99363 11.6596 7.59363 11.3273 7.26072C10.9944 6.92838 10.5944 6.76221 10.1273 6.76221C9.66022 6.76221 9.2605 6.92838 8.92816 7.26072C8.59525 7.59363 8.42879 7.99363 8.42879 8.46072C8.42879 8.92781 8.59525 9.32753 8.92816 9.65987C9.2605 9.99278 9.66022 10.1592 10.1273 10.1592ZM10.1273 16.4013C11.8541 14.816 13.1351 13.3757 13.9702 12.0803C14.8053 10.7854 15.2228 9.63553 15.2228 8.63057C15.2228 7.08776 14.7308 5.82435 13.7468 4.84034C12.7634 3.8569 11.5569 3.36518 10.1273 3.36518C8.69772 3.36518 7.49093 3.8569 6.50693 4.84034C5.52349 5.82435 5.03177 7.08776 5.03177 8.63057C5.03177 9.63553 5.44932 10.7854 6.28442 12.0803C7.11952 13.3757 8.40049 14.816 10.1273 16.4013ZM10.1273 18.3333C10.0141 18.3333 9.90084 18.3121 9.7876 18.2696C9.67437 18.2272 9.57529 18.1706 9.49036 18.0998C7.42384 16.2739 5.88102 14.5791 4.86191 13.0153C3.84281 11.451 3.33325 9.98939 3.33325 8.63057C3.33325 6.50743 4.01634 4.81599 5.38251 3.55626C6.74811 2.29653 8.32971 1.66667 10.1273 1.66667C11.9249 1.66667 13.5065 2.29653 14.8721 3.55626C16.2383 4.81599 16.9214 6.50743 16.9214 8.63057C16.9214 9.98939 16.4118 11.451 15.3927 13.0153C14.3736 14.5791 12.8308 16.2739 10.7643 18.0998C10.6793 18.1706 10.5802 18.2272 10.467 18.2696C10.3538 18.3121 10.2405 18.3333 10.1273 18.3333Z" fill="currentColor" /></g></svg>';
			break;

			case 'phone': 
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="phone"><path id="Vector" d="M16.6667 12.9167C15.6667 12.9167 14.5833 12.75 13.6667 12.4167H13.4167C13.1667 12.4167 13 12.5 12.8333 12.6667L11 14.5C8.66667 13.25 6.66667 11.3333 5.5 9L7.33333 7.16667C7.58333 6.91667 7.66667 6.58333 7.5 6.33333C7.25 5.41667 7.08333 4.33333 7.08333 3.33333C7.08333 2.91667 6.66667 2.5 6.25 2.5H3.33333C2.91667 2.5 2.5 2.91667 2.5 3.33333C2.5 11.1667 8.83333 17.5 16.6667 17.5C17.0833 17.5 17.5 17.0833 17.5 16.6667V13.75C17.5 13.3333 17.0833 12.9167 16.6667 12.9167ZM4.16667 4.16667H5.41667C5.5 4.91667 5.66667 5.66667 5.83333 6.33333L4.83333 7.33333C4.5 6.33333 4.25 5.25 4.16667 4.16667ZM15.8333 15.8333C14.75 15.75 13.6667 15.5 12.6667 15.1667L13.6667 14.1667C14.3333 14.3333 15.0833 14.5 15.8333 14.5V15.8333Z" fill="currentColor" /></g></svg>';
			break;

			case 'email': 
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M18.3334 5C18.3334 4.08333 17.5834 3.33333 16.6667 3.33333H3.33341C2.41675 3.33333 1.66675 4.08333 1.66675 5V15C1.66675 15.9167 2.41675 16.6667 3.33341 16.6667H16.6667C17.5834 16.6667 18.3334 15.9167 18.3334 15V5ZM16.6667 5L10.0001 9.15833L3.33341 5H16.6667ZM16.6667 15H3.33341V6.66667L10.0001 10.8333L16.6667 6.66667V15Z" fill="currentColor" /> </svg>';
			break;

			case 'readmore-button-arrow': 
				return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "chevron">
				<path id = "Vector" d = "M6.69728 3.88034L10.4428 7.45582C10.5243 7.53355 10.5818 7.61776 10.6155 7.70844C10.6496 7.79912 10.6667 7.89628 10.6667 7.99992C10.6667 8.10356 10.6496 8.20072 10.6155 8.2914C10.5818 8.38208 10.5243 8.46629 10.4428 8.54401L6.69728 12.1195C6.548 12.262 6.35801 12.3333 6.12731 12.3333C5.8966 12.3333 5.70661 12.262 5.55733 12.1195C5.40805 11.977 5.33341 11.7956 5.33341 11.5754C5.33341 11.3552 5.40805 11.1738 5.55733 11.0313L8.73291 7.99992L5.55733 4.96853C5.40805 4.82603 5.33341 4.64466 5.33341 4.42443C5.33341 4.2042 5.40805 4.02284 5.55733 3.88034C5.70661 3.73784 5.8966 3.66659 6.12731 3.66659C6.35801 3.66659 6.548 3.73784 6.69728 3.88034Z" fill = "currentColor" />
				</g>
				</svg>';
			break;

			case 'topbar-headerthree': 
				return '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M10.0003 16.6666C13.667 16.6666 16.667 13.6666 16.667 9.99996C16.667 6.33329 13.667 3.33329 10.0003 3.33329C6.33366 3.33329 3.33366 6.33329 3.33366 9.99996C3.33366 13.6666 6.33366 16.6666 10.0003 16.6666ZM10.0003 1.66663C14.5837 1.66663 18.3337 5.41663 18.3337 9.99996C18.3337 14.5833 14.5837 18.3333 10.0003 18.3333C5.41699 18.3333 1.66699 14.5833 1.66699 9.99996C1.66699 5.41663 5.41699 1.66663 10.0003 1.66663ZM14.167 11.5833L13.5837 12.6666L9.16699 10.25V5.83329H10.417V9.49996L14.167 11.5833Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'date-after-dot': 
				return '<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle id = "Ellipse 20" cx = "2" cy = "2" r = "2" fill = "currentColor" />
				</svg>';
			break;
			
			case 'video-play-button': 
				return '<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g      id = "Frame 72">
				<circle id = "Ellipse 2" cx = "40" cy                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  = "40" r = "39" stroke = "white" stroke-width = "2" />
				<circle id = "Ellipse 1" cx = "40" cy                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  = "40" r = "34" fill   = "white" />
				<path   id = "Vector" d     = "M47.7723 37.9016C48.4169 38.2912 48.8091 38.9774 48.8091 39.7167C48.8091 40.456 48.4169 41.1422 47.7723 41.492L34.7919 49.2836C34.1239 49.7219 33.2877 49.7396 32.6053 49.3633C32.2698 49.1785 31.9906 48.9092 31.7964 48.5831C31.6021 48.2571 31.4998 47.8861 31.5 47.5084V31.9251C31.5001 31.5475 31.6025 31.1768 31.7967 30.8511C31.991 30.5253 32.27 30.2562 32.6053 30.0714C32.9405 29.8869 33.3198 29.7933 33.7041 29.8004C34.0884 29.8075 34.4639 29.9149 34.7919 30.1117L47.7723 37.9016Z" fill = "currentColor" />
				</g>
				</svg>';
			break;

			case 'service-readmore-icon': 
				return ' <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g    id = "chevron">
				<path id = "Vector" d = "M6.69728 3.88034L10.4428 7.45582C10.5243 7.53355 10.5818 7.61776 10.6155 7.70844C10.6496 7.79912 10.6667 7.89628 10.6667 7.99992C10.6667 8.10356 10.6496 8.20072 10.6155 8.2914C10.5818 8.38208 10.5243 8.46629 10.4428 8.54401L6.69728 12.1195C6.548 12.262 6.35801 12.3333 6.12731 12.3333C5.8966 12.3333 5.70661 12.262 5.55733 12.1195C5.40805 11.977 5.33341 11.7956 5.33341 11.5754C5.33341 11.3552 5.40805 11.1738 5.55733 11.0313L8.73291 7.99992L5.55733 4.96853C5.40805 4.82603 5.33341 4.64466 5.33341 4.42443C5.33341 4.2042 5.40805 4.02284 5.55733 3.88034C5.70661 3.73784 5.8966 3.66659 6.12731 3.66659C6.35801 3.66659 6.548 3.73784 6.69728 3.88034Z" fill = "currentColor" />
				</g>
				</svg>';
			break;
				
			case 'contact-phone-icon': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
				<path d = "M26.6667 20.6667C25.0667 20.6667 23.3333 20.4 21.8667 19.8667H21.4667C21.0667 19.8667 20.8 20 20.5333 20.2667L17.6 23.2C13.8667 21.2 10.6667 18.1333 8.8 14.4L11.7333 11.4667C12.1333 11.0667 12.2667 10.5333 12 10.1333C11.6 8.66667 11.3333 6.93333 11.3333 5.33333C11.3333 4.66667 10.6667 4 10 4H5.33333C4.66667 4 4 4.66667 4 5.33333C4 17.8667 14.1333 28 26.6667 28C27.3333 28 28 27.3333 28 26.6667V22C28 21.3333 27.3333 20.6667 26.6667 20.6667ZM6.66667 6.66667H8.66667C8.8 7.86667 9.06667 9.06667 9.33333 10.1333L7.73333 11.7333C7.2 10.1333 6.8 8.4 6.66667 6.66667ZM25.3333 25.3333C23.6 25.2 21.8667 24.8 20.2667 24.2667L21.8667 22.6667C22.9333 22.9333 24.1333 23.2 25.3333 23.2V25.3333Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'contact-location-icon': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
							<path d = "M16.2039 16.2548C16.9512 16.2548 17.5912 15.9885 18.1239 15.4558C18.6556 14.9241 18.9215 14.2845 18.9215 13.5372C18.9215 12.7898 18.6556 12.1498 18.1239 11.6172C17.5912 11.0854 16.9512 10.8196 16.2039 10.8196C15.4565 10.8196 14.817 11.0854 14.2852 11.6172C13.7526 12.1498 13.4862 12.7898 13.4862 13.5372C13.4862 14.2845 13.7526 14.9241 14.2852 15.4558C14.817 15.9885 15.4565 16.2548 16.2039 16.2548ZM16.2039 26.2421C18.9668 23.7056 21.0163 21.4011 22.3525 19.3284C23.6886 17.2567 24.3567 15.4169 24.3567 13.8089C24.3567 11.3404 23.5695 9.31897 21.9951 7.74456C20.4216 6.17106 18.4912 5.38431 16.2039 5.38431C13.9165 5.38431 11.9857 6.17106 10.4113 7.74456C8.83775 9.31897 8.051 11.3404 8.051 13.8089C8.051 15.4169 8.71908 17.2567 10.0552 19.3284C11.3914 21.4011 13.4409 23.7056 16.2039 26.2421ZM16.2039 29.3334C16.0227 29.3334 15.8415 29.2994 15.6603 29.2314C15.4792 29.1635 15.3206 29.0729 15.1848 28.9597C11.8783 26.0382 9.40981 23.3265 7.77923 20.8245C6.14866 18.3216 5.33337 15.983 5.33337 13.8089C5.33337 10.4119 6.42631 7.70561 8.61219 5.69004C10.7972 3.67447 13.3277 2.66669 16.2039 2.66669C19.08 2.66669 21.6106 3.67447 23.7955 5.69004C25.9814 7.70561 27.0744 10.4119 27.0744 13.8089C27.0744 15.983 26.2591 18.3216 24.6285 20.8245C22.9979 23.3265 20.5294 26.0382 17.223 28.9597C17.0871 29.0729 16.9286 29.1635 16.7474 29.2314C16.5662 29.2994 16.385 29.3334 16.2039 29.3334Z" fill = "currentColor"/>
						</svg>';
			break;

			case 'contact-email-icon': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
							<path d = "M29.3334 7.99998C29.3334 6.53331 28.1334 5.33331 26.6667 5.33331H5.33341C3.86675 5.33331 2.66675 6.53331 2.66675 7.99998V24C2.66675 25.4666 3.86675 26.6666 5.33341 26.6666H26.6667C28.1334 26.6666 29.3334 25.4666 29.3334 24V7.99998ZM26.6667 7.99998L16.0001 14.6533L5.33341 7.99998H26.6667ZM26.6667 24H5.33341V10.6666L16.0001 17.3333L26.6667 10.6666V24Z" fill = "currentColor"/>
						</svg>';
			break;

			case 'discord': 
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M11.2407 3.10917C10.4649 2.7475 9.62491 2.485 8.74991 2.33333C8.74223 2.33309 8.7346 2.33453 8.72755 2.33755C8.72049 2.34058 8.71419 2.34511 8.70907 2.35083C8.60407 2.54333 8.48157 2.79417 8.39991 2.98667C7.47182 2.84667 6.52799 2.84667 5.59991 2.98667C5.51824 2.78833 5.39574 2.54333 5.28491 2.35083C5.27907 2.33917 5.26157 2.33333 5.24407 2.33333C4.36907 2.485 3.53491 2.7475 2.75324 3.10917C2.74741 3.10917 2.74157 3.115 2.73574 3.12083C1.14907 5.495 0.711572 7.805 0.927406 10.0917C0.927406 10.1033 0.933239 10.115 0.944906 10.1208C1.99491 10.8908 3.00407 11.3575 4.00157 11.6667C4.01907 11.6725 4.03657 11.6667 4.04241 11.655C4.27574 11.3342 4.48574 10.9958 4.66657 10.64C4.67824 10.6167 4.66657 10.5933 4.64324 10.5875C4.31074 10.4592 3.99574 10.3075 3.68657 10.1325C3.66324 10.1208 3.66324 10.0858 3.68074 10.0683C3.74491 10.0217 3.80907 9.96917 3.87324 9.9225C3.88491 9.91083 3.90241 9.91083 3.91407 9.91667C5.92074 10.8325 8.08491 10.8325 10.0682 9.91667C10.0799 9.91083 10.0974 9.91083 10.1091 9.9225C10.1732 9.975 10.2374 10.0217 10.3016 10.0742C10.3249 10.0917 10.3249 10.1267 10.2957 10.1383C9.9924 10.3192 9.67157 10.465 9.33907 10.5933C9.31574 10.5992 9.30991 10.6283 9.31574 10.6458C9.50241 11.0017 9.71241 11.34 9.93991 11.6608C9.95741 11.6667 9.9749 11.6725 9.9924 11.6667C10.9957 11.3575 12.0049 10.8908 13.0549 10.1208C13.0666 10.115 13.0724 10.1033 13.0724 10.0917C13.3291 7.44917 12.6466 5.15667 11.2641 3.12083C11.2582 3.115 11.2524 3.10917 11.2407 3.10917ZM4.96991 8.6975C4.36907 8.6975 3.86741 8.14333 3.86741 7.46083C3.86741 6.77833 4.35741 6.22417 4.96991 6.22417C5.58824 6.22417 6.07824 6.78417 6.07241 7.46083C6.07241 8.14333 5.58241 8.6975 4.96991 8.6975ZM9.03574 8.6975C8.43491 8.6975 7.93324 8.14333 7.93324 7.46083C7.93324 6.77833 8.42324 6.22417 9.03574 6.22417C9.65407 6.22417 10.1441 6.78417 10.1382 7.46083C10.1382 8.14333 9.65407 8.6975 9.03574 8.6975Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'tripadvisor': 
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M7.0035 2.50542C5.446 2.50542 3.88967 2.96275 2.54392 3.878H0L1.14508 5.12342C0.623353 5.59876 0.25761 6.22081 0.0959002 6.90783C-0.0658095 7.59486 -0.0159218 8.31473 0.23901 8.97288C0.493941 9.63104 0.941993 10.1967 1.5243 10.5955C2.10661 10.9944 2.79595 11.2077 3.50175 11.2076C4.38364 11.2084 5.23306 10.8748 5.87883 10.2743L7 11.4946L8.12117 10.2754C8.76656 10.8754 9.61532 11.2085 10.4965 11.2076C11.4246 11.2076 12.3146 10.839 12.971 10.1829C13.6273 9.52675 13.9962 8.63681 13.9965 7.70875C13.997 7.22203 13.8958 6.74059 13.6992 6.29534C13.5026 5.8501 13.215 5.45091 12.8549 5.12342L14 3.878H11.4625C10.1478 2.983 8.59396 2.50471 7.0035 2.50542ZM7 3.64875C7.89308 3.64875 8.78675 3.8255 9.62733 4.1755C8.13342 4.74717 7 6.08417 7 7.64167C7 6.08358 5.86717 4.74717 4.37267 4.1755C5.20516 3.82853 6.09809 3.64912 7 3.64875ZM3.50117 5.34158C3.8121 5.34158 4.12 5.40283 4.40727 5.52182C4.69453 5.64081 4.95555 5.81522 5.17542 6.03508C5.39528 6.25495 5.56969 6.51597 5.68868 6.80324C5.80767 7.0905 5.86892 7.3984 5.86892 7.70933C5.86892 8.02027 5.80767 8.32816 5.68868 8.61543C5.56969 8.9027 5.39528 9.16372 5.17542 9.38359C4.95555 9.60345 4.69453 9.77786 4.40727 9.89685C4.12 10.0158 3.8121 10.0771 3.50117 10.0771C2.8732 10.0771 2.27095 9.82763 1.82691 9.38359C1.38288 8.93955 1.13342 8.3373 1.13342 7.70933C1.13342 7.08137 1.38288 6.47912 1.82691 6.03508C2.27095 5.59104 2.8732 5.34158 3.50117 5.34158ZM10.4965 5.34275C10.8073 5.34264 11.1151 5.40374 11.4023 5.52258C11.6895 5.64142 11.9505 5.81567 12.1704 6.03537C12.3903 6.25508 12.5647 6.51594 12.6837 6.80305C12.8028 7.09017 12.8641 7.39793 12.8642 7.70875C12.8644 8.01957 12.8033 8.32737 12.6844 8.61458C12.5656 8.90179 12.3913 9.16277 12.1716 9.38264C11.9519 9.60251 11.6911 9.77695 11.4039 9.896C11.1168 10.0151 10.8091 10.0764 10.4982 10.0765C9.87052 10.0767 9.2684 9.82759 8.82436 9.38388C8.38032 8.94017 8.13073 8.33824 8.1305 7.7105C8.13027 7.08277 8.37941 6.48065 8.82312 6.03661C9.26683 5.59257 9.86877 5.34298 10.4965 5.34275ZM3.50117 6.46858C3.17194 6.46858 2.85621 6.59937 2.62341 6.83216C2.39062 7.06496 2.25983 7.3807 2.25983 7.70992C2.25983 8.03914 2.39062 8.35488 2.62341 8.58767C2.85621 8.82047 3.17194 8.95125 3.50117 8.95125C3.83039 8.95125 4.14613 8.82047 4.37892 8.58767C4.61172 8.35488 4.7425 8.03914 4.7425 7.70992C4.7425 7.3807 4.61172 7.06496 4.37892 6.83216C4.14613 6.59937 3.83039 6.46858 3.50117 6.46858ZM10.4965 6.46858C10.1673 6.46858 9.85154 6.59937 9.61874 6.83216C9.38595 7.06496 9.25517 7.3807 9.25517 7.70992C9.25517 8.03914 9.38595 8.35488 9.61874 8.58767C9.85154 8.82047 10.1673 8.95125 10.4965 8.95125C10.8257 8.95125 11.1415 8.82047 11.3743 8.58767C11.6071 8.35488 11.7378 8.03914 11.7378 7.70992C11.7378 7.3807 11.6071 7.06496 11.3743 6.83216C11.1415 6.59937 10.8257 6.46858 10.4965 6.46858Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'foursquare': 
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<mask id = "mask0_1986_9435" style                                                          = "mask-type:luminance" maskUnits = "userSpaceOnUse" x       = "3" y                    = "0" width               = "9" height = "14">
				<path d  = "M11.0833 1.16667H4.08325V12.8333L6.99992 7.58333H9.33325L11.0833 1.16667Z" fill = "white" stroke                  = "white" stroke-width     = "1.16667" stroke-linecap = "round" stroke-linejoin = "round"/>
				<path d  = "M10.2082 4.375H7.2915" stroke                                                   = "black" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
				<path d  = "M10.6853 2.625L9.73071 6.125" stroke                                            = "white" stroke-width            = "1.16667" stroke-linecap = "round" stroke-linejoin  = "round"/>
				</mask>
				<g    mask = "url(#mask0_1986_9435)">
				<path d    = "M0 0H14V14H0V0Z" fill = "currentColor"/>
				</g>
				</svg>';
			break;

			case 'yelp': 
				return '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M3.66456 8.83313L4.30856 8.68438L4.37244 8.66688C4.48319 8.63719 4.58511 8.58116 4.66954 8.50358C4.75397 8.42599 4.81839 8.32915 4.85732 8.2213C4.89624 8.11345 4.90853 7.99779 4.89312 7.88417C4.87771 7.77055 4.83506 7.66234 4.76881 7.56876C4.69722 7.47678 4.60798 7.40002 4.50631 7.34301C4.38622 7.27552 4.261 7.21759 4.13181 7.16976L3.42481 6.91163C3.02836 6.76405 2.63051 6.62025 2.23131 6.48026C1.97144 6.38751 1.75006 6.30701 1.56019 6.24751C1.52431 6.23613 1.48406 6.22563 1.45169 6.21426C1.2809 6.1545 1.10222 6.1203 0.921438 6.11276C0.827291 6.10879 0.733452 6.12598 0.646833 6.16308C0.560213 6.20019 0.48302 6.25624 0.420938 6.32713C0.388702 6.36432 0.35805 6.40286 0.329063 6.44263C0.274222 6.5276 0.228748 6.61825 0.193438 6.71301C0.0621876 7.10063 -0.00343737 7.50751 0.000937634 7.91701C0.00268763 8.28713 0.0123126 8.76226 0.216188 9.08426C0.265281 9.16671 0.330805 9.23819 0.408688 9.29426C0.553938 9.39401 0.700063 9.40713 0.852313 9.41763C1.07981 9.43426 1.30119 9.37826 1.52081 9.32751L3.66194 8.83226L3.66456 8.83313ZM10.8562 5.41101C10.68 5.04187 10.4434 4.70474 10.1562 4.41351C10.0829 4.34374 10.0022 4.28213 9.91556 4.22976C9.87272 4.20665 9.82893 4.18534 9.78431 4.16588C9.69747 4.12952 9.60358 4.11307 9.50955 4.11777C9.41551 4.12246 9.32373 4.14817 9.24094 4.19301C9.11669 4.25426 8.98369 4.35226 8.80694 4.51676C8.78244 4.54126 8.75181 4.56926 8.72469 4.59463C8.57856 4.73113 8.41581 4.90088 8.22244 5.09776C7.92494 5.39876 7.63035 5.70268 7.33869 6.00951L6.81544 6.55201C6.72028 6.65147 6.6331 6.75825 6.55469 6.87138C6.4881 6.96732 6.44139 7.07561 6.41731 7.18988C6.40267 7.27727 6.40474 7.36665 6.42344 7.45326C6.42344 7.45734 6.42431 7.46113 6.42606 7.46463C6.46679 7.64433 6.57589 7.80111 6.73025 7.90173C6.88461 8.00235 7.07209 8.0389 7.25294 8.00363L7.31769 7.99138L10.1046 7.34738C10.3242 7.29663 10.5473 7.24938 10.7451 7.13563C10.8772 7.05863 11.0032 6.98251 11.0898 6.82938C11.1355 6.74466 11.1632 6.65142 11.1712 6.55551C11.2149 6.17576 11.0154 5.74438 10.8562 5.41101ZM5.86781 6.58263C6.06906 6.32888 6.06906 5.95088 6.08656 5.64201C6.14781 4.60863 6.21169 3.57526 6.26244 2.54188C6.28169 2.14988 6.32369 1.76313 6.30094 1.36938C6.28169 1.04388 6.27906 0.670259 6.07344 0.403384C5.71206 -0.0673664 4.93856 -0.0288664 4.41006 0.0437586C4.2479 0.0659253 4.0866 0.0962586 3.92619 0.134759C3.76633 0.172628 3.60786 0.216113 3.45106 0.265134C2.94356 0.431384 2.23219 0.735009 2.11231 1.31863C2.04406 1.64851 2.20506 1.98626 2.33019 2.28726C2.48156 2.65213 2.68894 2.98026 2.87706 3.32413C3.37581 4.23063 3.88331 5.13188 4.38906 6.03401C4.53956 6.30351 4.70406 6.64388 4.99719 6.78388C5.01644 6.79263 5.03627 6.79993 5.05669 6.80576C5.18794 6.85563 5.33056 6.86526 5.46706 6.83376L5.49156 6.82763C5.61783 6.79381 5.7321 6.72531 5.82144 6.62988L5.86781 6.58263ZM5.62631 9.34851C5.53732 9.22479 5.40753 9.13643 5.25981 9.09898C5.11208 9.06153 4.95588 9.07738 4.81869 9.14376C4.77423 9.16634 4.73178 9.19269 4.69181 9.22251C4.57846 9.31282 4.47676 9.41687 4.38906 9.53226C4.36631 9.56113 4.34531 9.59963 4.31906 9.62326L3.87106 10.2401C3.61731 10.5849 3.36619 10.9328 3.11769 11.284C2.95581 11.5115 2.81494 11.7031 2.70469 11.8729L2.64169 11.9691C2.50869 12.1748 2.43344 12.3244 2.39494 12.4583C2.3654 12.5467 2.35642 12.6406 2.36869 12.733C2.38006 12.8293 2.41244 12.9229 2.46319 13.006C2.49002 13.0468 2.51919 13.0871 2.55069 13.1268C2.61785 13.2039 2.69325 13.2734 2.77556 13.3341C3.34679 13.7202 4.00939 13.9495 4.69706 13.9991C4.79941 14.0024 4.90182 13.9945 5.00244 13.9755C5.05055 13.9635 5.09814 13.9495 5.14506 13.9335C5.23609 13.8991 5.31894 13.846 5.38831 13.7778C5.45497 13.7125 5.50585 13.6329 5.53706 13.545C5.58869 13.4164 5.62281 13.2519 5.64469 13.0086L5.65519 12.8949C5.67269 12.6928 5.68144 12.4556 5.69456 12.1765C5.71615 11.7478 5.73365 11.3193 5.74706 10.8911L5.77594 10.1299C5.7872 9.94679 5.77097 9.76305 5.72781 9.58476C5.70552 9.50139 5.6719 9.42178 5.62631 9.34851ZM10.6864 10.5403C10.5577 10.4098 10.4109 10.2985 10.2507 10.2095L10.1527 10.1509C9.97856 10.0459 9.76944 9.93563 9.52356 9.80263C9.14789 9.59672 8.77019 9.39401 8.39044 9.19451L7.71931 8.83838C7.68431 8.82788 7.64931 8.80338 7.61606 8.78676C7.48668 8.72165 7.34972 8.67286 7.20831 8.64151C7.15927 8.63202 7.1095 8.62675 7.05956 8.62576C6.90733 8.62669 6.76029 8.68123 6.64428 8.77981C6.52827 8.87838 6.45069 9.01468 6.42519 9.16476C6.41549 9.25018 6.41844 9.33657 6.43394 9.42113C6.46719 9.59963 6.54769 9.77638 6.62994 9.93126L6.98869 10.6033C7.1876 10.9824 7.3906 11.3598 7.59769 11.7355C7.73069 11.9805 7.84269 12.1905 7.94594 12.3646C7.96694 12.3979 7.98677 12.4305 8.00544 12.4626C8.13231 12.6718 8.23381 12.8039 8.33706 12.8975C8.40538 12.9638 8.48767 13.0141 8.5779 13.0445C8.66813 13.0749 8.76402 13.0848 8.85856 13.0734C8.9079 13.067 8.95694 13.0586 9.00556 13.048C9.10419 13.0209 9.19955 12.983 9.28994 12.9351C9.56322 12.7827 9.81484 12.5944 10.0381 12.3751C10.3058 12.1126 10.5429 11.8239 10.7276 11.4949C10.7538 11.4482 10.776 11.4001 10.7941 11.3505C10.8109 11.3042 10.8258 11.2572 10.8387 11.2096C10.8498 11.1612 10.8582 11.1122 10.8641 11.0626C10.8729 10.966 10.8616 10.8685 10.8308 10.7765C10.8013 10.6878 10.752 10.607 10.6864 10.5403Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'hacker_news': 
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M2.4375 2.1875V11.8125H12.0625V2.1875H2.4375ZM3.3125 3.0625H11.1875V10.9375H3.3125V3.0625ZM5.28125 4.8125L6.8125 7.4375V9.625H7.6875V7.4375L9.21875 4.8125H8.34375L7.25 6.68544L6.15625 4.8125H5.28125Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'xing': 
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M12.1861 1.88417C12.2759 1.88417 12.3658 1.92967 12.4101 1.97458C12.4322 2.01597 12.4437 2.06214 12.4437 2.10904C12.4437 2.15594 12.4322 2.20212 12.4101 2.2435L8.86577 8.526L11.1093 12.6537C11.1314 12.6951 11.143 12.7414 11.143 12.7884C11.143 12.8354 11.1314 12.8817 11.1093 12.9232C11.0478 12.9794 10.968 13.0113 10.8847 13.013H9.26886C9.04486 13.013 8.91069 12.8333 8.82086 12.6986L6.53244 8.52542C6.66661 8.34633 10.1223 2.19917 10.1223 2.19917C10.2115 2.0195 10.3463 1.88533 10.5709 1.88533L12.1861 1.88417ZM5.45502 4.08333C5.67961 4.08333 5.81436 4.263 5.90419 4.39717L7.02594 6.32683C6.93611 6.41667 5.27594 9.37767 5.27594 9.37767C5.18611 9.513 5.05136 9.69267 4.82677 9.69267H3.25702C3.17394 9.69085 3.09434 9.65892 3.03302 9.60283C3.01086 9.56138 2.99927 9.51509 2.99927 9.46808C2.99927 9.42107 3.01086 9.37479 3.03302 9.33333L4.69319 6.32683L3.61636 4.44267C3.5942 4.40121 3.5826 4.35493 3.5826 4.30792C3.5826 4.26091 3.5942 4.21462 3.61636 4.17317C3.67753 4.11721 3.75689 4.08529 3.83977 4.08333H5.45502Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'flipboard': 
				return '<svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d = "M0.25 0H4.74167V14H0.25V0ZM5.20833 4.95833H9.75833V9.50833H5.20833V4.95833ZM5.20833 0H14.25V4.49167H5.20833V0Z" fill = "currentColor"/>
				</svg>';
			break;

			case 'calendar': 
				return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
				<path d = "M8 9.33337C7.81111 9.33337 7.65289 9.26937 7.52533 9.14137C7.39733 9.01382 7.33333 8.8556 7.33333 8.66671C7.33333 8.47782 7.39733 8.31937 7.52533 8.19137C7.65289 8.06382 7.81111 8.00004 8 8.00004C8.18889 8.00004 8.34733 8.06382 8.47533 8.19137C8.60289 8.31937 8.66667 8.47782 8.66667 8.66671C8.66667 8.8556 8.60289 9.01382 8.47533 9.14137C8.34733 9.26937 8.18889 9.33337 8 9.33337ZM5.33333 9.33337C5.14444 9.33337 4.986 9.26937 4.858 9.14137C4.73044 9.01382 4.66667 8.8556 4.66667 8.66671C4.66667 8.47782 4.73044 8.31937 4.858 8.19137C4.986 8.06382 5.14444 8.00004 5.33333 8.00004C5.52222 8.00004 5.68067 8.06382 5.80867 8.19137C5.93622 8.31937 6 8.47782 6 8.66671C6 8.8556 5.93622 9.01382 5.80867 9.14137C5.68067 9.26937 5.52222 9.33337 5.33333 9.33337ZM10.6667 9.33337C10.4778 9.33337 10.3196 9.26937 10.192 9.14137C10.064 9.01382 10 8.8556 10 8.66671C10 8.47782 10.064 8.31937 10.192 8.19137C10.3196 8.06382 10.4778 8.00004 10.6667 8.00004C10.8556 8.00004 11.0138 8.06382 11.1413 8.19137C11.2693 8.31937 11.3333 8.47782 11.3333 8.66671C11.3333 8.8556 11.2693 9.01382 11.1413 9.14137C11.0138 9.26937 10.8556 9.33337 10.6667 9.33337ZM8 12C7.81111 12 7.65289 11.936 7.52533 11.808C7.39733 11.6805 7.33333 11.5223 7.33333 11.3334C7.33333 11.1445 7.39733 10.9863 7.52533 10.8587C7.65289 10.7307 7.81111 10.6667 8 10.6667C8.18889 10.6667 8.34733 10.7307 8.47533 10.8587C8.60289 10.9863 8.66667 11.1445 8.66667 11.3334C8.66667 11.5223 8.60289 11.6805 8.47533 11.808C8.34733 11.936 8.18889 12 8 12ZM5.33333 12C5.14444 12 4.986 11.936 4.858 11.808C4.73044 11.6805 4.66667 11.5223 4.66667 11.3334C4.66667 11.1445 4.73044 10.9863 4.858 10.8587C4.986 10.7307 5.14444 10.6667 5.33333 10.6667C5.52222 10.6667 5.68067 10.7307 5.80867 10.8587C5.93622 10.9863 6 11.1445 6 11.3334C6 11.5223 5.93622 11.6805 5.80867 11.808C5.68067 11.936 5.52222 12 5.33333 12ZM10.6667 12C10.4778 12 10.3196 11.936 10.192 11.808C10.064 11.6805 10 11.5223 10 11.3334C10 11.1445 10.064 10.9863 10.192 10.8587C10.3196 10.7307 10.4778 10.6667 10.6667 10.6667C10.8556 10.6667 11.0138 10.7307 11.1413 10.8587C11.2693 10.9863 11.3333 11.1445 11.3333 11.3334C11.3333 11.5223 11.2693 11.6805 11.1413 11.808C11.0138 11.936 10.8556 12 10.6667 12ZM3.33333 14.6667C2.96667 14.6667 2.65267 14.5363 2.39133 14.2754C2.13044 14.014 2 13.7 2 13.3334V4.00004C2 3.63337 2.13044 3.3196 2.39133 3.05871C2.65267 2.79737 2.96667 2.66671 3.33333 2.66671H4V2.00004C4 1.81115 4.06378 1.65271 4.19133 1.52471C4.31933 1.39715 4.47778 1.33337 4.66667 1.33337C4.85556 1.33337 5.014 1.39715 5.142 1.52471C5.26956 1.65271 5.33333 1.81115 5.33333 2.00004V2.66671H10.6667V2.00004C10.6667 1.81115 10.7307 1.65271 10.8587 1.52471C10.9862 1.39715 11.1444 1.33337 11.3333 1.33337C11.5222 1.33337 11.6804 1.39715 11.808 1.52471C11.936 1.65271 12 1.81115 12 2.00004V2.66671H12.6667C13.0333 2.66671 13.3473 2.79737 13.6087 3.05871C13.8696 3.3196 14 3.63337 14 4.00004V13.3334C14 13.7 13.8696 14.014 13.6087 14.2754C13.3473 14.5363 13.0333 14.6667 12.6667 14.6667H3.33333ZM3.33333 13.3334H12.6667V6.66671H3.33333V13.3334ZM3.33333 5.33337H12.6667V4.00004H3.33333V5.33337Z" fill = "currentColor"></path>
				</svg>';
			break;

			case 'comment':
				return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<mask id="path-1-inside-1_2572_8281" fill="white">
				<path d="M7.99991 1.3335C7.12443 1.3335 6.25752 1.50593 5.44869 1.84097C4.63985 2.176 3.90492 2.66706 3.28587 3.28612C2.03562 4.53636 1.33324 6.23205 1.33324 8.00016C1.32742 9.53959 1.86044 11.0325 2.83991 12.2202L1.50658 13.5535C1.41407 13.6472 1.35141 13.7663 1.32649 13.8956C1.30158 14.0249 1.31552 14.1588 1.36658 14.2802C1.42195 14.4001 1.51171 14.5009 1.62448 14.5698C1.73724 14.6386 1.86791 14.6724 1.99991 14.6668H7.99991C9.76802 14.6668 11.4637 13.9645 12.714 12.7142C13.9642 11.464 14.6666 9.76827 14.6666 8.00016C14.6666 6.23205 13.9642 4.53636 12.714 3.28612C11.4637 2.03588 9.76802 1.3335 7.99991 1.3335ZM7.99991 13.3335H3.60658L4.22658 12.7135C4.35074 12.5886 4.42044 12.4196 4.42044 12.2435C4.42044 12.0674 4.35074 11.8984 4.22658 11.7735C3.35363 10.9015 2.81003 9.75386 2.68837 8.52603C2.56672 7.2982 2.87454 6.06617 3.5594 5.03984C4.24425 4.01352 5.26377 3.2564 6.44425 2.89748C7.62474 2.53855 8.89315 2.60003 10.0334 3.07144C11.1736 3.54284 12.1151 4.39501 12.6975 5.48276C13.2799 6.5705 13.4672 7.82653 13.2273 9.03683C12.9875 10.2471 12.3354 11.3369 11.3823 12.1203C10.4291 12.9038 9.23375 13.3325 7.99991 13.3335Z"/>
				</mask>
				<path d="M7.99991 1.3335C7.12443 1.3335 6.25752 1.50593 5.44869 1.84097C4.63985 2.176 3.90492 2.66706 3.28587 3.28612C2.03562 4.53636 1.33324 6.23205 1.33324 8.00016C1.32742 9.53959 1.86044 11.0325 2.83991 12.2202L1.50658 13.5535C1.41407 13.6472 1.35141 13.7663 1.32649 13.8956C1.30158 14.0249 1.31552 14.1588 1.36658 14.2802C1.42195 14.4001 1.51171 14.5009 1.62448 14.5698C1.73724 14.6386 1.86791 14.6724 1.99991 14.6668H7.99991C9.76802 14.6668 11.4637 13.9645 12.714 12.7142C13.9642 11.464 14.6666 9.76827 14.6666 8.00016C14.6666 6.23205 13.9642 4.53636 12.714 3.28612C11.4637 2.03588 9.76802 1.3335 7.99991 1.3335ZM7.99991 13.3335H3.60658L4.22658 12.7135C4.35074 12.5886 4.42044 12.4196 4.42044 12.2435C4.42044 12.0674 4.35074 11.8984 4.22658 11.7735C3.35363 10.9015 2.81003 9.75386 2.68837 8.52603C2.56672 7.2982 2.87454 6.06617 3.5594 5.03984C4.24425 4.01352 5.26377 3.2564 6.44425 2.89748C7.62474 2.53855 8.89315 2.60003 10.0334 3.07144C11.1736 3.54284 12.1151 4.39501 12.6975 5.48276C13.2799 6.5705 13.4672 7.82653 13.2273 9.03683C12.9875 10.2471 12.3354 11.3369 11.3823 12.1203C10.4291 12.9038 9.23375 13.3325 7.99991 13.3335Z" fill="currentColor"/>
				<path d="M7.99991 1.3335V2.8335V1.3335ZM1.33324 8.00016L2.83324 8.00584V8.00016H1.33324ZM2.83991 12.2202L3.90057 13.2808L4.86423 12.3172L3.99713 11.2658L2.83991 12.2202ZM1.50658 13.5535L0.445894 12.4928L0.438856 12.4999L1.50658 13.5535ZM1.36658 14.2802L-0.0161439 14.8616L-0.00613952 14.8854L0.00467741 14.9088L1.36658 14.2802ZM1.99991 14.6668V13.1668H1.96835L1.93681 13.1682L1.99991 14.6668ZM7.99991 13.3335V14.8335L8.00109 14.8335L7.99991 13.3335ZM3.60658 13.3335L2.54592 12.2728L-0.014743 14.8335H3.60658V13.3335ZM4.22658 12.7135L5.28724 13.7742L5.29039 13.771L4.22658 12.7135ZM4.42044 12.2435H5.92044H4.42044ZM4.22658 11.7735L5.29039 10.716L5.28665 10.7122L4.22658 11.7735ZM7.99991 -0.166504C6.92745 -0.166504 5.86549 0.0447332 4.87466 0.455147L6.02271 3.22679C6.64956 2.96714 7.32141 2.8335 7.99991 2.8335V-0.166504ZM4.87466 0.455147C3.88384 0.86556 2.98355 1.46711 2.22521 2.22546L4.34653 4.34678C4.82629 3.86701 5.39586 3.48643 6.02271 3.22679L4.87466 0.455147ZM2.22521 2.22546C0.693658 3.757 -0.166756 5.83423 -0.166756 8.00016H2.83324C2.83324 6.62988 3.37759 5.31572 4.34653 4.34678L2.22521 2.22546ZM-0.166745 7.99448C-0.173899 9.88413 0.480388 11.7167 1.68269 13.1745L3.99713 11.2658C3.24049 10.3483 2.82873 9.19504 2.83323 8.00584L-0.166745 7.99448ZM1.77925 11.1595L0.445917 12.4928L2.56724 14.6142L3.90057 13.2808L1.77925 11.1595ZM0.438856 12.4999C0.138216 12.8046 -0.0654435 13.1915 -0.146421 13.6118L2.79941 14.1794C2.76826 14.3411 2.68993 14.4899 2.5743 14.607L0.438856 12.4999ZM-0.146421 13.6118C-0.227398 14.0322 -0.182066 14.467 -0.0161439 14.8616L2.7493 13.6987C2.81312 13.8505 2.83055 14.0177 2.79941 14.1794L-0.146421 13.6118ZM0.00467741 14.9088C0.184636 15.2987 0.47637 15.6263 0.842845 15.85L2.40611 13.2895C2.54706 13.3756 2.65926 13.5015 2.72848 13.6515L0.00467741 14.9088ZM0.842845 15.85C1.20932 16.0738 1.63401 16.1836 2.06301 16.1655L1.93681 13.1682C2.10181 13.1612 2.26515 13.2034 2.40611 13.2895L0.842845 15.85ZM1.99991 16.1668H7.99991V13.1668H1.99991V16.1668ZM7.99991 16.1668C10.1658 16.1668 12.2431 15.3064 13.7746 13.7749L11.6533 11.6535C10.6844 12.6225 9.3702 13.1668 7.99991 13.1668V16.1668ZM13.7746 13.7749C15.3062 12.2433 16.1666 10.1661 16.1666 8.00016H13.1666C13.1666 9.37045 12.6222 10.6846 11.6533 11.6535L13.7746 13.7749ZM16.1666 8.00016C16.1666 5.83423 15.3062 3.757 13.7746 2.22546L11.6533 4.34678C12.6222 5.31572 13.1666 6.62988 13.1666 8.00016H16.1666ZM13.7746 2.22546C12.2431 0.69391 10.1658 -0.166504 7.99991 -0.166504V2.8335C9.3702 2.8335 10.6844 3.37784 11.6533 4.34678L13.7746 2.22546ZM7.99991 11.8335H3.60658V14.8335H7.99991V11.8335ZM4.66724 14.3942L5.28724 13.7742L3.16592 11.6528L2.54592 12.2728L4.66724 14.3942ZM5.29039 13.771C5.69393 13.365 5.92044 12.8159 5.92044 12.2435H2.92044C2.92044 12.0233 3.00756 11.8121 3.16277 11.656L5.29039 13.771ZM5.92044 12.2435C5.92044 11.6711 5.69393 11.1219 5.29039 10.716L3.16277 12.831C3.00756 12.6749 2.92044 12.4636 2.92044 12.2435H5.92044ZM5.28665 10.7122C4.65922 10.0855 4.2685 9.26063 4.18106 8.37813L1.19568 8.67392C1.35155 10.2471 2.04805 11.7175 3.16651 12.8347L5.28665 10.7122ZM4.18106 8.37813C4.09362 7.49562 4.31487 6.6101 4.80711 5.87243L2.31168 4.20725C1.43421 5.52223 1.03981 7.10077 1.19568 8.67392L4.18106 8.37813ZM4.80711 5.87243C5.29935 5.13476 6.03213 4.59058 6.8806 4.33261L6.00791 1.46235C4.49541 1.92222 3.18915 2.89228 2.31168 4.20725L4.80711 5.87243ZM6.8806 4.33261C7.72907 4.07463 8.64075 4.11882 9.46029 4.45764L10.6065 1.68523C9.14555 1.08125 7.5204 1.00248 6.00791 1.46235L6.8806 4.33261ZM9.46029 4.45764C10.2798 4.79647 10.9566 5.40896 11.3751 6.19078L14.0199 4.77474C13.2737 3.38106 12.0674 2.28922 10.6065 1.68523L9.46029 4.45764ZM11.3751 6.19078C11.7937 6.97259 11.9283 7.87536 11.7559 8.74527L14.6987 9.3284C15.006 7.77769 14.7661 6.16841 14.0199 4.77474L11.3751 6.19078ZM11.7559 8.74527C11.5836 9.61518 11.1149 10.3984 10.4298 10.9615L12.3347 13.2791C13.556 12.2753 14.3914 10.8791 14.6987 9.3284L11.7559 8.74527ZM10.4298 10.9615C9.7447 11.5246 8.88555 11.8328 7.99873 11.8335L8.00109 14.8335C9.58195 14.8323 11.1135 14.2829 12.3347 13.2791L10.4298 10.9615Z" fill="currentColor" mask="url(#path-1-inside-1_2572_8281)"/>
				</svg>';
			break;

			default: 
				break;
		}
	}
endif;

if ( ! function_exists( 'medicall_tags' ) ) {
	/**
	 * Prints tags
	 */
	function medicall_tags(){
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && has_tag() ) { ?>
			<div class="entry-footer__bottom">
				<?php 
					$tags_list = get_the_tag_list( '', ' ' );
					if ( $tags_list ) {
						/* translators: 1: list of tags. */
						printf( '<div class="tags" itemprop="about">' . esc_html__( '%1$sTags:%2$s %3$s', 'medicall' ) . '</div>', '<span>', '</span>', $tags_list );
					} 
				?>
			</div>
		<?php
		}
	}
}

if( ! function_exists( 'medicall_social_media_repeater' ) ) :
    /**
     * Social Media Links

    * Function for the loop of Frontpage Social Media Section
    *
    * @param [type] $postid
    * @return void
    */
	function medicall_social_media_repeater( $fb_link, $insta_link, $linkedin_link, $pinterest_link, $md_checkbox ){
		$toggle_social_link = get_theme_mod( 'social_link_toggle', false );

		if( $toggle_social_link ){ ?>
			<div class="social-link-con">
				<?php
					if( $fb_link ){ ?>
						<a class="social-link" href="<?php echo esc_url( $fb_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
							<?php echo wp_kses( medicall_handle_all_svgs( 'facebook' ), medicall_get_kses_extended_ruleset() ); ?>
						</a>
					<?php }
					if( $insta_link ){ ?>
						<a class="social-link" href="<?php echo esc_url( $insta_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
							<?php echo wp_kses( medicall_handle_all_svgs( 'instagram' ), medicall_get_kses_extended_ruleset() ); ?>
						</a>
					<?php }
					if( $linkedin_link ){ ?>
						<a class="social-link" href="<?php echo esc_url( $linkedin_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
							<?php echo wp_kses( medicall_handle_all_svgs( 'linkedin' ), medicall_get_kses_extended_ruleset() ); ?>
						</a>
					<?php }
					if( $pinterest_link ){ ?>
						<a class="social-link" href="<?php echo esc_url( $pinterest_link ); ?>" target="<?php echo esc_attr( $md_checkbox ); ?>" rel="nofollow noopener">
							<?php echo wp_kses( medicall_handle_all_svgs( 'pinterest' ), medicall_get_kses_extended_ruleset() ); ?>
						</a>
					<?php }
				?>
			</div>
		<?php 
		}
	}
endif;



if (!function_exists( 'medicall_footer_copyright' ) ) {
    /**
     * Footer Copyright Section
     * @return void
     */
    function medicall_footer_copyright() {
		$footer_copyright_setting = get_theme_mod( 'footer_copyright_setting' );     
		?>
		<div class="copy-right">
			<?php     
				if( $footer_copyright_setting ){
					echo wp_kses_post( medicall_apply_theme_shortcode( $footer_copyright_setting ) ); 
				}else{
					echo '<span>';
						esc_html_e( '&copy; Copyright ', 'medicall' );
						echo date_i18n( esc_html__( 'Y', 'medicall' ) );
					echo '</span>';
				
					echo '<span>';
						echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
					echo '</span>';
				} 
			?>
		</div>
    <?php 
	}
}

if( ! function_exists( 'medicall_toggle_author_link' ) ) :
	/**
	 * Show/Hide Author link in footer
	 * 
	*/
	function medicall_toggle_author_link(){
		echo '<div class="site-author">';
			echo '<span>';
				esc_html_e( 'Developed By ', 'medicall' );
			echo '</span>';
			echo '<span class="author-link"><a href="' . esc_url( 'https://glthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Good Looking Themes', 'medicall' ) . '</a></span>.';
		echo '</div>';
	}
endif;

if( ! function_exists( 'medicall_toggle_wp_link' ) ) :
	/**
	 * Show/Hide WordPress link in footer
	*/
	function medicall_toggle_wp_link(){
		printf( esc_html__( '%1$s Powered by %2$s%3$s.', 'medicall' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'medicall' ) ) .'" target="_blank">WordPress</a>', '</span>' );
	}
endif;

if( ! function_exists( 'medicall_get_kses_extended_ruleset' ) ) :
	/**
	 * Passes wpkses for svgs
	 *
	 * @return void
	 */

	function medicall_get_kses_extended_ruleset() {
		$kses_defaults = wp_kses_allowed_html( 'post' );
	
		$svg_args = array(
			'svg'   => array(
				'fill'			  => true,
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
			'circle' => array(
				'cx' => true,
				'cy' => true,
				'r'  => true,
				'fill' => true,
				'stroke' => true,
				'stroke-width' => true,
			),
		);
		return array_merge( $kses_defaults, $svg_args );
	}
endif;

function medicall_woo_boolean() {
	return class_exists( 'woocommerce' ) ? true : false;
}

if ( ! function_exists( 'medicall_google_fonts_url' ) ) :	
	/**
	 * Google Fonts url
	 */
	function medicall_google_fonts_url() {
		$fonts_url = '';
	
		/* Translators: If there are characters in your language that are not
		* supported by respective fonts, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$opensans_font = _x( 'on', 'Open Sans font: on or off', 'medicall' );
	
		if ( 'off' !== $opensans_font ) {
			$font_families[] = 'Open Sans:400,400i,500,500i,600,600i,700,700i';
	
			$query_args = array(
				'family'  => urlencode( implode( '|', $font_families ) ),
				'subset'  => urlencode( 'latin,latin-ext' ),
				'display' => urlencode( 'fallback' ),
			);
	
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

			$toggle_localgoogle_fonts = get_theme_mod( 'toggle_localgoogle_fonts', false );

			if( $toggle_localgoogle_fonts ){
				$font_families = array(
					'Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600;1,700;1,800'
				);
				
				$fonts_url = add_query_arg( array(
					'family' => implode( '&family=', $font_families ),
					'display' => 'swap',
				), 'https://fonts.googleapis.com/css2' );

				$fonts_url = medicall_get_webfont_url( esc_url_raw( $fonts_url ) );
			} else{
				$fonts_url = $fonts_url;
			}
		}
	
		return esc_url( $fonts_url );
	}
endif;

if( ! function_exists( 'medicall_theme_comment' ) ) :
	/**
	 * Callback function for Comment List *
	 * 
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
	 */
	function medicall_theme_comment( $comment, $args, $depth ){
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}?>
		<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
		<?php endif; ?>
			<article class="comment-body">
				<div class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'medicall' ); ?></em>
							<br />
						<?php endif;
						if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b>', 'medicall' ), get_comment_author_link() ); ?>
					</div><!-- .comment-author vcard -->
					<div class="comment-metadata">
						<?php esc_html_e( 'Posted on', 'medicall' );?>
						<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
							<time itemprop="commentTime" datetime="<?php echo esc_attr( get_gmt_from_date( get_comment_date() . get_comment_time(), 'Y-m-d H:i:s' ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'medicall' ), get_comment_date(),  get_comment_time() ); ?></time>
						</a>
					</div>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
				</div>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
			</article>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div><!-- .comment-body -->
		<?php endif;
	}
endif;


if( ! function_exists( 'medicall_primary_nagivation' ) ) :
    /**
     * Primary Navigation.
    */
    function medicall_primary_nagivation( $classname = 'header-nav nav-menu' ){ 
        if ( current_user_can( 'manage_options' ) || has_nav_menu( 'primary' ) ) {
			echo '<div id="site-navigation" class="main-navigation">';
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => 'ul',
						'menu_class'     => $classname,
						'fallback_cb'    => 'medicall_primary_fallback',
					)
				);
			echo '</div>';
        }
    }
endif;

if( ! function_exists( 'medicall_secondary_nagivation' ) ) :
    /**
     * Secondary Navigation.
    */
    function medicall_secondary_nagivation( $classname = 'header-nav nav-menu' ){ 
		if ( current_user_can( 'manage_options' ) || has_nav_menu( 'secondary' ) ) { ?>
			<div class="secondary-navigation">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'secondary',
							'container'      => 'ul',
							'menu_class'     =>  $classname,
							'fallback_cb'    => 'medicall_primary_fallback',
						)
					); 
				?>
			</div>
		<?php
		}
    }
endif;

if ( ! function_exists( 'medicall_apply_theme_shortcode' ) ) :
	/**
	 * Footer Shortcode
	*/
	function medicall_apply_theme_shortcode( $string ) {
		if ( empty( $string ) ) {
			return $string;
		}
		$search = array( '[the-year]', '[the-site-link]' );
		$replace = array(
			date_i18n( esc_html__( 'Y', 'medicall' ) ),
			'<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>',
		);
		$string = str_replace( $search, $replace, $string );
		return $string;
	}
endif;

if( ! function_exists( 'medicall_pagination' ) ) :
	/**
	 * Pagination function
	 *
	 * @return void
	 */

	function medicall_pagination(){
		if( is_singular() ){ 
			$post_type = get_post_type();
			$next_post = get_next_post( array( 'post_type' => $post_type ) );
			$prev_post = get_previous_post( array( 'post_type' => $post_type ) );
			
			if( $next_post || $prev_post ){ ?>
				<nav class="post-navigation">
					<div class="nav-links">
						<?php if( $prev_post ){ ?>
							<div class="nav-previous">
								<a href="<?php the_permalink( $prev_post->ID ); ?>" rel="prev">
									<article class="post">
										<div class="pagination-details">
											<div class="prev-post-thumbnail">
												<?php get_the_post_thumbnail( $prev_post->ID, 'thumbnail'); ?>
											</div>
											<span class="meta-nav"><?php echo esc_html__( 'Previous Post', 'medicall' ); ?></span>
										</div>
									</article>
								</a>
							</div>
						<?php }
						if( $next_post ){ ?>
							<div class="nav-next">
								<a href="<?php the_permalink( $next_post->ID ); ?>" rel="next">
									<article class="post">
										<div class="pagination-details">
											<div class="prev-post-thumbnail">
												<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail'); ?>
											</div>
											<span class="meta-nav"><?php echo esc_html__( 'Next Post', 'medicall' ); ?></span>
										</div>
									</article>
								</a>
							</div>
						<?php } ?>
					</div>	
				</nav>
			<?php 
			} 
		}else{
			$pagination = get_theme_mod( 'pagination_type', 'numbered' );
			
			switch( $pagination ){
				case 'default': // Default Pagination
				
				the_posts_navigation();
				
				break;
				
				case 'numbered': // Numbered Pagination
				
				the_posts_pagination( 
					array(
					'prev_text'          => __( 'Previous', 'medicall' ),
					'next_text'          => __( 'Next', 'medicall' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'medicall' ) . ' </span>',
					) 
				);
				
				break;

				default:
				the_posts_navigation();
				break;
			}        
		}
	}
endif;

if( ! function_exists( 'medicall_comment' ) ) :
	/**
	 * Comment
	*/
	function medicall_comment(){
		// If comments are open or we have at least one comment, load up the comment template.
		if( ( comments_open() || get_comments_number() ) ) :
			comments_template();
		endif;
	}
endif;

function medicall_primary_fallback(){
    if ( current_user_can('manage_options') ) {
        echo '<a href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Click here to add a menu', 'medicall') . '</a>';
    }
}

if( ! function_exists( 'medicall_get_comment_count' ) ) :
	/**
	 * Comment Count
	*/
	function medicall_get_comment_count(){ 
		$comment_count = get_comments_number();
		echo '<span class="comment-icon">' . wp_kses( medicall_handle_all_svgs( 'comment' ), medicall_get_kses_extended_ruleset() ) . '</span>';
		echo '<span class="comment-count">' . number_format_i18n( $comment_count ) . '</span>';
	}
endif;

if ( ! function_exists( 'medicall_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function medicall_posted_on() {
		$posted_on = sprintf(
			/* translators: %s: post date in the format Month Day, Year */
			esc_html_x( '%s', 'post date', 'medicall' ),
			'<a href="#" rel="bookmark">
				<span>'
				. wp_kses( medicall_handle_all_svgs( 'calendar' ), medicall_get_kses_extended_ruleset() ) .
				'</span>'
				. esc_html( get_the_date( 'F j, Y' ) ) .
			'</a>'
		);
	
		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	
endif;

if ( ! function_exists( 'medicall_category' ) ) :
	/**
	 * Prints categories
	 */
	function medicall_category(){
		// Hide category and tag text for pages.
		if ( is_single() ) {
			// Category
			$categories = get_the_category();
			if ( ! empty( $categories) ) { ?>
				<div class="category-wrap">
					<?php foreach ( $categories as $category ) {
						$categories_url = get_category_link( $category->term_id ); ?>
						<span class="category-list">
							<a href=<?php echo esc_url( $categories_url ); ?>>
								<?php echo esc_html( $category->name ); ?>
							</a>
						</span>
					<?php } ?>
				</div>
			<?php }
		} else { 
			$categories = get_the_category();
			if ( ! empty($categories) ) { ?>
				<ul class="article__tags">
					<?php foreach ( $categories as $category ) { 
						$categories_url = get_category_link( $category->term_id ); ?>
						<li class="tag">
							<a href=<?php echo esc_url( $categories_url ); ?>>
								<?php echo esc_html( $category->name ); ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			<?php 
			} 
		}
	}
endif;

if( ! function_exists( 'medicall_author_box' ) ) :
	/**
	 * Author Section
	*/
	function medicall_author_box(){ 
		$mp_author          = get_theme_mod( 'mp_author', true );
		$author_description = get_the_author_meta( 'description' );
		
		if( $mp_author && $author_description ){ ?>
			<h2 class="section-heading"><?php esc_html_e( 'From Author', 'medicall' ); ?></h2>
			<div class="author-section style-two">
				<div class="author-wrapper">
					<div class="author-img">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
					</div>
					<div class="author-wrap">
						<h3><?php the_author();?></h3>
						<div class="author-content">
							<?php echo wpautop( wp_kses_post( $author_description ) ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php }
	}
endif;

if( ! function_exists( 'medicall_front_page_sections' ) ) :
	/**
	 * Frontpage Sections
	 *
	 * @return array
	 */
	function medicall_front_page_sections(){
		return apply_filters( 
			'medicall_homepage_sections',
			array( 'banner', 'about', 'service', 'department', 'video-cta', 'book-appointment','team', 'cta','blog' )
		);
	}
endif;