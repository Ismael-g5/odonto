<?php
/**
 * Medicall Theme Information Link Section
 *
 * @package Medicall
 */

if( ! function_exists( 'medicall_theme_info' ) ) :
    function medicall_theme_info( $customizer_manager ) {
        $customizer_manager->add_section( 
            'theme_info', 
            array(
                'title'    => esc_html__( 'Information Links', 'medicall' ),
                'priority' => 6,
            )
        );

        /** Important Links */
        $customizer_manager->add_setting( 
            'theme_info_theme',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $theme_info = '<ul>';
        $theme_info .= sprintf( __( '<li>View documentation: %1$sClick here.%2$s</li>', 'medicall' ),  '<a href="' . esc_url( 'https://glthemes.com/documentation/medicall/' ) . '" target="_blank">', '</a>' );
        $theme_info .= sprintf( __( '<li>Theme info: %1$sClick here.%2$s</li>', 'medicall' ),  '<a href="' . esc_url( 'https://glthemes.com/wordpress-theme/medicall/' ) . '" target="_blank">', '</a>' );
        $theme_info .= sprintf( __( '<li>Support ticket: %1$sClick here.%2$s</li>', 'medicall' ),  '<a href="' . esc_url( 'https://glthemes.com/support/' ) . '" target="_blank">', '</a>' );
        $theme_info .= sprintf( __( '<li>More WordPress Themes: %1$sClick here.%2$s</li>', 'medicall' ),  '<a href="' . esc_url( 'https://glthemes.com/wordpress-theme/' ) . '" target="_blank">', '</a>' );
        $theme_info .= '</ul>';

        $customizer_manager->add_control(
            new Medicall_Note_Control( 
                $customizer_manager,
                'theme_info_theme',
                array(
                    'label'       => esc_html__( 'Important Links', 'medicall' ),
                    'section'     => 'theme_info',
                    'description' => $theme_info
                )
            )
        );

        $customizer_manager->add_section(
            new Medicall_Customize_Section_Pro(
                $customizer_manager,
                'medicall_view_pro',
                array(
                    'title'    => esc_html__( 'Pro Available', 'medicall' ),
                    'priority' => 5, 
                    'pro_text' => esc_html__( 'VIEW PRO THEME', 'medicall' ),
                    'pro_url'  => 'https://glthemes.com/wordpress-theme/medicall-pro/'
                )
            )
        );
    }
endif;
add_action( 'customize_register', 'medicall_theme_info',9999 );