<?php 

if( ! function_exists( 'medicall_customize_register_frontappointment' ) ) :
/**
 * FrontAppointment
 *
 * @param [type] $wp_customize
 * @return void
*/
function medicall_customize_register_frontappointment( $wp_customize ){
    $wp_customize->add_section(
        'front_appointment_section', 
            array(
                'title'      => esc_html__( 'Appointment Settings', 'medicall' ),
                'priority'   => 60,
                'panel'      => 'frontpage_settings_panel',
            )
    );

    $wp_customize->add_setting(
        'toggle_appoinment', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_appoinment', 
            array(
                'label'       => esc_html__( 'Enable Appointment', 'medicall' ),
                'description' => esc_html__( 'Enable to show the appointment', 'medicall' ),
                'section'     => 'front_appointment_section',
                'type'        => 'checkbox'
            )
        )
    );

    // Add setting for Appointment Image
    $wp_customize->add_setting(
        'appointment_image_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )   
    );

    //Add Control Appointment Image
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'appointment_image_setting',
                array(
                    'description' => esc_html__( 'Upload Image', 'medicall' ),
                    'section'     => 'front_appointment_section',
                    'active_callback' => 'medicall_frontappoinment_active_callback'
                )
        )
    );

    // Add setting for appointment Section Heading
    $wp_customize->add_setting(
        'appointment_heading_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
    );

    $wp_customize->selective_refresh->add_partial( 
        'appointment_heading_setting', 
            array(
            'selector'        => 'h2.center-heading.start-heading.appoinment',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'appointment_heading_setting', __( 'Book An Appointment', 'medicall' ) ) );
                },  
            ) 
    );

    // Add setting for appointment Section Heading
    $wp_customize->add_control(
        'appointment_heading_setting', 
            array(
                'label'   => esc_html__( 'Heading', 'medicall' ),
                'section' => 'front_appointment_section',
                'type'    => 'text',
                'active_callback' => 'medicall_frontappoinment_active_callback'
            )
    );

    // Add setting for appointment Section SubHeading
    $wp_customize->add_setting(
        'appointment_subheading_setting', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
    );

    $wp_customize->selective_refresh->add_partial( 
        'appointment_subheading_setting', 
            array(
            'selector'        => 'span.center-title.appoinment',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'appointment_subheading_setting', __( 'Flexible Booking Hours', 'medicall' ) ) );
                },  
            ) 
    );

    // Add control for appointment Section SubHeading
    $wp_customize->add_control(
        'appointment_subheading_setting', 
            array(
                'label'   => esc_html__( 'Sub Heading', 'medicall' ),
                'section' => 'front_appointment_section',
                'type'    => 'text',
                'active_callback' => 'medicall_frontappoinment_active_callback'
            )
    );

    // Add setting for Description
    $wp_customize->add_setting(
        'appointment_description', 
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
    );

    $wp_customize->selective_refresh->add_partial( 
        'appointment_description', 
            array(
            'selector'        => '.appointment-form',
            'render_callback' => function() {
                    return esc_html( get_theme_mod( 'appointment_description', __( 'Booking', 'medicall' ) ) );
                },  
            ) 
    );

    //Add Control for Description
    $wp_customize->add_control(
        'appointment_description', 
            array(
                'label'       => esc_html__( 'Description', 'medicall' ),
                'section'     => 'front_appointment_section',
                'type'        => 'text',
                'active_callback' => 'medicall_frontappoinment_active_callback'
            )
    );

    // Add setting appointment Form Shortcode
    $wp_customize->add_setting(
        'appointment_form_shortcode', 
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
    );

    // Add setting appointment Form Shortcode
    $wp_customize->add_control(
        'appointment_form_shortcode', 
            array(
                'label'   => esc_html__( 'Appointment Form Shortcode', 'medicall' ),
                'type'    => 'text',
                'section' => 'front_appointment_section',
                'active_callback' => 'medicall_frontappoinment_active_callback' 
            )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_frontappointment');

function medicall_frontappoinment_active_callback( $control ){

    $toggle_appoinment = $control->manager->get_setting( 'toggle_appoinment' )->value();

    $id = $control->id;

    if( $id == 'appointment_image_setting' && $toggle_appoinment ) return true;
    if( $id == 'appointment_heading_setting' && $toggle_appoinment ) return true;
    if( $id == 'appointment_subheading_setting' && $toggle_appoinment ) return true;
    if( $id == 'appointment_description' && $toggle_appoinment ) return true;
    if( $id == 'appointment_form_shortcode' && $toggle_appoinment ) return true;
    
    return false;
}
