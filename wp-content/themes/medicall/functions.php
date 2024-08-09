<?php
/**
 * Medicall functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Medicall
 */

if (!defined('MEDICALL_VERSION')) define('MEDICALL_VERSION', '1.0.0');
/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';
/**
 * Local Font Loader
 */
require get_template_directory() . '/inc/local-font-loader.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';
/**
 * Template Hooks Functions.
 */
require get_template_directory() . '/inc/template-hooks.php';
/**
 * WordPress Hooks for this theme.
 */
require get_template_directory() . '/inc/wp-hooked.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Template Functions
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Post Type Metas
 */
require get_template_directory() . '/inc/meta/cptmeta.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

if (medicall_woo_boolean()) {
	require get_template_directory() . '/inc/woo.php';
}