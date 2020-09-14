<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NicePress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<style type="text/css" id="custom-theme-colors">
		.main-navigation a {color: <?php echo get_theme_mod('np_menu_link_color'); ?>;}
		.main-navigation a:hover {color: <?php echo get_theme_mod('np_hover_menu_link_color'); ?>;}
		.current-menu-item a {color: <?php echo get_theme_mod('np_current_menu_link_color'); ?>;}
		.main-navigation {border-bottom-color: <?php echo get_theme_mod('np_border_color'); ?>;}
		.site-footer {border-top-color: <?php echo get_theme_mod('np_border_color'); ?>;}
		.site-main a, .site-footer a {color: <?php echo get_theme_mod('np_link_color'); ?>;}
		.site-main a:hover, .site-footer a:hover {color:<?php echo get_theme_mod('np_link_hover_color'); ?>;}
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nicepress' ); ?></a>

	<nav id="site-navigation" class="main-navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( '&equiv;', 'nicepress' ); ?></button>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			)
		);
		?>
	</nav><!-- #site-navigation -->

	<header id="masthead" class="site-header" <?php if (get_header_image() ) :?> style="background-image: url('<?php header_image(); ?>'); background-size: cover; min-height: 250px;" <?php endif; ?>>
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
			endif;

			$nicepress_description = get_bloginfo( 'description', 'display' );
			if ( $nicepress_description || is_customize_preview() ) :
				?>
				<p class="site-description"><em><?php echo $nicepress_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></em></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
