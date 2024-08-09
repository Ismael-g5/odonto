<?php 

if( ! function_exists( 'medicall_customize_register_social_links' ) ) :
    /**
     * Social Links
     *
     * @param [type] $wp_customize
     * @return void
     */
    function medicall_customize_register_social_links( $wp_customize ){

        // Create a new section top bar settings----------
        $wp_customize->add_section(
            'social_links', 
            array(
                'title'    => esc_html__( 'Social Links', 'medicall' ),
                'priority' => 20,
                'panel'    => 'general_settings_panel',
            )
        );
        
        // Add the toggle control to the section
        $wp_customize->add_setting(
            'social_link_toggle', 
            array(
                'default'           => false,
                'sanitize_callback' => 'medicall_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Medicall_Toggle_Control(
                $wp_customize,
                'social_link_toggle', 
                array(
                    'label'       => esc_html__( 'Show/Hide Social Link', 'medicall' ),
                    'description' => esc_html__( 'Enable to show the Social Links.', 'medicall' ),
                    'section'     => 'social_links',
                    'type'        => 'checkbox'
                )
            )
        );

        $wp_customize->add_setting(
            'contact_followus_title',
            array(
                'default'           => esc_html__( 'Follow Us On :', 'medicall' ),
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->selective_refresh->add_partial( 'contact_followus_title', 
            array(
            'selector'        => '.follow-us',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'contact_followus_title', __( 'Follow Us On :', 'medicall' ) ) );
                },  
            ) 
        );

        $wp_customize->add_control(
            'contact_followus_title',
            array(
                'label'   => esc_html__( 'Heading', 'medicall' ),
                'section' => 'social_links',
                'type'    => 'text', 
            )
        );

        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_facebook_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'			=> 'postMessage',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_facebook_link', 
            array(
                'label'   => esc_html__( 'Facebook Link', 'medicall' ),
                'section' => 'social_links',
                'type'    => 'url',      
                'active_callback' => 'medicall_socialmedia_link_active_callback'      
            )
        );
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_instagram_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'			=> 'postMessage',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_instagram_link', 
            array(
                'label'   => esc_html__( 'Instagram Link', 'medicall' ),
                'section' => 'social_links',
                'type'    => 'url',
                'active_callback' => 'medicall_socialmedia_link_active_callback'      
            )
        );
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_linkedin_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'			=> 'postMessage',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_linkedin_link', 
            array(
                'label'   => esc_html__( 'Linkedin Link', 'medicall' ),
                'section' => 'social_links',
                'type'    => 'url',
                  'active_callback' => 'medicall_socialmedia_link_active_callback'      
            )
        );
        // Add setting for Video CTA link text
        $wp_customize->add_setting(
            'social_pinterest_link', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'			=> 'postMessage',
            )
        );

        // Add control for link text
        $wp_customize->add_control(
            'social_pinterest_link', 
            array(
                'label'   => esc_html__( 'Pinterest Link', 'medicall' ),
                'section' => 'social_links',
                'type'    => 'url',
                'active_callback' => 'medicall_socialmedia_link_active_callback'      
            )
        );

            // Add the toggle control to the section
        $wp_customize->add_setting(
            'md_social_checkbox', 
            array(
                'default'           => true,
                'sanitize_callback' => 'medicall_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Medicall_Toggle_Control(
                $wp_customize,
                'md_social_checkbox', 
                array(
                    'label'       => esc_html__( 'Enable to open in new tab.', 'medicall' ),
                    'section'     => 'social_links',
                    'type'        => 'checkbox',
                    'active_callback' => 'medicall_socialmedia_link_active_callback'
                )
            )
        );
    }
endif;
add_action('customize_register', 'medicall_customize_register_social_links');

function medicall_socialmedia_link_active_callback( $control ){

    $social_link_toggle = $control->manager->get_setting( 'social_link_toggle' )->value();

    $id = $control->id;

    if( $id == 'social_facebook_link' && $social_link_toggle ) return true;
    if( $id == 'social_instagram_link' && $social_link_toggle ) return true;
    if( $id == 'social_linkedin_link' && $social_link_toggle ) return true;
    if( $id == 'social_pinterest_link' && $social_link_toggle ) return true;
    if( $id == 'md_social_checkbox' && $social_link_toggle ) return true;
    
    return false;
}
