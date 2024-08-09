<?php 

if( ! function_exists( 'medicall_customize_register_footer' )  ){
    /**
     * Footer Copyright settings cutomizers section
     */

    function medicall_customize_register_footer( $wp_customize ){
        $wp_customize->add_section(
            'footer_settings', 
            array(
                'title'          => esc_html__('Footer Settings', 'medicall'),
                'priority'   => 10,
                'capability' => 'edit_theme_options',
            )
        );

        //Add settings for Copyright settings
        $wp_customize->add_setting(
            'footer_copyright_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_textarea_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'footer_copyright_setting', 
            array(
            'selector'        => '.copy-right',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'footer_copyright_setting' ) );
                },  
            ) 
        );

        //Add Control for Copyright control
        $wp_customize->add_control(
            'footer_copyright_setting', 
            array(
                'label'           => esc_html__( 'Footer Copyright Text', 'medicall' ),
                'description'     => esc_html__( 'Write your copyright text here.', 'medicall' ),
                'section'         => 'footer_settings',
                'type'            => 'textarea',
            )
        );
    }
}
add_action('customize_register', 'medicall_customize_register_footer');
