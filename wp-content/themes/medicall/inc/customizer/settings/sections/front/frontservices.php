<?php 

if( ! function_exists( 'medicall_customize_register_frontservice' ) ) :
/**
 * FrontService
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontservice( $wp_customize ){
    
    $wp_customize->add_section(
        'service_section', 
        array(
            'title'      => esc_html__( 'Service Settings', 'medicall' ),
            'priority'   => 30,
            'panel'      => 'frontpage_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'toggle_service', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_service', 
            array(
                'label'       => esc_html__( 'Enable Service', 'medicall' ),
                'description' => esc_html__( 'Enable to show the service', 'medicall' ),
                'section'  => 'service_section',
                'type'    => 'checkbox'
            )
        )
    );

    // Add setting for Service Section Heading
    $wp_customize->add_setting(
        'service_heading_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'service_heading_setting', 
        array(
        'selector'        => '.front-service span.center-title.service ',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'service_heading_setting' ) );
            },  
        ) 
    );

    // Add setting for Service Section Heading
    $wp_customize->add_control(
        'service_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'service_section',
            'type'    => 'text',  
            'active_callback' => 'medicall_frontservices_active_callback'  
        )
    );

    // Add setting for Service Section SubHeading
    $wp_customize->add_setting(
        'service_subheading_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'service_subheading_setting', 
        array(
        'selector'        => '.front-service h2.center-heading.serv',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'service_subheading_setting' ) );
            },  
        ) 
    );

    // Add setting for Service Section SubHeading
    $wp_customize->add_control(
        'service_subheading_setting', 
        array(
            'label'   => esc_html__( 'Sub Heading', 'medicall' ),
            'section' => 'service_section',
            'type'    => 'text',    
            'active_callback' => 'medicall_frontservices_active_callback' 
        )
    );

    // Add setting for Service Readmore button
    $wp_customize->add_setting(
        'service_button_text_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->add_setting( 
		new Medicall_Repeater_Setting( 
			$wp_customize, 
			'front_service_repeater', 
			array(
				'default'           => array(),
				'sanitize_callback' => array( 'Medicall_Repeater_Setting', 'sanitize_repeater_setting' ),                             
			) 
		) 
	);
	
	$wp_customize->add_control(
		new Medicall_Control_Repeater(
			$wp_customize,
			'front_service_repeater',
			array(
				'section' => 'service_section',				
				'label'	  => __( 'Add Services', 'medicall' ),
				'fields'  => array(
					'icon' => array(
						'type'  => 'image', 
						'label' => __( 'Service Image', 'medicall' ),                
					),
					'heading' => array(
						'type'  => 'text', 
						'label' => __( 'Heading', 'medicall' ),                
					),
                    'excerpt' => array(
						'type'  => 'text', 
						'label' => __( 'Excerpt', 'medicall' ),                
					),
                    'btn_label' => array(
						'type'  => 'text', 
						'label' => __( 'Button Label', 'medicall' ),                
					),
                    'btn_url' => array(
						'type'  => 'url', 
						'label' => __( 'Button URL', 'medicall' ),                
					),
				),
				'row_label' => array(
					'type'  => 'field',
					'value' => __( 'Service Block', 'medicall' ),
					'field' => 'title',
				),   
                'choices'   => array(
                    'limit' => 3
                ),  
                'active_callback' => 'medicall_frontservices_active_callback' ,                             
			)
		)
	);
}
endif;
add_action('customize_register', 'medicall_customize_register_frontservice');

function medicall_frontservices_active_callback( $control ){

    $toggle_service = $control->manager->get_setting( 'toggle_service' )->value();

    $id = $control->id;

    if( $id == 'service_heading_setting' && $toggle_service ) return true;
    if( $id == 'service_subheading_setting' && $toggle_service ) return true;
    if( $id == 'front_service_repeater' && $toggle_service ) return true;
    
    return false;
}
