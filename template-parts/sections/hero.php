<?php
$type = get_sub_field('type');
?>

<section class="hero hero-<?php echo $type; ?>" >
    
    <?php 
    if ($type === 'large') { 
        $bg_image = get_sub_field('background_image');
        $images = get_sub_field('images');
        
    ?>
        <div class="container">
            <div class="hero-wrapper">
                <div class="hero__content">
                    <div class="hero__text">
                        <?php the_sub_field('text'); ?>
                    </div>

                    <?php if( have_rows('buttons') ): ?>
                        <div class="hero__btn-wrapper">
                        <?php while( have_rows('buttons') ): the_row(); 
                            $link = get_sub_field('button');
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button-default" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="hero-left" style="background-image:url(<?php echo esc_url($bg_image['url']); ?>);"></div>

                <?php 
                if( $images ): ?>
                    <div class="hero-gallery">
                        <div class="hero-gallery-images">
                            <?php foreach( $images as $image ): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" decoding="async" loading="lazy">
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    <?php } else {

        $image = get_sub_field('image');
        if( $image ): ?>
            <div class="hero__background" style="background-image:url(<?php echo esc_url($image['url']); ?>);" ></div>
        <?php endif; ?>

    <?php } ?>


</section>
