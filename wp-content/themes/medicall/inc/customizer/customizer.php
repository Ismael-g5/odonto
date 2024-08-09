<?php
/**
 * Medicall Theme Customizer
 *
 * @package Medicall
 */

 /**
 * Customizer Whole Control.
 */
require get_template_directory() . '/inc/customizer/customizer-controls/customizer-controls.php';

/**
 * Customizer Settings Enqueue.
 */
require get_template_directory() . '/inc/customizer/settings/customizer-settings.php';

/**
 * Sanitization functions
 */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

function medicall_customize_register( $wp_customize ){

	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'medicall_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'medicall_customize_partial_blogdescription',
			)
		);
	}	

}
add_action('customize_register', 'medicall_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function medicall_customize_partial_blogname(){
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function medicall_customize_partial_blogdescription(){
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function medicall_customize_preview_js(){
	wp_enqueue_script('medicall-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), MEDICALL_VERSION, true);

}
add_action('customize_preview_init', 'medicall_customize_preview_js');


function medicall_customize_script(){

	wp_enqueue_style( 
		'medicall-customizer', 
		get_template_directory_uri() . '/inc/css/customize.css'
	);

	wp_enqueue_script( 
		'medicall-customize',
		get_template_directory_uri() . '/inc/js/customize.js', 
		array( 'jquery', 'customize-controls' ), 
		"1.0.0",
		true 
	);

}
add_action( 'customize_controls_enqueue_scripts', 'medicall_customize_script' );
