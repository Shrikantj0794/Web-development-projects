<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Portfolio Kit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action('portfolio_kit_mobile_menu'); ?>
	<?php
	$portfolio_kit_main_menu_style = get_theme_mod('portfolio_kit_main_menu_style', 'style1');
	?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'portfolio-kit'); ?></a>
		<header id="masthead" class="site-header px-h<?php echo esc_attr($portfolio_kit_main_menu_style); ?>">
			<?php if (has_header_image()) : ?>
				<div class="header-img">
					<?php the_header_image_tag(); ?>
				</div>
			<?php endif; ?>
			<?php

			if ($portfolio_kit_main_menu_style == 'style1') {
				do_action('portfolio_kit_header_style_one');
			} else {
				do_action('portfolio_kit_header_style_two');
			}
			?>
		</header><!-- #masthead -->

		<?php
		$portfolio_kit_intro_show = get_theme_mod('portfolio_kit_intro_show');
		if ($portfolio_kit_intro_show && (is_home() || is_front_page())) {
			do_action('portfolio_kit_profile_intro');
		}

		?>