<?php 

if( ! function_exists( 'medicall_customize_register_contactpagedetail' ) ) :
    /**
     * Contactpage Detail
     *
     * @param [type] $wp_customize
     * @return void
     */
    function medicall_customize_register_contactpagedetail( $wp_customize ){
        $wp_customize->add_section(
            'contact_detail_section',
            array(
                'title'       => esc_html__( 'Detail Section', 'medicall' ),
                'panel'       => 'contact_page_settings',
            )
        );
        
        // Add settings for the number heading
        $wp_customize->add_setting(
            'contact_info_number_heading',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_info_number_heading', 
            array(
            'selector'        => '.page-template-contact .card-title.contact-heading',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_info_number_heading' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_info_number_heading',
            array(
                'label'   => esc_html__( 'Contact Box Heading', 'medicall'),
                'section' => 'contact_detail_section',
                'type'    => 'text',
            )
        );

        //Add settings for the phone number 1 title
        $wp_customize->add_setting(
            'contact_info_phone_number_one_title',
            array(
                'default'   =>  '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );
        //Add control for the phone number 1 title
        $wp_customize->add_control(
            'contact_info_phone_number_one_title',
            array(
                'label'   =>  esc_html__( 'Contact Title One', 'medicall' ),
                'section' => 'contact_detail_section',
                'type'  => 'text',
            )
        );

        //Add settings for the phone number 1 inputbox
        $wp_customize->add_setting(
            'contact_info_phone_number_one_detail',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'contact_info_phone_number_one_detail',
            array(
                'label'   => esc_html__( 'Contact Number One', 'medicall'),
                'section' => 'contact_detail_section',
                'type'    => 'text',
            )
        );

        //Add settings for the phone number 2 title
        $wp_customize->add_setting(
            'contact_info_phone_number_two_title',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        //Add control for the phone number 2 title
        $wp_customize->add_control(
            'contact_info_phone_number_two_title',
            array(
                'label'   => esc_html__( 'Contact Two Title', 'medicall' ),
                'section' => 'contact_detail_section',
                'type'    => 'text',
            )
        );

        //Add settings for the phone number 2 inputbox
        $wp_customize->add_setting(
            'contact_info_phone_number_two_detail',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'contact_info_phone_number_two_detail',
            array(
                'label'   => esc_html__( 'Contact Two Number', 'medicall'),
                'section' => 'contact_detail_section',
                'type'    => 'text',
            )
        );

        //setting and control for location Box 2 Heading
        $wp_customize->add_setting(
            'contact_info_location_heading',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'contact_info_location_heading', 
            array(
            'selector'        => '.page-template-contact .card-title.location-heading',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_info_location_heading' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_info_location_heading',
            array(
                'label'   => esc_html__( 'Location Box Heading', 'medicall' ),
                'section' => 'contact_detail_section',
                'type'    => 'text',
            )
        );

        //Setting and control for Location 1 inputbox
        $wp_customize->add_setting(
            'contact_info_location_one_detail', 
            array(
                'default'           => '',             
                'sanitize_callback' => 'sanitize_text_field',
            )   
        );

        $wp_customize->add_control(
            'contact_info_location_one_detail', 
            array(
                'label'    => esc_html__( 'Location One', 'medicall' ),
                'section'  => 'contact_detail_section',
                'type'     => 'text',
            )
        );

        //Setting and control for Location 2 inputbox
        $wp_customize->add_setting(
            'contact_info_location_two_detail', 
            array(
                'default'           => '',             
                'sanitize_callback' => 'sanitize_text_field',
            )   
        );

        $wp_customize->add_control(
            'contact_info_location_two_detail', 
            array(
                'label'     => esc_html__( 'Location Two', 'medicall' ),
                'section'   => 'contact_detail_section',
                'type'      => 'text',
            )
        );

        //setting and control for email Box 3 Heading
        $wp_customize->add_setting(
            'contact_info_email_heading',
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->selective_refresh->add_partial( 'contact_info_email_heading', 
            array(
            'selector'        => '.page-template-contact .card-title.email-heading',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_info_email_heading' ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_info_email_heading',
            array(
                'label'   => esc_html__( 'Email Box Heading', 'medicall' ),
                'section' => 'contact_detail_section',
                'type'    => 'text',
            )
        );

        //Setting and control for Email 1 inputbox
        $wp_customize->add_setting(
            'contact_info_email_one_detail', 
            array(
                'default'           => '',             
                'sanitize_callback' => 'sanitize_email',
            )   
        );

        $wp_customize->add_control(
            'contact_info_email_one_detail', 
            array(
                'label'     => esc_html__( 'Email One', 'medicall' ),
                'section'   => 'contact_detail_section',
                'type'      => 'email',  
            )
        );

        //Setting and control for Email 2 inputbox
        $wp_customize->add_setting(
            'contact_info_email_two_detail', 
            array(
                'default'           => '',             
                'sanitize_callback' => 'sanitize_email',
            )   
        );

        $wp_customize->add_control(
            'contact_info_email_two_detail', 
            array(
                'label'     => esc_html__( 'Email Two', 'medicall' ),
                'section'   => 'contact_detail_section',
                'type'      => 'email', 
            )
        );
    }
endif;
add_action('customize_register', 'medicall_customize_register_contactpagedetail');

