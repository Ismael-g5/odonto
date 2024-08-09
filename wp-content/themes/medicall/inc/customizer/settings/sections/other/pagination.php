<?php

if( ! function_exists( 'medicall_customize_register_pagination_settings' ) ) :
/**
 * Pagination Settings
 *
 * @package Medicall
 */

function medicall_customize_register_pagination_settings( $wp_customize ) {
    
    /** Pagination Settings */
    $wp_customize->add_section(
        'pagination_settings',
        array(
            'title'    => __( 'Pagination Settings', 'medicall' ),
            'panel'    => 'general_settings_panel',
            'priority' => 80,
        )
    );
    
    /** Pagination Type */
    $wp_customize->add_setting( 
        'pagination_type', 
        array(
            'default'           => 'numbered',
            'sanitize_callback' => 'medicall_radio_sanitization_header'
        ) 
    );
    
    $wp_customize->add_control(
        'pagination_type',
        array(
            'type'    => 'radio',
            'section' => 'pagination_settings',
            'label'   => __( 'Pagination Type', 'medicall' ),
            'description' => __( 'Select pagination of your choice.', 'medicall' ),
            'choices' => array(
				'default'         => __( 'Default (Older / Newer)', 'medicall' ),
                'numbered'        => __( 'Numbered (1 2 3 4...)', 'medicall' ),
			)
        )
    ); 
}
endif;
add_action( 'customize_register', 'medicall_customize_register_pagination_settings' );