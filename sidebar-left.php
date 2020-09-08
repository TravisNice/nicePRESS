<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NicePress
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
?>

<aside id="sidebar-left" class="widget-area left">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</aside><!-- #secondary -->
