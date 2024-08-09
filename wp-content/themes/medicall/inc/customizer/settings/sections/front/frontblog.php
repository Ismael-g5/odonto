<?php 

if( ! function_exists( 'medicall_customize_register_frontblog' ) ) :
/**
 * Frontblog
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontblog( $wp_customize ){
   
    $wp_customize->add_section(
        'blog_section', 
        array(
            'title'      => esc_html__( 'Blog Settings', 'medicall' ),
            'priority'   => 90,
            'panel'      => 'frontpage_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'toggle_blog', 
        array(
            'default'           => true,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_blog', 
            array(
                'label'       => esc_html__( 'Enable Blog', 'medicall' ),
                'description' => esc_html__( 'Enable to show the blog', 'medicall' ),
                'section'  => 'blog_section',
                'type'    => 'checkbox'
            )
        )
    );

    // Add setting for Section Heading
    $wp_customize->add_setting(
        'blog_heading_setting', 
        array(
            'default'           => esc_html__( 'What Is New In Medicall Health Care', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blog_heading_setting', 
        array(
        'selector'        => '.front-blog h2.center-heading.blog',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'blog_heading_setting',  esc_html__( 'What Is New In Medicall Health Care', 'medicall' ) ) );
            },  
        ) 
    );

    //Add Control for Section Heading
    $wp_customize->add_control(
        'blog_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'blog_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontblog_active_callback'
        )
    );

    // Add setting for Section Subheading
    $wp_customize->add_setting(
        'blog_subheading_setting', 
        array(
            'default'           => esc_html__( 'Our Blogs', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blog_subheading_setting', 
        array(
        'selector'        => '.front-blog span.center-title.blog',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'blog_subheading_setting', esc_html__( 'Our Blogs', 'medicall' ) ) );
            },  
        ) 
    );

    //Add Control for Section Subheading
    $wp_customize->add_control(
        'blog_subheading_setting', 
        array(
            'label'       => esc_html__( 'Sub Heading', 'medicall' ),
            'section'     => 'blog_section',
            'type'        => 'text',
            'active_callback' => 'medicall_frontblog_active_callback'
        )
    );

    // Add setting for blog button Text
    $wp_customize->add_setting(
        'blog_button_text', 
        array(
            'default'           => esc_html__( 'Read More', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 
        'blog_button_text', 
        array(
        'selector'        => '.front-blog .article__body a.btn__text',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'blog_button_text', esc_html__( 'Read More', 'medicall' ) ) );
            },  
        ) 
    );

    // Add control for blog button Text
    $wp_customize->add_control(
        'blog_button_text', 
        array(
            'label'   => esc_html__( 'Button Text', 'medicall' ),
            'section' => 'blog_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontblog_active_callback'
        )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_frontblog');


function medicall_frontblog_active_callback( $control ){

    $toggle_blog = $control->manager->get_setting( 'toggle_blog' )->value();

    $id = $control->id;

    if( $id == 'blog_heading_setting' && $toggle_blog ) return true;
    if( $id == 'blog_subheading_setting' && $toggle_blog ) return true;
    if( $id == 'blog_button_text' && $toggle_blog ) return true;
    
    return false;
}
