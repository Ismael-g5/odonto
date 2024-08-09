<?php 
/**
 * Functions which enhance the theme by hooking into WordPress core actions/hooks
 *
 * @package Medicall
 */
 /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function medicall_setup(){
	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	* If you're building a theme based on medicall, use a find and replace
	* to change 'medicall' to the name of your theme in all the template files.
	*/
	load_theme_textdomain('medicall', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support('title-tag');

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary'      => esc_html__('Primary', 'medicall'),
			'secondary'	   => esc_html__('Secondary', 'medicall'),
			'footer-menu1' => esc_html__('Footer Menu 1', 'medicall'),
			'footer-menu2' => esc_html__('Footer Menu 2', 'medicall'),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'medicall_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	add_theme_support( "wp-block-styles" );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "align-wide" );

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	
	/**
	 * Registering new image sizes
	 */
	add_image_size('front_aboutus_smallimg', '350', '260', true);
	add_image_size('team_feature_img', '368', '380', true);

	// Remove core block patterns
	remove_theme_support( 'core-block-patterns' );

	if( medicall_woo_boolean() ){
		global $woocommerce;

		add_theme_support('woocommerce');
	
		if( version_compare($woocommerce->version, '3.0', ">=") ) {
			add_theme_support('wc-product-gallery-zoom');
			add_theme_support('wc-product-gallery-lightbox');
			add_theme_support('wc-product-gallery-slider');
		}
	}
    
    /**
     * Set up the WordPress core custom header feature.
     *
     * @uses medicall_header_style()
     */

    add_theme_support(
		'custom-header',
		apply_filters(
			'medicall_custom_header_args',
			array(
				'default-image'      => esc_url( get_template_directory_uri() . '/assets/images/static-image.jpg' ),
				'video'              => true,
				'default-text-color' => '000000',
				'width'              => 1920,
				'height'             => 720,
				'flex-height'        => true,
				'wp-head-callback'   => 'medicall_header_style',
				'header-text'        => true,
			)
		)
	);
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	$GLOBALS['content_width'] = apply_filters('medicall_content_width', 760);
}
add_action('after_setup_theme', 'medicall_setup');

/**
 * Enqueue scripts and styles.
 */
function medicall_scripts(){

	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'medicall-google-fonts', medicall_google_fonts_url(), array(), null );
	wp_enqueue_style('medicall-style', get_stylesheet_uri(), array(), MEDICALL_VERSION);
	wp_style_add_data('medicall-style', 'rtl', 'replace');

	wp_enqueue_style('medicall-styles', get_template_directory_uri() . '/assets/css/' . $build . 'style' . $suffix . '.css', array(), MEDICALL_VERSION, false);

	if( medicall_woo_boolean() ){
		wp_enqueue_style( 'medicall-woo', get_template_directory_uri(). '/assets/css/' . $build . 'woo' . $suffix . '.css',  array(), MEDICALL_VERSION );
	}

	wp_enqueue_script('medicall-navigation', get_template_directory_uri() . '/js/' . $build . 'navigation' . $suffix . '.js', array('jquery'), MEDICALL_VERSION, true);
	
	// Enqueue the index script and make it dependent on the custom script with defer strategy
	wp_enqueue_script(
		'medicall-index', 
		get_template_directory_uri() . '/assets/js/' . $build . 'index' . $suffix . '.js', 
		array('jquery'), 
		MEDICALL_VERSION,
		true
	);
	
	wp_enqueue_script(
		'medicall-modal-accessibility', 
		get_template_directory_uri() . '/js/' . $build . 'modal-accessibility' . $suffix . '.js', 
		array('jquery'), 
		MEDICALL_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_localize_script( 
		'medicall-custom', 
		'medicall_data',
		array(
			'rtl' => is_rtl(),
		)
	);

	wp_enqueue_style(
		'medicall-theme-child',
		get_stylesheet_directory_uri() . '/style.css',
		array(),
		MEDICALL_VERSION
	);
}
add_action('wp_enqueue_scripts', 'medicall_scripts');

if ( ! function_exists( 'medicall_enqueue_backend_styles' ) ):
	/**
	 * Enqueuing styles and scripts for Backend
	 *
	 * @return void
	 */
	function medicall_enqueue_backend_styles() {
		$build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'unminify/' : '';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_style( 
			'medicall-editor-styles', 
			get_template_directory_uri() . '/assets/css/' . $build .'editor-style' . $suffix . '.css', 
			array(), 
			MEDICALL_VERSION, 
			false 
		);
	}
endif;
add_action( 'admin_enqueue_scripts', 'medicall_enqueue_backend_styles' );

if ( ! function_exists( 'medicall_body_classes' ) ):
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function medicall_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of gl-full-wrap when there is no sidebar present.
		if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
			$classes[] = 'gl-full-wrap';
		}
		if( is_singular() || is_archive() || is_search() || is_home() ){
			$classes[] = medicall_sidebar_layout();
		}

		return $classes;
	}
