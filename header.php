<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package de-pikke
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#007E44">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<header class="header">
		<div class="header-top">
			<div class="container header-top-wrapper">
				<div class="header-top-box">
					<?php if (get_field('working_hours', 'option')) { ?>
						<div class="working-hours"><?php the_field('working_hours', 'option'); ?></div>
					<?php } ?>
					<?php if (get_field('header_phone', 'option')) { ?>
						<a class="phone-link" href="tel:<?php the_field('header_phone', 'option'); ?>" class=""><?php the_field('header_phone', 'option'); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="header-main">
			<div class="container">
				<div class="header-main-inner">

					<div class="logo">
						<?php the_custom_logo(); ?>
					</div>

					<div class="header-main-right">

						<div class="links-wrapper">
						<?php if( have_rows('social_links', 'option') ): ?>
							<ul class="social-links">
							<?php while( have_rows('social_links', 'option') ): the_row(); 
								$icon = get_sub_field('icon');
								$url = get_sub_field('link');
								?>
								<li class="social-link">
									<a href="<?php echo $url; ?>" target="_blank" rel="nofollow">
										<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" decoding="async" loading="lazy">
									</a>
								</li>
							<?php endwhile; ?>
							</ul>
						<?php endif; ?>

						<?php 
						$link = get_field('header_button', 'option');
						if( $link ) {
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						} ?>
						<?php if( $link ) { ?>
							<a class="button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php } ?>
						</div>

						<?php
						$menuLocation = (is_front_page()) ? 'menu-main-home' : 'menu-main'; ?>

						<div class="menu-wrapper">

							<?php
							wp_nav_menu( array(
								'theme_location' => $menuLocation,
								'menu_id'        => 'primary',
								'container'       => 'nav',
								'container_class' => 'menu',
								'menu_class'      => 'menu__list', 
							) );
							?>

							<?php if( $link ) { ?>
								<a class="button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php } ?>

							<?php if( have_rows('social_links', 'option') ): ?>
								<ul class="social-links">
								<?php while( have_rows('social_links', 'option') ): the_row(); 
									$icon = get_sub_field('icon');
									$url = get_sub_field('url');
									?>
									<li class="social-link">
										<a href="<?php echo $url; ?>" target="_blank" rel="nofollow">
											<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" decoding="async" loading="lazy">
										</a>
									</li>
								<?php endwhile; ?>
								</ul>
							<?php endif; ?>

						</div>

						<button class="menu-btn">
							<span></span>
						</button>
					</div>
								
				</div>
			</div>
		</div>

		<div class="page-overlay"></div>
	</header>

	