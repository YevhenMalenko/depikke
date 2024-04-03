<div class="single-news">
    <div class="container">
        <div class="single-news-header">
            <h2 class="section-title"><?php the_title(); ?></h2>
            <?php $single_header_image = get_field('single_header_image');
            if( $single_header_image ): ?>
                <img class="single-news-header__image" src="<?php echo esc_url($single_header_image['url']); ?>" alt="<?php echo esc_attr($single_header_image['alt']); ?>" loading="lazy">
            <?php endif; ?>

        </div>
        
        <?php if (get_the_content()) { ?>
            
            <div class="content">
                <?php the_content(); ?>
            </div>
            
        <?php } ?>

        <?php if( have_rows('follow_social_links', 'option') ): ?>
            <div class="follow-section">
                <?php if (get_field('follow_title', 'option')) { ?>
                    <h4 class="follow-section__title"><?php the_field('follow_title', 'option'); ?></h4>
                <?php } ?>
                <ul class="social-links">
                <?php while( have_rows('follow_social_links', 'option') ): the_row(); 
                    $icon = get_sub_field('icon');
                    $url = get_sub_field('link');
                    ?>
                    <li class="social-link">
                        <a href="<?php echo $url; ?>" target="_blank" rel="nofollow">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" decoding="async" loading="lazy">
                        </a>
                    </li>
                <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
        
    </div>
</div>