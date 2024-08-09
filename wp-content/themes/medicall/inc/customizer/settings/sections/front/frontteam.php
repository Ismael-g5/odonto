<?php 

if( ! function_exists( 'medicall_customize_register_frontteam' ) ) :
/**
 * Front team
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_frontteam( $wp_customize ){
    
    $wp_customize->add_section('front_team_section', 
        array(
            'title'      => esc_html__( 'Team Settings', 'medicall' ),
            'priority'   => 70,
            'panel'      => 'frontpage_settings_panel',
        )
    );

    $wp_customize->add_setting('toggle_team', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control($wp_customize, 'toggle_team', 
            array(
                'label'       => esc_html__( 'Enable Team', 'medicall' ),
                'description' => esc_html__( 'Enable to show the team', 'medicall' ),
                'section'     => 'front_team_section',
                'type'        => 'checkbox'
            )
        )
    );

    // Add setting for Team Section Heading
    $wp_customize->add_setting('front_team_heading_setting', 
        array(
            'default'           => esc_html__( 'Professional & Friendly Care Provider','medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'front_team_heading_setting', 
        array(
        'selector'        => '.center-heading.team',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'front_team_heading_setting', __( 'Professional & Friendly Care Provider', 'medicall' ) ) );
            },  
        ) 
    );

    // Add setting for Team Section Heading
    $wp_customize->add_control('front_team_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'front_team_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontteam_active_callback' 
        )
    );

    // Add setting for Team Section SubHeading
    $wp_customize->add_setting('front_team_subheading_setting', 
        array(
            'default'           => esc_html__( 'Our Experts', 'medicall' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'front_team_subheading_setting', 
        array(
        'selector'        => '.center-title.team',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'front_team_subheading_setting', __( 'Our Experts', 'medicall' ) ) );
            },  
        ) 
    );

    // Add control for Team Section SubHeading
    $wp_customize->add_control('front_team_subheading_setting', 
        array(
            'label'   => esc_html__( 'Sub Heading', 'medicall' ),
            'section' => 'front_team_section',
            'type'    => 'text',
            'active_callback' => 'medicall_frontteam_active_callback' 
        )
    );

    /** Dynamic Team Section */
    $wp_customize->add_setting( 
		new Medicall_Repeater_Setting( 
			$wp_customize, 
			'front_team_repeater', 
			array(
				'default'           => array(),
				'sanitize_callback' => array( 'Medicall_Repeater_Setting', 'sanitize_repeater_setting' ),                             
			) 
		) 
	);

	$wp_customize->add_control(
		new Medicall_Control_Repeater(
			$wp_customize,
			'front_team_repeater',
			array(
				'section' => 'front_team_section',				
				'label'	  => __( 'Add Team', 'medicall' ),
				'fields'  => array(
					'icon' => array(
						'type'  => 'image', 
						'label' => __( 'Team Image', 'medicall' ),                
					),
					'name' => array(
						'type'  => 'text', 
						'label' => __( 'Name', 'medicall' ),                
					),
                    'faculty' => array(
						'type'  => 'text', 
						'label' => __( 'Faculty', 'medicall' ),                
					),
                    'designation' => array(
						'type'  => 'text', 
						'label' => __( 'Designation', 'medicall' ),                
					),
                    'excerpt' => array(
						'type'  => 'text', 
						'label' => __( 'Excerpt', 'medicall' ),                
					),
				),
				'row_label' => array(
					'type'  => 'field',
					'value' => __( 'Team Block', 'medicall' ),
					'field' => 'title',
				),      
                'choices'   => array(
                    'limit' => 3
                ),   
                'active_callback' => 'medicall_frontteam_active_callback'                           
			)
		)
	);
}
endif;
add_action('customize_register', 'medicall_customize_register_frontteam');

function medicall_frontteam_active_callback( $control ){

    $toggle_team = $control->manager->get_setting( 'toggle_team' )->value();

    $id = $control->id;

    if( $id == 'front_team_heading_setting' && $toggle_team ) return true;
    if( $id == 'front_team_subheading_setting' && $toggle_team ) return true;
    if( $id == 'front_team_repeater' && $toggle_team ) return true;
    
    return false;
}

