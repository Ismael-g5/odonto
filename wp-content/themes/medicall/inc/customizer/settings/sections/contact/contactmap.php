<?php 
if( ! function_exists( 'medicall_customize_register_contactmap' ) ) :
    /**
     * Contact Page Map Section
     *
     * @param [type] $wp_customize
     * @return void
     */
    function medicall_customize_register_contactmap( $wp_customize ){
        $wp_customize->add_section(
            'contact_map_section',
            array(
                'title'  => esc_html__( 'Map Section', 'medicall' ),
                'panel'  => 'contact_page_settings',
            )
        );

        //Google map iframe
        $wp_customize->add_setting(
            'contact_map_iframe',
            array(
                'default'           => '',
                'sanitize_callback' => 'medicall_sanitize_code',
            )
        );

        $wp_customize->add_control(
            'contact_map_iframe',
            array(
                'label'   => esc_html__( 'Google Map Iframe', 'medicall' ),
                'section' => 'contact_map_section',
                'type'    => 'text',
            )
        );
    }
endif;
add_action('customize_register', 'medicall_customize_register_contactmap');


