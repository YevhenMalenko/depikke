<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package de-pikke
 */

?>

	<section class="logos">
		<div class="container">
			<div class="logos-wrapper">
				<?php 
				$main_logo = get_field('footer_main_logo', 'option');
				$main_logo_link = get_field('footer_main_logo_link', 'option');
				if( $main_logo ): ?>
					<div class="main-logo">
						<?php if( $main_logo_link ) { ?>
							<a href="<?php echo $main_logo_link ?>" target="_blank" rel="nofollow">
						<?php } ?>
							<img src="<?php echo esc_url($main_logo['url']); ?>" alt="<?php echo esc_attr($main_logo['alt']); ?>" loading="lazy" decoding="async">
						<?php if( $main_logo_link ) { ?>
							</a>
						<?php } ?>
					</div>
				<?php endif; ?>

				<?php if( have_rows('footer_logotypes', 'option') ): ?>
					<div class="logos-list">
					<?php while( have_rows('footer_logotypes', 'option') ): the_row(); 
						$logo = get_sub_field('logo');
						$link = get_sub_field('link'); 
						?>
						<a class="logo" href="<?php echo $link; ?>" target="_blank" rel="nofollow" >
							<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" loading="lazy" decoding="async">
						</a>

					<?php endwhile; ?>
					</div>
				<?php endif; ?>

			</div>

		</div>
	</section>

	<footer class="footer">

		<div class="footer-main">
			<div class="container">
				<div class="footer-main-inner">
					<div class="footer-content">
						<div class="footer-logo">
							<?php the_custom_logo(); ?>
						</div>
						<div class="footer-contacts">
							<?php the_field('footer_text', 'option'); ?>
						</div>
					</div>
					<div class="footer-image">
						<?php
						$image = get_field('footer_image', 'option');
						if( $image ): ?>
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" decoding="async" loading="lazy">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-inner">
					<div class="footer-bottom-logo">
					<?php 
					$logoBottom = get_field('footer_bottom_logo', 'option');
					if( $logoBottom ): ?>
						<img src="<?php echo esc_url($logoBottom['url']); ?>" alt="<?php echo esc_attr($logoBottom['alt']); ?>" />
					<?php endif; ?>
					</div>

					<div class="footer-bottom-content">
						<div class="copyright">
							<?php the_field('copyright_text', 'option'); ?>
						</div>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-footer',
							'menu_id'        => 'footer-menu',
							'container'       => 'nav',
							'container_class' => 'footer-menu',
							'menu_class'      => 'footer-menu__list', 
						) );
						?>
					</div>

				</div>
			</div>
		</div>

	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
