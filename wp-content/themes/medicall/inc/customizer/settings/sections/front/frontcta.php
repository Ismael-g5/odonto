<?php 

if( ! function_exists( 'medicall_customize_register_frontcta' ) ) :
/**
 * Frontcta
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontcta( $wp_customize ){
   
    $wp_customize->add_section(
        'front_cta_section', 
        array(
            'title'      => esc_html__( 'CTA Settings', 'medicall' ),
            'priority'   => 80,
            'panel'      => 'frontpage_settings_panel',
        )
    );

    $wp_customize->add_setting('toggle_cta', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control($wp_customize, 'toggle_cta', 
            array(
                'label'       => esc_html__( 'Enable CTA', 'medicall' ),
                'description' => esc_html__( 'Enable to show the CTA', 'medicall' ),
                'section'  => 'front_cta_section',
                'type'    => 'checkbox'
            )
        )
    );

    // Add setting for Section Heading
    $wp_customize->add_setting(
        'front_cta_heading_setting', 
        array(
            'default'           =>  esc_html__( '30% off on All Our Services for this Week', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'front_cta_heading_setting', 
        array(
        'selector'        => '.front-cta .cta-heading',
        'render_callback' => 'medicall_front_cta_heading_render_callback',  
        ) 
    );

    //Add Control for Section Heading
    $wp_customize->add_control(
        'front_cta_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'front_cta_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontcta_active_callback'
        )
    );

    // Add setting for Section Description
    $wp_customize->add_setting(
        'front_cta_description_setting', 
        array(
            'default'           => esc_html__( 'I am so grateful for the care and attention that I received from my healthcare provider. They were incredibly kind and understanding.', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'front_cta_description_setting', 
        array(
        'selector'        => '.front-cta .cta-content-wrapper p',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'front_cta_description_setting', esc_html__( 'I am so grateful for the care and attention that I received from my healthcare provider. They were incredibly kind and understanding.', 'medicall' ) ) );
            },  
        ) 
    );

    //Add Control for Section Description
    $wp_customize->add_control(
        'front_cta_description_setting', 
        array(
            'label'       => esc_html__( 'Description', 'medicall' ),
            'section'     => 'front_cta_section',
            'type'        => 'text',
            'active_callback' => 'medicall_frontcta_active_callback'
        )
    );

    // Add setting for CTA Image
    $wp_customize->add_setting(
        'front_cta_image', 
        array(
            'default'           => esc_url( get_template_directory_uri() . '/assets/images/granny-doctor.jpg' ),
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    //Add Control for CTA Image
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'front_cta_image',
            array(
                'description' => esc_html__( 'Upload Image', 'medicall' ),
                'section'     => 'front_cta_section',
                'active_callback' => 'medicall_frontcta_active_callback'
            )
        )
    );

    // Add setting for cta Text
    $wp_customize->add_setting(
        'front_cta_button_text_setting', 
        array(
            'default'           => esc_html__( 'Book Now', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 
        'front_cta_button_text_setting', 
        array(
        'selector'        => '.front-cta .cta-content-wrapper a',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'front_cta_button_text_setting',  esc_html__( 'Book Now', 'medicall' ) ) );
            },  
        ) 
    );

    // Add control for cta Text
    $wp_customize->add_control(
        'front_cta_button_text_setting', 
        array(
            'label'   => esc_html__( 'Button Text', 'medicall' ),
            'section' => 'front_cta_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontcta_active_callback'
        )
    );

    // Add setting for cta link
    $wp_customize->add_setting(
        'front_cta_button_link_setting', 
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    // Add control for cta link
    $wp_customize->add_control(
        'front_cta_button_link_setting', 
        array(
            'label'   => esc_html__( 'Button Link', 'medicall' ),
            'section' => 'front_cta_section',
            'type'    => 'url',
            'active_callback' => 'medicall_frontcta_active_callback'
        )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_frontcta');

function medicall_frontcta_active_callback( $control ){

    $toggle_cta = $control->manager->get_setting( 'toggle_cta' )->value();

    $id = $control->id;

    if( $id == 'front_cta_heading_setting' && $toggle_cta ) return true;
    if( $id == 'front_cta_description_setting' && $toggle_cta ) return true;
    if( $id == 'front_cta_image' && $toggle_cta ) return true;
    if( $id == 'front_cta_button_text_setting' && $toggle_cta ) return true;
    if( $id == 'front_cta_button_link_setting' && $toggle_cta ) return true;

    
    return false;
}
function medicall_front_cta_heading_render_callback(){
    return esc_html( get_theme_mod( 'front_cta_heading_setting', __( '30% off on All Our Services for this Week', 'medicall' ) ) );
}