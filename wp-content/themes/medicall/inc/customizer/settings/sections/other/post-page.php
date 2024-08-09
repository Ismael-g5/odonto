<?php

if( ! function_exists( 'medicall_customize_register_postpage' ) ) :
/**
 * Posts(Blog) & Pages Settings
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_postpage( $wp_customize ){
    
    /** Posts(Blog) & Pages Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Post & Pages Settings', 'medicall' ),
            'priority' => 40,
            'panel'    => 'general_settings_panel',
        )
    );
    
    // Add the toggle control to the section
	$wp_customize->add_setting(
        'mp_author', 
        array(
            'default'           => true,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'mp_author', 
            array(
                'label'       => esc_html__( 'Show/Hide Author Section','medicall' ),
                'description' => esc_html__( 'Enable to show author section in the post.', 'medicall' ),
                'section'     => 'post_page_settings',
                'type'        => 'checkbox'
            )
        )
    );
    //add settings and control for Related Post subheading settings
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => esc_html__( 'Related Posts', 'medicall'),
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'related_post_title', 
        array(
        'selector'        => '.post-heading',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'related_post_title', esc_html__( 'Related Posts', 'medicall') ) );
            },  
        ) 
    );
    $wp_customize->add_control(
        'related_post_title',
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'post_page_settings',
            'type'    => 'text'
        )
    );

    //add settings and control for Readmore button
    $wp_customize->add_setting(
        'post_readmore_button',
        array(
            'default'           => esc_html__( 'Read More', 'medicall'),
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'post_readmore_button', 
        array(
        'selector'        => '.post-button',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'post_readmore_button',  esc_html__( 'Read More', 'medicall') ) );
            },  
        ) 
    );
    $wp_customize->add_control(
        'post_readmore_button',
        array(
            'label'   => esc_html__( 'Button Label', 'medicall' ),
            'section' => 'post_page_settings',
            'type'    => 'text'
        )
    );

    /** Show/hide Expert of the related Post */
    $wp_customize->add_setting(
        'toggle_related_post_excerpt', 
        array(
            'default'           => true,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_related_post_excerpt', 
            array(
                'label'	      => __( 'Show/Hide Excerpt', 'medicall' ),
                'description' => __( 'Enable to show excerpts in frontpage.', 'medicall' ),
                'section'     => 'post_page_settings',
                'type'        => 'checkbox'
            )
        )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_postpage');