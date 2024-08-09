<?php 

if( ! function_exists( 'medicall_customize_register_frontdepartment' ) ) :
/**
 * Frontdepartment
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontdepartment( $wp_customize ){

    $wp_customize->add_section('department_section', 
        array(
            'title'      => esc_html__( 'Department Settings', 'medicall' ),
            'priority'   => 40,
            'panel'      => 'frontpage_settings_panel',
        )
    );

    $wp_customize->add_setting('toggle_department', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control($wp_customize, 'toggle_department', 
            array(
                'label'       => esc_html__( 'Enable Department', 'medicall' ),
                'description' => esc_html__( 'Enable to show the department', 'medicall' ),
                'section'  => 'department_section',
                'type'    => 'checkbox'
            )
        )
    );
    
    // Add setting for Section Heading
    $wp_customize->add_setting('department_heading_setting', 
        array(
            'default'           =>  __( 'Our Medical Services', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'department_heading_setting', 
        array(
        'selector'        => 'h2.center-heading.depart',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'department_heading_setting', __( 'Our Medical Services', 'medicall' ) ) );
            },  
        ) 
    );

    // Add setting for Service Section Heading
    $wp_customize->add_control('department_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'department_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontdepartment_active_callback'
        )
    );

    // Add setting for Service Section SubHeading
    $wp_customize->add_setting('department_subheading_setting', 
        array(
            'default'           => esc_html__( 'Our Departments', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'department_subheading_setting', 
        array(
        'selector'        => 'span.center-title.depart',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'department_subheading_setting', __( 'Our Departments', 'medicall' ) ) );
            },  
        ) 
    );

    // Add setting for Service Section SubHeading
    $wp_customize->add_control('department_subheading_setting', 
        array(
            'label'   => esc_html__( 'Sub Heading', 'medicall' ),
            'section' => 'department_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontdepartment_active_callback'
        )
    );

    // Add setting for Service Readmore button
    $wp_customize->add_setting('department_button_text_setting', 
        array(
            'default'           => esc_html__( 'View More', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'department_button_text_setting', 
        array(
        'selector'        => '.home.department-card a',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'department_button_text_setting', __( 'View More', 'medicall' ) ) );
            },  
        ) 
    );

    // Add setting for Service Section SubHeading
    $wp_customize->add_control('department_button_text_setting', 
        array(
            'label'   => esc_html__( 'Button Text', 'medicall' ),
            'section' => 'department_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontdepartment_active_callback'
        )
    );

    /** Dynamic Department Section */
     $wp_customize->add_setting( 
		new Medicall_Repeater_Setting( 
			$wp_customize, 
			'front_department_repeater', 
			array(
				'default'           => array(),
				'sanitize_callback' => array( 'Medicall_Repeater_Setting', 'sanitize_repeater_setting' ),                             
			) 
		) 
	);

	$wp_customize->add_control(
		new Medicall_Control_Repeater(
			$wp_customize,
			'front_department_repeater',
			array(
				'section' => 'department_section',				
				'label'	  => __( 'Add Department', 'medicall' ),
				'fields'  => array(
					'icon' => array(
						'type'  => 'image', 
						'label' => __( 'Department Image', 'medicall' ),                
					),
					'headings' => array(
						'type'  => 'text', 
						'label' => __( 'Heading', 'medicall' ),                
					),
                    'excerpt' => array(
						'type'  => 'text', 
						'label' => __( 'Excerpt', 'medicall' ),                
					),
                    'features' => array(
						'type'  => 'textarea', 
						'label' => __( 'Feature', 'medicall' ),
                        'description'     => __( 'Press Enter for the line break', 'medicall' ),                
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
					'value' => __( 'Department Block', 'medicall' ),
					'field' => 'title',
				),      
                'choices'   => array(
                    'limit' => 3
                ),    
                'active_callback' => 'medicall_frontdepartment_active_callback'                         
			)
		)
	);
}
endif;
add_action('customize_register', 'medicall_customize_register_frontdepartment');

function medicall_frontdepartment_active_callback( $control ){

    $toggle_department = $control->manager->get_setting( 'toggle_department' )->value();

    $id = $control->id;

    if( $id == 'department_heading_setting' && $toggle_department ) return true;
    if( $id == 'department_subheading_setting' && $toggle_department ) return true;
    if( $id == 'department_button_text_setting' && $toggle_department ) return true;
    if( $id == 'front_department_repeater' && $toggle_department ) return true;
    
    return false;
}



