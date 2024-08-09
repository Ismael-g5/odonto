<?php

if( ! function_exists( 'medicall_customize_register_layout_settings' ) ) :
    /**
     * Layout Settings
     *
     * @param [type] $wp_customize
     * @return void
     */
    function medicall_customize_register_layout_settings( $wp_customize ){
        
        $wp_customize->add_section(
            'layout_settings',
            array(
                'title'    => __( 'Layout Settings', 'medicall' ),
                'priority' => 60,
                'panel'    => 'general_settings_panel',
            )
        );

        $wp_customize->add_setting( 
            'single_page_layouts',
            array(
                'default'           => 'gl-right-wrap',
                'sanitize_callback' => 'medicall_radio_sanitization_header'
            )
        );
        
        $wp_customize->add_control( 
            new Medicall_Radio_Image_Control( 
                $wp_customize, 
                'single_page_layouts',
                array(
                    'label'       => __( 'Page Layouts', 'medicall' ),
                    'row'         => '2',
                    'section'     => 'layout_settings',
                    'choices' => array(
                        'gl-full-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
                            'name' => __( 'Full Width', 'medicall' )
                        ),
                        'gl-right-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
                            'name' => __( 'Right Sidebar', 'medicall' )
                        ),
                        'gl-left-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
                            'name' => __( 'Left Sidebar', 'medicall' )
                        ),
                    )
                )
            ) 
        ); 

        $wp_customize->add_setting( 
            'single_post_layouts',
            array(
                'default'           => 'gl-right-wrap',
                'sanitize_callback' => 'medicall_radio_sanitization_header'
            )
        );
        
        $wp_customize->add_control( 
            new Medicall_Radio_Image_Control( 
                $wp_customize, 
                'single_post_layouts',
                array(
                    'label'       => __( 'Post Layouts', 'medicall' ),
                    'row'         => '2',
                    'section'     => 'layout_settings',
                    'choices' => array(
                        'gl-full-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
                            'name' => __( 'Full Width', 'medicall' )
                        ),
                        'gl-right-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
                            'name' => __( 'Right Sidebar', 'medicall' )
                        ),
                        'gl-left-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
                            'name' => __( 'Left Sidebar', 'medicall' )
                        ),
                    )
                )
            ) 
        ); 


        $wp_customize->add_setting( 
            'archive_page_layouts',
            array(
                'default'           => 'gl-right-wrap',
                'sanitize_callback' => 'medicall_radio_sanitization_header'
            )
        );
        
        $wp_customize->add_control( 
            new Medicall_Radio_Image_Control( 
                $wp_customize, 
                'archive_page_layouts',
                array(
                    'label'       => __( 'Archive & Search Layouts', 'medicall' ),
                    'row'         => '2',
                    'section'     => 'layout_settings',
                    'choices' => array(
                        'gl-full-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/full-width.jpg',
                            'name' => __( 'Full Width', 'medicall' )
                        ),
                        'gl-right-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/right.jpg',
                            'name' => __( 'Right Sidebar', 'medicall' )
                        ),
                        'gl-left-wrap' => array(
                            'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/sidebar/left.jpg',
                            'name' => __( 'Left Sidebar', 'medicall' )
                        ),
                    )
                )
            ) 
        ); 
    }
endif;
add_action('customize_register', 'medicall_customize_register_layout_settings');