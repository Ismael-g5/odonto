<?php
if( ! function_exists( 'medicall_customize_register_contactform' ) ) :
    /**
     * Contactpage Formsection
     *
     * @param [type] $wp_customize
     * @return void
     */
    function medicall_customize_register_contactform( $wp_customize ){
        $wp_customize->add_section(
            'contact_form_section',
            array(
                'title'  => esc_html__( 'Form Section', 'medicall' ),
                'panel'  => 'contact_page_settings',
            )
        );

        $wp_customize->add_setting(
            'contact_form_heading',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'contact_form_heading', 
            array(
            'selector'        => '.center-heading.start-heading.contact-form',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_form_heading' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_form_heading',
            array(
                'label'   => esc_html__( 'Heading', 'medicall' ),
                'section' => 'contact_form_section',
                'type'    => 'text',
            )
        );

        $wp_customize->add_setting(
            'contact_form_subheading',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'contact_form_subheading', 
            array(
            'selector'        => '.center-title.contact-form',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_form_subheading', __( 'Contact Us', 'medicall' ) ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_form_subheading',
            array(
                'label'   => esc_html__( 'Sub Heading', 'medicall' ),
                'section' => 'contact_form_section',
                'type'    => 'text',
            )
        );
        /** Shortcode*/
        $wp_customize->add_setting(
            'contact_form_shortcode',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );

        $wp_customize->add_control(
            'contact_form_shortcode',
            array(
                'label'   => esc_html__( 'Shortcode', 'medicall' ),
                'type'    => 'text',
                'section' => 'contact_form_section',
            )
        );

        /* features image*/
        $wp_customize->add_setting(
            'contact_form_featured_img', 
            array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw'
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 
                'contact_form_featured_img', 
                array(
                    'label'       => esc_html__( 'Upload Image', 'medicall' ),
                    'section'     => 'contact_form_section',
                )
            )
        );
    }
endif;
add_action('customize_register', 'medicall_customize_register_contactform');