endif;
add_filter( 'body_class', 'medicall_body_classes' );

if ( ! function_exists( 'medicall_widgets_init' ) ):
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */

	function medicall_widgets_init(){
		$sidebars = array(
			'primary-sidebar' => array(
				'name'        => esc_html__('Primary Sidebar', 'medicall'),
				'id'          => 'primary-sidebar',
				'description' => esc_html__('Primary Sidebar', 'medicall'),
			),
			'footer-one' => array(
				'name'        => esc_html__('Footer One', 'medicall'),
				'id'          => 'footer-one',
				'description' => esc_html__('Add footer one widgets here.', 'medicall'),
			),
			'footer-two' => array(
				'name'        => esc_html__('Footer Two', 'medicall'),
				'id'          => 'footer-two',
				'description' => esc_html__('Add footer two widgets here.', 'medicall'),
			),
			'footer-three' => array(
				'name'        => esc_html__('Footer Three', 'medicall'),
				'id'          => 'footer-three',
				'description' => esc_html__('Add footer three widgets here.', 'medicall'),
			),
			'footer-four' => array(
				'name'        => esc_html__('Footer Four', 'medicall'),
				'id'          => 'footer-four',
				'description' => esc_html__('Add footer four widgets here.', 'medicall'),
			),
		);
		foreach ( $sidebars as $sidebar ) {
			register_sidebar(
				array(
					'name'          => esc_html( $sidebar['name'] ),
					'id'            => esc_attr( $sidebar['id'] ),
					'description'   => esc_html( $sidebar['description'] ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h5 class="widget-title" itemprop="name">',
					'after_title'   => '</h5>',
				)
			);
		}
	}
endif;
add_action('widgets_init', 'medicall_widgets_init');

if ( ! function_exists( 'medicall_pingback_header' ) ):
	function medicall_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
endif;
add_action( 'wp_head', 'medicall_pingback_header' );

if ( ! function_exists( 'medicall_internal_stylesheet' ) ) :
	/**
	 * Function to control all the static path in the stylesheet.
	 *
	 * @return void
	 */

	function medicall_internal_stylesheet(){
		
		$path = get_template_directory_uri();

		echo '<style id="medicall-internal-style">';
		echo '
			.team .pricing-plan-points .price-point::before {
				content: url(' . $path . '/assets/icons/tick-mark-white.svg);
			}
			.category-card .categories li::before {
				content: url('. $path . '/assets/icons/gte-arrow.svg);
			}
			.contact-form-wrap .contact-img::before {
				background-image: url('. $path . '/assets/icons/bg-dots-2.png);
			}
			.contact-form-wrap .contact-img::after {
				background-image: url('. $path . '/assets/icons/bg-dots.png);
			}
			.tick-points li::before {
				content: url('. $path . '/assets/icons/tick-mark.svg);
			}
			.about-points li::before {
				background-image: url('. $path . '/assets/icons/tick-mark.png);
			}
			.about-image-wrapper::after {
				background-image: url('. $path . '/assets/icons/bg-dots-2.png);
			}
			.about-image-wrapper::before {
				background-image: url('. $path . '/assets/icons/bg-dots.png);
			}
			.appointment-img::before {
				background-image: url('. $path . '/assets/icons/bg-dots.png);
			}
			.appointment-img::after {
				background-image: url('. $path . '/assets/icons/bg-dots-2.png);
			}
			.entry-content ul li::before {
				content: "";
				-webkit-mask-image: url('. $path . '/assets/icons/tick-mark.svg);
						mask-image: url('. $path . '/assets/icons/tick-mark.svg);
			  }
        ';
		echo '</style>';
	}
endif;
add_action( 'wp_head','medicall_internal_stylesheet' );

add_action( 'wp_head',function(){
    $style = '
    .breadcrumbs .trail-browse,
    .breadcrumbs .trail-items,
    .breadcrumbs .trail-items li {
        display:     inline-block;
        margin:      0;
        padding:     0;
        border:      none;
        background:  transparent;
        text-indent: 0;
    }

    .breadcrumbs .trail-browse {
        font-size:   inherit;
        font-style:  inherit;
        font-weight: inherit;
        color:       inherit;
    }

    .breadcrumbs .trail-items {
        list-style: none;
    }

        .trail-items li::after {
            content: "\002F";
            padding: 0 0.5em;
        }

        .trail-items li:last-of-type::after {
            display: none;
        }';

    $style = apply_filters( 'breadcrumb_trail_inline_style', trim( str_replace( array( "\r", "\n", "\t", "  " ), '', $style ) ) );

    if ( $style ){
        echo "\n" . '<style type="text/css" id="medicall-breadcrumbs-css">' . $style . '</style>' . "\n";
    }
});