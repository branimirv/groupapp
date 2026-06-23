<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GroupApp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> style="overscroll-behavior: none;">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="profile" href="https://gmpg.org/xfn/11"> -->

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<!-- Async font loading - non-blocking (optimized: only weights 300, 400, 500, 600, 700 + italic) -->
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
	<noscript>
		<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	</noscript>
	<?php groupapp_home_hero_preload_links(); ?>
	<?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<!-- <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'groupapp'); ?></a> -->

		<header>
			<div class="">
				<div class="row">
					<div class="col-12">
						<div class="header-top ">
							<div class="header-logo">
								<?php
								the_custom_logo();
								if (is_front_page() && is_home()) :
								?>
									<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
								<?php
								else :
								?>
									<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
								<?php
								endif;
								$groupapp_description = get_bloginfo('description', 'display');
								if ($groupapp_description || is_customize_preview()) :
								?>
									<p class="site-description"><?php echo $groupapp_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																?></p>
								<?php endif; ?>
							</div>
							<div class="header-menu links">
								<div class="mobile-menu-logo">
									<?php
									the_custom_logo();
									if (is_front_page() && is_home()) :
									?>
										<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
									<?php
									else :
									?>
										<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
									<?php
									endif;
									$groupapp_description = get_bloginfo('description', 'display');
									if ($groupapp_description || is_customize_preview()) :
									?>
										<p class="site-description"><?php echo $groupapp_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																	?></p>
									<?php endif; ?>
								</div>
								<div class="header-menu-link">
									<nav class="primary-nav" aria-label="<?php esc_attr_e('Primary', 'groupapp'); ?>">
										<?php
										wp_nav_menu(array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'header',
											'container'      => false,
											'items_wrap'     => '<ul id="%1$s" class="%2$s primary-nav__list">%3$s</ul>',
											'depth'          => 1,
											'walker'         => new Mega_Menu_Walker(),
										));
										?>
									</nav>

									<?php
									wp_nav_menu(array(
										'theme_location' => 'auth',
										'menu_id'        => 'auth',
									));
									?>
								</div>




							</div>
							<div class="menu-btn toggle">
								<div>
									<span></span>
									<span></span>
									<span></span>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</header>
