<?php
/**
 * Medicall Woocommerce hooks and functions.
 *
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Medicall
 */

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar',             'woocommerce_get_sidebar', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 9);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 60);

//custom action now added
add_action('woocommerce_before_main_content', 'medicall_wc_wrapper');
add_action('woocommerce_after_main_content', 'medicall_wc_wrapper_end');
add_action('medicall_woo_sidebar', 'medicall_wc_sidebar_cb');
add_filter('woocommerce_show_page_title',function(){
    return false;
});

if (! function_exists('medicall_woocommerce_support') ) :
    /**
     * Declare Woocommerce Support
     */
    function medicall_woocommerce_support()
    {
        global $woocommerce;

        add_theme_support('woocommerce');

        if(version_compare($woocommerce->version, '3.0', ">=") ) {
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
        }
    }
endif;
add_action('after_setup_theme', 'medicall_woocommerce_support');

/**
 * Woocommerce Sidebar
 */
function medicall_wc_widgets_init(){
    register_sidebar(
        array(
            'name'          => __('Shop Sidebar', 'medicall'),
            'id'            => 'woo-sidebar',
            'description'   => __('Sidebar displaying only in woocommerce pages.', 'medicall'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'medicall_wc_widgets_init');

/**
 * Callback function for Shop sidebar
 */
function medicall_wc_sidebar_cb(){
    if( is_active_sidebar('woo-sidebar') ) {
        echo '<aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">';
        dynamic_sidebar('woo-sidebar');
        echo '</aside>';
    }
}


if (! function_exists('medicall_wc_wrapper') ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function medicall_wc_wrapper(){ 
    ?>
    <div id="primary" class="content-area">
        <div class="container">
            <div class="page-grid">
            <div id="main" class="site-main">
        <?php
    }
endif;


if (! function_exists('medicall_wc_wrapper_end') ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function medicall_wc_wrapper_end(){
    ?>
        </div>
            <?php if( !is_single() ) do_action('medicall_woo_sidebar'); ?>
            </div>
        </div>
    </div>
    <?php
    }
endif;
