<?php
$images_position = get_sub_field('images_position');
$images_size = get_sub_field('images_size');
$background_color = get_sub_field('background_color');
$add_logo = get_sub_field('add_logo');
$logoClass = $add_logo ? ' show-logo' : '';

?>

<section class="about-us media-<?php echo $images_size; ?> bg-<?php echo $background_color; echo $logoClass; ?>">
    <div class="container">
        <div class="about-us-row media-<?php echo $images_position; ?>">
            <div class="about-us-content">
                <?php if (get_sub_field('title')) { ?>
                    <h2 class="section-title">
                        <?php the_sub_field('title'); ?>
                    </h2>
                <?php } ?>
                <?php if (get_sub_field('content')) { ?>
                    <div class="about-us__text">
                        <?php the_sub_field('content'); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="about-us-images <?php echo $images_size; ?>">
            <?php 
            $images = get_sub_field('images');
            if( $images ): ?>
                <?php foreach( $images as $image ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy">
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>