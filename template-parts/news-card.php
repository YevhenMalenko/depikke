<?php 

$thumbnail = get_the_post_thumbnail_url();
$thumbnail = $thumbnail ? $thumbnail : get_template_directory_uri() . '/assets/images/post-default.jpg';
$excerpt = get_the_excerpt() ? get_the_excerpt() : get_the_content();
$excerpt = wp_trim_words( $excerpt, 30, '...' );

?>

<div class="news-card">
    <a class="news-card-thumbnail" href="<?php the_permalink(); ?>">
        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" decoding="async" loading="lazy">
    </a>
    <div class="news-card-content">
        <h4 class="news-card__title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h4>
        <p class="news-card__description">
            <?php echo $excerpt; ?>
        </p>
        <a class="link" href="<?php the_permalink(); ?>"><?php echo 'Lees meer'; ?></a>
    </div>
</div>