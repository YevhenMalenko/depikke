<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package de-pikke
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			if (get_the_content()) { ?>
				<div class="container">
					<div class="content">
						<?php the_content(); ?>
					</div>
				</div>
			<?php } ?>

			<?php get_template_part( 'template-parts/page-builder' );


		endwhile;
		?>

	</main>

<?php

get_footer();