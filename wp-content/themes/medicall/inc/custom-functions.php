<?php
/**
 * Medicall Custom functions and definitions
 *
 * @package Medicall
 */

 if ( ! function_exists( 'medicall_mobile_header' ) ) {
    /**
     * Medicall Mobile Header
     */
    function medicall_mobile_header(){ ?>
        <!-- mobile header start -->
        <div class="mobile-header">
            <div class="container">
                <div class="mobile-header_wrapper">
                    <?php 
                        medicall_mobile_site_branding();
                        medicall_mobile_ham_wrapper();
                    ?>
                </div>
            </div>
        </div>
        <div class="sidebar" id="mobileSideMenu">
            <div class="sidebar-body">
                <div class="sidebar-top-wrap">
                    <button class="close-sidebar-btn" id="mobileSideMenuClose"></button>
                </div>
                <nav class="main-navigation">
                    <div class="menu-container">
                        <?php medicall_primary_nagivation('mobile-menu'); ?>
                    </div>
                </nav>
                <div class="header-right">
                    <?php medicall_mobile_portal(); ?>
                </div>
            </div>
            <div class="sidebar-footer">
                <div class="sidebar-footer-top">
                    <div class="contact-social-links">
                        <?php medicall_mobile_followus();?>
                    </div>
                </div>
                <?php medicall_mobile_contact();?>
            </div>
        </div> 
    <?php
    }
}

if( ! function_exists( 'medicall_breadcrumbs' ) ) :
    /**
     * Breadcrumb Trail wrapper
     *
     * @return void
     */
    function medicall_breadcrumbs(){ ?>
        <div id="crumbs">
            <?php medicall_breadcrumb_trail(); ?>
        </div>
    <?php }
endif;