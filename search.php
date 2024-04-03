<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package de-pikke
 */

get_header();
?>

	<main id="primary" class="site-main search-page">
		<div class="container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					printf( esc_html__( 'Search Results for: %s', 'de-pikke' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header>

			<?php

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation(
				array(
					'prev_text' => '<span class="nav-title"></span>',
					'next_text' => '<span class="nav-title"></span>',
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		
		</div>
	</main>

<?php

get_footer();
