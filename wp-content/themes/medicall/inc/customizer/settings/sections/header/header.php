<?php 

if( ! function_exists( 'medicall_customize_register_frontopbar' ) ) :
/**
 * Headers
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontopbar( $wp_customize ){

    // Create a new section top bar settings----------
    $wp_customize->add_section(
        'top_bar_section', 
        array(
            'title'    => esc_html__( 'Header Settings', 'medicall' ),
            'priority' => 20,
            'panel'    => 'general_settings_panel',
        )
    );
    
    // Add the toggle control to the section
	$wp_customize->add_setting(
        'topbar_toggle', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize,
            'topbar_toggle', 
            array(
                'label'       => esc_html__( 'Show/Hide Header', 'medicall' ),
                'description' => esc_html__( 'Enable to show the header.', 'medicall' ),
                'section'     => 'top_bar_section',
                'type'        => 'checkbox'
            )
        )
    );
    
    //add setting and control for email
    $wp_customize->add_setting(
        'email',
        array(
            'default'           => __( 'info@medical.com', 'medicall' ),
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'email', 
        array(
        'selector'        => '.email-link',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'email', __( 'info@medical.com', 'medicall' ) ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'email',
        array(
            'label'           => __( 'Email', 'medicall' ),
            'section'         => 'top_bar_section',
            'type'            => 'email',
            'active_callback' => 'medicall_frontheader_active_callback' 
        )
    );

    //add setting and control for ph number
    $wp_customize->add_setting(
        'phone_number',
        array(
            'default'           => __( '+1-202-555-0133', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'phone_number', 
        array(
        'selector'        => '.tel-link',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'phone_number', __( '+1-202-555-0133', 'medicall' ) ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'phone_number',
        array(
            'label'           => __( 'Phone Number', 'medicall' ),
            'section'         => 'top_bar_section',
            'type'            => 'text',
            'active_callback' => 'medicall_frontheader_active_callback' 
        )
    );

    //add setting and control for location
    $wp_customize->add_setting(
        'location',
        array(
            'default'           => __( 'Oklahoma', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'location', 
        array(
        'selector'        => '.location-link',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'location', __( 'Oklahoma', 'medicall' ) ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'location',
        array(
            'label'           => __( 'Location', 'medicall' ),
            'section'         => 'top_bar_section',
            'type'            => 'text',
            'active_callback' => 'medicall_frontheader_active_callback' 
        )
    );  
    
    $wp_customize->add_setting(
        'timing_info',
        array(
            'default'           => __( 'Mon - Fri: 9:00AM - 5:00PM', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    

    $wp_customize->selective_refresh->add_partial( 'timing_info', 
        array(
        'selector'        => '.timing-link',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'timing_info', __( 'Mon - Fri: 9:00AM - 5:00PM', 'medicall' ) ) );
            },  
        ) 
    );

    $wp_customize->add_control(
        'timing_info',
        array(
            'label'           => __( 'Timing Info', 'medicall' ),
            'section'         => 'top_bar_section',
            'type'            => 'text',
            'active_callback' => 'medicall_frontheader_active_callback' 
        )
    );  

    //adding setting for plain tile link
    $wp_customize->add_setting(
        'header_plain_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'header_plain_title', 
        array(
            'selector'        => '.col-4-xl .header-right',
            'render_callback' => function() {
                return esc_html( get_theme_mod( 'header_plain_title' ) );
            },  
        ) 
    );

    //add control for plain title
    $wp_customize->add_control(
        'header_plain_title',
        array(
            'label'           => __( 'Button Text', 'medicall' ),
            'section'         => 'top_bar_section',
            'type'            => 'text',
        )
    );

    //adding setting for plain tile link
    $wp_customize->add_setting(
        'plain_title_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    //add control for plain title link
    $wp_customize->add_control(
        'plain_title_link',
        array(
            'label'           => __('Button Url', 'medicall'),
            'section'         => 'top_bar_section',
            'type'            => 'url',
        )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_frontopbar');

function medicall_frontheader_active_callback( $control ){

    $topbar_toggle = $control->manager->get_setting( 'topbar_toggle' )->value();

    $id = $control->id;

    if( $id == 'email' && $topbar_toggle ) return true;
    if( $id == 'phone_number' && $topbar_toggle ) return true;
    if( $id == 'location' && $topbar_toggle ) return true;
    if( $id == 'timing_info' && $topbar_toggle ) return true;
    
    return false;
}