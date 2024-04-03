<?php 
$sectionId = get_sub_field('section_id');
$image = get_sub_field('image');
?>


<section class="services" <?php if ($sectionId) echo 'id="'. $sectionId . '"'; ?>>
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
            'post_type' => 'service',
            'posts_per_page' => -1,
            ) 
        ); 

        if ( $the_query->have_posts() ) : ?>

            <div class="services-list">

                <?php
                while ( $the_query->have_posts() ) : 

                    $the_query->the_post(); 

                    $thumbnail = get_field('service_image');
                    $description = get_field('service_short_description');
                    $contactLink = get_field('service_contact_link');
                    ?>

                    <div class="service-card wow" data-wow-delay="0.5s">
                        <a class="service-card-thumbnail" href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php echo esc_attr($thumbnail['alt']); ?>" decoding="async" loading="lazy">
                        </a>
                        <div class="service-card-content">
                            <h4 class="service-card__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <p class="service-card__description">
                                <?php echo $description; ?>
                            </p>
                            <?php
                            if( $contactLink ) {
                                $link_url = $contactLink['url'];
                                $link_title = $contactLink['title'];
                                $link_target = $contactLink['target'] ? $contactLink['target'] : '_self';
                                ?>
                                <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						    <?php } ?>
                        </div>
                    </div>
                                    
                <?php endwhile; ?>
                <?php if( $image ): ?>
						<img class="service-image wow" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" decoding="async" loading="lazy" data-wow-delay="0.5s">
					<?php endif; ?>
            </div>

        <?php endif; 
        wp_reset_postdata(); ?>
    </div>
</section>