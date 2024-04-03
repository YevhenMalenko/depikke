<?php
/**
 * The template for displaying all single services
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package de-pikke
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="container">

		<?php
		while ( have_posts() ) :
			the_post(); ?>

            <?php if (get_the_content()) { ?>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            <?php } ?>

		<?php endwhile; ?>
        
        </div>
	</main>

<?php

get_footer();