<?php 
function medicall_customizer_controls_registration( $wp_customize ) {
    require_once get_template_directory() . '/inc/customizer/customizer-controls/toggle/toggle-control.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/repeater/settings.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/repeater/repeater.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/note/note-control.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/radio/radio-control.php';
    require_once get_template_directory() . '/inc/customizer/customizer-controls/pro/viewpro-control.php';

    $wp_customize->register_control_type( 'Medicall_Toggle_Control' );
    $wp_customize->register_control_type( 'Medicall_Customize_Section_Pro' );
}
add_action( 'customize_register', 'medicall_customizer_controls_registration' );