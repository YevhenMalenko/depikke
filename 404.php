<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package de-pikke
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<section class="error-404 not-found">

				<div class="page-content">

					<h1 class="page-title"><?php esc_html_e( '404', 'de-pikke' ); ?></h1>
					<h3 class="page-title"><?php esc_html_e( 'Page not Found', 'de-pikke' ); ?></h3>

					<p><?php esc_html_e( 'Oops. Fail. The page cannot be found.', 'de-pikke' ); ?></p>
					<p><?php esc_html_e( 'Please check your URL..', 'de-pikke' ); ?></p>

				</div>
			</section>
		</div>
	</main>

<?php
get_footer();
