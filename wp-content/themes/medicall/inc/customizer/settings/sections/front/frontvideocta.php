<?php 

if( ! function_exists( 'medicall_customize_register_frontvideocta' ) ) :
/**
 * Frontvideocta
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontvideocta( $wp_customize ){
   
    $wp_customize->add_section(
        'front_video_cta_section', 
        array(
            'title'      => esc_html__( 'Video CTA Settings', 'medicall' ),
            'priority'   => 50,
            'panel'      => 'frontpage_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'toggle_videocta', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_videocta', 
            array(
                'label'       => esc_html__( 'Enable Video CTA', 'medicall' ),
                'description' => esc_html__( 'Enable to show the video CTA', 'medicall' ),
                'section'     => 'front_video_cta_section',
                'type'        => 'checkbox'
            )
        )
    );

    // Add setting for Video CTA Section Heading
    $wp_customize->add_setting(
        'front_video_cta_heading_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'front_video_cta_heading_setting', 
        array(
        'selector'        => '.center-heading.front-videocta',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'front_video_cta_heading_setting' ) );
            },  
        ) 
    );

    // Add setting for Video CTA Section Heading
    $wp_customize->add_control(
        'front_video_cta_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'front_video_cta_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontvideocta_active_callback'
        )
    );

    // Add setting for Video CTA Section SubHeading
    $wp_customize->add_setting(
        'front_video_cta_subheading_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'front_video_cta_subheading_setting', 
        array(
        'selector'        => '.center-title.front-videocta',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'front_video_cta_subheading_setting' ) );
            },  
        ) 
    );

    // Add control for appointment Section SubHeading
    $wp_customize->add_control(
        'front_video_cta_subheading_setting', 
        array(
            'label'   => esc_html__( 'Sub Heading', 'medicall' ),
            'section' => 'front_video_cta_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontvideocta_active_callback'
        )
    );

    // Add setting for Video CTA link text
    $wp_customize->add_setting(
        'front_video_cta_video_link_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        )
    );

    // Add control for link text
    $wp_customize->add_control(
        'front_video_cta_video_link_setting', 
        array(
            'label'           => esc_html__( 'Video Link', 'medicall' ),
            'section'         => 'front_video_cta_section',
            'type'            => 'url',
            'active_callback' => 'medicall_frontvideocta_active_callback'
        )
    );

    // Add setting for Video CTA Image
    $wp_customize->add_setting(
        'front_video_CTA_image_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    //Add Control Video CTA Image
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'front_video_CTA_image_setting',
            array(
                'description'     => esc_html__( 'Background Image', 'medicall' ),
                'section'         => 'front_video_cta_section',
                'active_callback' => 'medicall_frontvideocta_active_callback'
            )
        )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_frontvideocta');

function medicall_frontvideocta_active_callback( $control ){

    $toggle_videocta = $control->manager->get_setting( 'toggle_videocta' )->value();

    $id = $control->id;

    if( $id == 'front_video_cta_heading_setting' && $toggle_videocta ) return true;
    if( $id == 'front_video_cta_subheading_setting' && $toggle_videocta ) return true;
    if( $id == 'front_video_cta_video_link_setting' && $toggle_videocta ) return true;
    if( $id == 'front_video_CTA_image_setting' && $toggle_videocta ) return true;
    
    return false;
}

