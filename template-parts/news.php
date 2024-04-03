<div class="news">

    <h2 class="section-title">AL HET NIEUWS</h2>

    <?php
    $postsPerPage = 6;

    $query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => $postsPerPage ,
        'orderby' => 'date',
        'order' => 'DESC',
    ) );

    $maxNumPages = $query->max_num_pages;
    ?>

    <?php
    if ( $query->have_posts() ) { ?>
    <div class="news-list"
            data-pages="<?php echo $maxNumPages; ?>" 
            data-show="<?php echo $postsPerPage; ?>">

    <?php
    while ( $query->have_posts() ) : 

        $query->the_post(); ?>

        <?php get_template_part('template-parts/news-card'); ?>

    <?php endwhile; ?>

    </div>

    <?php if($maxNumPages > 1 ) { ?>
        <div class="button-wrapper">
            <button class="button-green" id="load-more">
                Load More
                <span class="spinner"></span>  
            </button>
        </div>
    <?php } ?>

    <?php } else {
        echo 'No Posts Found';
    }

    wp_reset_postdata(); ?>

</div>