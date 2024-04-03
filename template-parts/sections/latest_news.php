<section class="latest-news">
    <div class="container">
        <?php if (get_sub_field('title')) { ?>
            <h2 class="section-title wow">
                <?php the_sub_field('title'); ?>
            </h2>
        <?php } ?>
        <?php if (get_sub_field('text')) { ?>
            <div class="text wow" data-wow-delay="0.5s">
                <?php the_sub_field('text'); ?>
            </div>
        <?php } ?>

        <?php  
        $the_query = new WP_Query( 
            array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
            ) 
        );?>

        <?php
        if ( $the_query->have_posts() ) : ?>

        <div class="news-list latest-news-list">

            <?php
            while ( $the_query->have_posts() ) : 

                $the_query->the_post(); 
                $thumbnail = get_the_post_thumbnail_url();
                $thumbnail = $thumbnail ? $thumbnail : get_template_directory_uri() . '/assets/images/post-default.jpg';
                $excerpt = get_the_excerpt() ? get_the_excerpt() : get_the_content();
                $excerpt = wp_trim_words( $excerpt, 30, '...' );
                ?>
                <div class="news-card">
                    <a class="news-card-thumbnail" href="#">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" decoding="async" loading="lazy">
                    </a>
                    <div class="news-card-content">
                        <h4 class="news-card__title">
                            <a href="#">
                                <?php echo wp_trim_words( get_the_title(), 10, '...' ); ?>
                            </a>
                        </h4>
                        <p class="news-card__description">
                            <?php echo $excerpt; ?>
                        </p>
                        <a class="link" href="#"><?php echo 'Lees meer'; ?></a>
                    </div>
                    <div class="pop-up">
                        <div class="pop-up-container">
                            <div class="pop-up-content">
                                <div class="pop-up-header">
                                    <button class="pop-up-close"></button>
                                </div>
                                
                                <div class="pop-up-logo">
                                    <img src="<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ); ?>" loading="lazy">
                                </div>

                                <?php 
                                $show_custom_content = get_field('show_custom_content');

                                if ($show_custom_content) {
                                    $popup_image = get_field('popup_image');
                                    if( $popup_image ): ?>
                                        <img class="pop-up-image" src="<?php echo esc_url($popup_image['url']); ?>" alt="<?php echo esc_attr($popup_image['alt']); ?>" loading="lazy">
                                    <?php endif; ?>
                                    <?php if( get_field('popup_title') ): ?>
                                        <h3 class="pop-up-title"><?php the_field('popup_title'); ?></h3>
                                    <?php endif; ?>
                                    <?php if( get_field('popup_content') ): ?>
                                        <div class="content">
                                            <?php the_field('popup_content'); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php } else {
                                    $single_header_image = get_field('single_header_image');
                                    if( $single_header_image ): ?>
                                        <img class="pop-up-image" src="<?php echo esc_url($single_header_image['url']); ?>" alt="<?php echo esc_attr($single_header_image['alt']); ?>" loading="lazy">
                                    <?php endif; ?>
                                    <h3 class="pop-up-title"><?php the_title(); ?></h3>
                                    <div class="content">
                                        <?php the_content(); ?>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
                                
            <?php endwhile; ?>
        </div>

        <?php endif; 
        wp_reset_postdata(); ?>

        <?php $button = get_sub_field('button');
        if( $button ) {
            $link_url = $button['url'];
            $link_title = $button['title'];
            $link_target = $button['target'] ? $button['target'] : '_self'; ?>
            <div class="button-wrapper">
                <a class="button-green" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            </div>
        <?php } ?>
    </div>
</section>