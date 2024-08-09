<?php 

if( ! function_exists( 'medicall_customize_register_typography' ) ) :
    /**
     * Social Links
     *
     * @param [type] $wp_customize
     * @return void
     */
    function medicall_customize_register_typography( $wp_customize ){

        // Create a new section top bar settings----------
        $wp_customize->add_section(
            'typography_section', 
            array(
                'title'    => esc_html__( 'Typography Settings', 'medicall' ),
                'priority' => 30,
                'panel'    => 'appearance_settings',
            )
        );

        $wp_customize->add_setting(
            'toggle_localgoogle_fonts', 
            array(
                'default'           => false,
                'sanitize_callback' => 'medicall_sanitize_checkbox',
            )
        );
    
        $wp_customize->add_control(
            new Medicall_Toggle_Control(
                $wp_customize, 
                'toggle_localgoogle_fonts', 
                array(
                    'label'       => esc_html__( 'Enable to load the google fonts locally.', 'medicall' ),
                    'section'  => 'typography_section',
                    'type'    => 'checkbox'
                )
            )
        );
    }
endif;
add_action('customize_register', 'medicall_customize_register_typography');
