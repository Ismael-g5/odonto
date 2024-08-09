<?php
/**
 * Customizer Settings
*/
/**
 * Customizer Panel.
 */
function medicall_customize_register_panels($wp_customize){

	$wp_customize->get_section( 'colors' )->panel           = 'appearance_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'appearance_settings';
	$wp_customize->get_section( 'title_tagline' )->panel    = 'appearance_settings';
	$wp_customize->get_control('header_textcolor')->section = 'colors';
    
    $wp_customize->add_panel(
        'appearance_settings', 
        array(
            'title'          => esc_html__('Appearance Settings', 'medicall'),
            'priority'       => 10,
        )
    );

    $wp_customize->add_panel('frontpage_settings_panel', 
        array(
            'title'          => esc_html__('Front Page Settings', 'medicall'),
            'description'    => esc_html__('Static Home Page Settings.', 'medicall'),
            'priority'       => 10,
        )
    );

    $wp_customize->add_panel(
        'general_settings_panel',
        array(
            'title'          => esc_html__('General Settings', 'medicall'),
            'description'    => esc_html__('Header Settings, Social Links, Post and Page Settings, Layout Settings & Pagination Settings', 'medicall'),
            'priority'       => 10
        )
    );

    //----contact page settings panel----
    $wp_customize->add_panel(
        'contact_page_settings',
        array(
            'title'          => esc_html__('Contact Page Settings', 'medicall'),
            'description'    => esc_html__('Contact Detail Section, Form & Map Section', 'medicall'),
            'priority'       => 10
        )
    );
    //----End of contact page settings panel----
}
add_action('customize_register', 'medicall_customize_register_panels');

$medicall_all_sections = apply_filters( 'medicall_front_sections',[
    'front'        => ['frontbanner','frontservices','frontdepartment','frontappointment', 'frontvideocta','frontteam','frontcta','frontblog', 'about'],
    'header'       => ['header'],
    'contact'      => ['contactpagedetail','contactform','contactmap' ],
    'footer'       => ['footer'],
    'other'        => [ 'post-page', 'pagination', 'social-links', 'layout', 'theme-info', 'typography' ],
] );

/*
* Breaking everything into folder
*/
foreach( $medicall_all_sections as $foldername => $sectionslist ){ 
    foreach( $sectionslist as $ind ){        
        require get_template_directory() . '/inc/customizer/settings/sections/' . $foldername . '/' . $ind . '.php';
    }
}


