<?php
$background_image = get_sub_field('background_image');
$isParallax = get_sub_field('add_parallax');
$sectionClassName = $isParallax ? 'about about_parallax' : 'about';

?>

<section class="<?php echo $sectionClassName; ?>" style="background-image:url(<?php echo esc_url($background_image['url']); ?>);">
    <div class="container">
        <div class="about-content">
            <?php $logo = get_sub_field('logo');
            if( $logo ): ?>
                <img class="about__logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" decoding="async" loading="lazy">
            <?php endif; ?>

            <?php if (get_sub_field('title')) { ?>
                <h1 class="about__title">
                    <?php the_sub_field('title'); ?>
                </h1>
            <?php } ?>
            <?php if (get_sub_field('text')) { ?>
                <div class="about__text">
                    <?php the_sub_field('text'); ?>
                </div>
            <?php } ?>

            <?php if( have_rows('buttons') ): ?>
                <div class="about__btn-wrapper">
                <?php while( have_rows('buttons') ): the_row(); 
                    $link = get_sub_field('button');
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="button-default wow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" data-wow-delay="0.5s"><?php echo esc_html( $link_title ); ?></a>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php 
        $images = get_sub_field('gallery');
        $count = $images ? count($images) : '';

        if( $images ): ?>
            <div class="about-gallery show-<?php echo $count; ?>">
                <?php foreach( $images as $image ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" decoding="async" loading="lazy">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>