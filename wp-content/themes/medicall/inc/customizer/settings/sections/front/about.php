<?php 

if( ! function_exists( 'medicall_customize_register_aboutpage' ) ) :
/**
 * Frontabout
 *
 * @param [type] $wp_customize
 * @return void
 */
function medicall_customize_register_aboutpage( $wp_customize ){
    $wp_customize->add_section(
        'about_section', 
        array(
            'title'      => esc_html__( 'About Section', 'medicall' ),
            'priority'   => 20,
            'panel'      => 'frontpage_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'toggle_aboutus', 
        array(
            'default'           => false,
            'sanitize_callback' => 'medicall_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        new Medicall_Toggle_Control(
            $wp_customize, 
            'toggle_aboutus', 
            array(
                'label'       => esc_html__( 'Enable About Us', 'medicall' ),
                'description' => esc_html__( 'Enable to show the about us', 'medicall' ),
                'section'  => 'about_section',
                'type'    => 'checkbox'
            )
        )
    );
    
    // Add setting for about big Image
    $wp_customize->add_setting(
        'about_big_image', 
        array(
            'default'           => esc_url( get_template_directory_uri() . '/assets/images/about.jpg' ),
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    //Add Control for about big Image
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_big_image',
            array(
                'description' => esc_html__( 'Upload Large Image', 'medicall' ),
                'section'     => 'about_section',  
                'active_callback' => 'medicall_front_aboutus_active_callback'
            )
        )
    );

    // Add setting for about Small Image
    $wp_customize->add_setting(
        'about_small_image', 
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    //Add Control for about Small Image
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_small_image',
            array(
                'description' => esc_html__( 'Upload Small Image', 'medicall' ),
                'section'     => 'about_section',  
                'active_callback' => 'medicall_front_aboutus_active_callback'
            )
        )
    );

    // Add setting for heading
    $wp_customize->add_setting(
        'about_heading_setting',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial(
        'about_heading_setting', 
        array(
        'selector'        => '.about .center-heading',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'about_heading_setting' ) );
            },  
        ) 
    );

    // Add control for heading
    $wp_customize->add_control(
        'about_heading_setting', 
        array(
            'label'   => esc_html__( 'Heading', 'medicall' ),
            'section' => 'about_section',
            'type'    => 'text', 
            'active_callback' => 'medicall_front_aboutus_active_callback'
        )
    );

    // Add setting for subheading
    $wp_customize->add_setting(
        'about_subheading_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'about_subheading_setting', 
        array(
        'selector'        => '.about .center-title',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'about_subheading_setting' ) );
            },  
        ) 
    );

    // Add control for subheading
    $wp_customize->add_control(
        'about_subheading_setting', 
        array(
            'label'   => esc_html__( 'Sub Heading', 'medicall' ),
            'section' => 'about_section',
            'type'    => 'text', 
            'active_callback' => 'medicall_front_aboutus_active_callback'
        )
    );

    // Add setting for About Description
    $wp_customize->add_setting(
        'about_description_setting', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'about_description_setting', 
        array(
        'selector'        => '.about-desc',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'about_description_setting' ) );
            },  
        ) 
    );

    //Add Control for About Description
    $wp_customize->add_control(
        'about_description_setting', 
        array(
            'label'     => esc_html__( 'Description', 'medicall' ),
            'section'   => 'about_section',
            'type'      => 'text',  
            'active_callback' => 'medicall_front_aboutus_active_callback'
        )
    );

    $wp_customize->add_setting( 
		new Medicall_Repeater_Setting( 
			$wp_customize, 
			'about_list_repeater', 
			array(
				'default'           => '',
				'sanitize_callback' => array( 'Medicall_Repeater_Setting', 'sanitize_repeater_setting' ),                             
			) 
		) 
	);
	
	$wp_customize->add_control(
		new Medicall_Control_Repeater(
			$wp_customize,
			'about_list_repeater',
			array(
				'section' => 'about_section',				
				'label'	  => __( 'Add About List', 'medicall' ),
				'fields'  => array(
					'text' => array(
						'type'  => 'text', 
						'label' => __( 'Add Text', 'medicall' ),                
					),
                ),
				'row_label' => array(
					'type'  => 'field',
					'value' => __( 'About List', 'medicall' ),
					'field' => 'title',
				),
                'active_callback' => 'medicall_front_aboutus_active_callback'                                            
            )
		)
	);

    $wp_customize->add_setting( 
		new Medicall_Repeater_Setting( 
			$wp_customize, 
			'about_icon_repeater', 
			array(
				'default'           => '',
				'sanitize_callback' => array( 'Medicall_Repeater_Setting', 'sanitize_repeater_setting' ),
			) 
		) 
	);
	
	$wp_customize->add_control(
		new Medicall_Control_Repeater(
			$wp_customize,
			'about_icon_repeater',
			array(
				'section' => 'about_section',				
				'label'	  => __( 'Add Feature', 'medicall' ),
				'fields'  => array(
                    'image'=>array(
                        'type'=>'image',
                        'label'=>  __( 'Upload Image', 'medicall' ),
                    ),
					'title' => array(
						'type'  => 'text', 
						'label' => __( 'Add Title', 'medicall' ),                
					),
                    'url' => array(
                        'type'  => 'text', 
                        'label' => __( 'Add Url', 'medicall' ),                
                    ),
				),
				'row_label' => array(
					'type'  => 'field',
					'value' => __( 'Feature', 'medicall' ),
					'field' => 'title',
				),   
                'choices'   => array(
                    'limit' => 3
                ),
                'active_callback' => 'medicall_front_aboutus_active_callback'                                 
			)
		)
	);

    // Add setting for about button text
    $wp_customize->add_setting(
        'about_button_text', 
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'about_button_text', 
        array(
        'selector'        => '.about-btn-con',
        'render_callback' => function() {
                return esc_html( get_theme_mod( 'about_button_text' ) );
            },  
        ) 
    );

    // Add control for about button text
    $wp_customize->add_control(
        'about_button_text', 
        array(
            'label'   => esc_html__( 'Button Text', 'medicall' ),
            'section' => 'about_section',
            'type'    => 'text', 
            'active_callback' => 'medicall_front_aboutus_active_callback'
        )
    );

    // Add setting for about Button link
    $wp_customize->add_setting(
        'about_button_link', 
        array(
            'default'           => '', 
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    // Add control for about Button Link
    $wp_customize->add_control(
        'about_button_link', 
        array(
            'label'   => esc_html__( 'Button Link', 'medicall' ),
            'section' => 'about_section',
            'type'    => 'url',
            'active_callback' => 'medicall_front_aboutus_active_callback'
        )
    );
}
endif;
add_action('customize_register', 'medicall_customize_register_aboutpage');

function medicall_front_aboutus_active_callback( $control ){

    $toggle_aboutus = $control->manager->get_setting( 'toggle_aboutus' )->value();

    $id = $control->id;

    if( $id == 'about_big_image' && $toggle_aboutus ) return true;
    if( $id == 'about_small_image' && $toggle_aboutus ) return true;
    if( $id == 'about_heading_setting' && $toggle_aboutus ) return true;
    if( $id == 'about_subheading_setting' && $toggle_aboutus ) return true;
    if( $id == 'about_description_setting' && $toggle_aboutus ) return true;
    if( $id == 'about_list_repeater' && $toggle_aboutus ) return true;
    if( $id == 'about_icon_repeater' && $toggle_aboutus ) return true;
    if( $id == 'about_button_text' && $toggle_aboutus ) return true;
    if( $id == 'about_button_link' && $toggle_aboutus ) return true;
    
    return false;
}