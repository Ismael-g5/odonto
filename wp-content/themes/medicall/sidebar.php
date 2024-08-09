<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medicall
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}

if( medicall_sidebar_layout() === 'gl-full-wrap' ){
	return;
}
?>
<div class="col-4-lg col-12-xs sidebar-main">
	<aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="https://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'primary-sidebar' ); ?>
	</aside><!-- #secondary -->
</div>
