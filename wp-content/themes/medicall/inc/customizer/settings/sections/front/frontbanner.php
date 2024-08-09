<?php 

if( ! function_exists( 'medicall_customize_register_frontbanner' ) ) :

/**
 * Frontbanner
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontbanner( $wp_customize ){
   
    $wp_customize->add_section(
        'banner_section', 
        array(
            'title'      => esc_html__( 'Banner Section', 'medicall' ),
            'priority'   => 10,
            'panel'      => 'frontpage_settings_panel',
        )
    );

	$wp_customize->add_setting(
        'toggle_banner', 
        array(
            'default'           => true,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_banner', 
            array(
                'label'       => esc_html__( 'Enable Banner', 'medicall' ),
                'description' => esc_html__( 'Enable to show the banner', 'medicall' ),
                'section'     => 'banner_section',
                'type'        => 'checkbox',
                'priority'    => 5
            )
        )
    );

    $wp_customize->get_control( 'header_image' )->section          = 'banner_section';
    $wp_customize->get_control( 'header_video' )->section          = 'banner_section';
    $wp_customize->get_control( 'external_header_video' )->section = 'banner_section';

    $wp_customize->get_control( 'header_image' )->priority          = 10;  // Set priority after banner_layouts
    $wp_customize->get_control( 'header_video' )->priority          = 10;
    $wp_customize->get_control( 'external_header_video' )->priority = 10;

    $wp_customize->get_control( 'header_image' )->active_callback          = 'medicall_frontbanner_active_callback';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'medicall_frontbanner_active_callback';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'medicall_frontbanner_active_callback';

   
    // Add setting for heading  
    $wp_customize->add_setting(
        'hero_heading_setting', 
        array(
            'default'           => esc_html__( 'WELCOME TO MEDICALL HEALTH CARE', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'hero_heading_setting', 
        array(
        'selector'        => '.banner-greet',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'hero_heading_setting', __( 'WELCOME TO MEDICALL HEALTH CARE', 'medicall' ) ) );
            },  
        ) 
    );

    // Add control for heading
     $wp_customize->add_control(
        'hero_heading_setting', 
        array(
            'label'   => esc_html__( 'Sub Heading', 'medicall' ),
            'section' => 'banner_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontbanner_active_callback'  
        )
    );

     // Add setting for subheading title one
     $wp_customize->add_setting(
        'hero_title_one', 
        array(
            'default'           => esc_html__( 'The Best Medical', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'hero_title_one', 
        array(
        'selector'        => 'h2.banner__title.is-plain',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'hero_title_one', __( 'The Best Medical', 'medicall' ) ) );
            },  
        ) 
    );

 
    // Add control for subheading title one
    $wp_customize->add_control(
        'hero_title_one', 
        array(
            'label'   => esc_html__( 'Sub Heading One', 'medicall' ),
            'section' => 'banner_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontbanner_active_callback'  
        )
    );
     // Add setting for subheading title two
     $wp_customize->add_setting(
        'hero_title_two', 
        array(
            'default'           => esc_html__( 'Services You Deserve', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'hero_title_two', 
        array(
        'selector'        => 'h2.banner__title.is-bold',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'hero_title_two', __( 'Services You Deserve', 'medicall' ) ) );
            },  
        ) 
    );

 
    // Add control for subheading title two
    $wp_customize->add_control('hero_title_two', 
        array(
            'label'   => esc_html__( 'Sub Heading Two', 'medicall' ),
            'section' => 'banner_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontbanner_active_callback'  
        )
    );

    // Add setting for Banner Description
    $wp_customize->add_setting(
        'hero_banner_description_setting', 
        array(
            'default'           => esc_html__( 'Our specialists are highly compassionate and professional in dealing with your health. They are very much experienced.', 'medicall' ),
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'hero_banner_description_setting', 
        array(
        'selector'        => '.banner-description',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'hero_banner_description_setting', __( 'Our specialists are highly compassionate and professional in dealing with your health. They are very much experienced.', 'medicall' ) ) );
            },  
        ) 
    );

    //Add Control for Banner Description
    $wp_customize->add_control(
        'hero_banner_description_setting', 
        array(
            'label'       => esc_html__( 'Description', 'medicall' ),
            'section'     => 'banner_section',
            'type'        => 'textarea',
            'active_callback' => 'medicall_frontbanner_active_callback'  
        )
    );

    //Banner Button 1 Text Setting
    $wp_customize->add_setting(
        'banner_btn_one_text', 
        array(
            'default'           => esc_html__( 'Find A Doctor', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'banner_btn_one_text', 
        array(
        'selector'        => '.banner-six .banner-left-btm a:first-child',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'banner_btn_one_text', __( 'Find A Doctor', 'medicall' ) ) );
            },  
        ) 
    );

    //Banner Button 1 Text Control
    $wp_customize->add_control(
        'banner_btn_one_text', 
        array(
            'label'       => esc_html__( 'Button One Text', 'medicall' ),
            'section'     => 'banner_section',
            'type'        => 'text',
            'active_callback' => 'medicall_frontbanner_active_callback'  
        )
    );

    // Banner Button 1 Link setting
    $wp_customize->add_setting(
        'banner_btn_one_link', 
        array(
            'default'           => "#",
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    // Banner Button 1 Link control
    $wp_customize->add_control(
        'banner_btn_one_link', 
        array(
            'label'   => esc_html__( 'Button One Link', 'medicall' ),
            'section' => 'banner_section',
            'type'    => 'url',
            'active_callback' => 'medicall_frontbanner_active_callback'  
        )
    );

}
endif;
add_action('customize_register', 'medicall_customize_register_frontbanner');

function medicall_frontbanner_active_callback( $control ){

    $toggle_banner = $control->manager->get_setting( 'toggle_banner' )->value();

    $id = $control->id;

    if( $id == 'header_image' && $toggle_banner ) return true;
    if( $id == 'header_video' && $toggle_banner ) return true;
    if( $id == 'external_header_video' && $toggle_banner ) return true;
    if( $id == 'hero_heading_setting' && $toggle_banner ) return true;
    if( $id == 'hero_title_one' && $toggle_banner ) return true;
    if( $id == 'hero_title_two' && $toggle_banner ) return true;
    if( $id == 'hero_banner_description_setting' && $toggle_banner ) return true;
    if( $id == 'banner_btn_one_text' && $toggle_banner ) return true;
    if( $id == 'banner_btn_one_link' && $toggle_banner ) return true;
    
    return false;
}