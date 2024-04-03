<?php
/**
 * Template to show blog posts
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package de-pikke
 */

get_header();
?>


<main id="primary" class="site-main">

    <?php	
    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => 1 ,
        'orderby' => 'date',
        'order' => 'DESC',
    ) );

    while ( $query->have_posts() ) :
        $query->the_post();

        get_template_part('template-parts/single-news'); 

    endwhile;

    wp_reset_postdata(); ?>

    <div class="container">

        <?php get_template_part('template-parts/news'); ?>

    </div>
</main> 

<?php
get_footer();