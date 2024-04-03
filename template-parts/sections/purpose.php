<?php 
$default_link = get_sub_field('default_link');
$default_link_url = $default_link ? $default_link['url'] : '';
$default_link_target = $default_link['target'] ? $default_link['target'] : '_self';

$offerte_title = get_sub_field('offerte_title');
$offerte_text = get_sub_field('offerte_text');
$offerte_link = get_sub_field('offerte_link');
?>

<section class="purpose">
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
            'post_type' => 'purpose',
            'posts_per_page' => -1,
            ) 
        ); 

        if ( $the_query->have_posts() ) : ?>

            <div class="purpose-list">

                <?php
                while ( $the_query->have_posts() ) : 

                    $the_query->the_post(); 

                    $icon = get_field('icon');
                    $shopLink = get_field('shop_link');
                    $link = $shopLink ? $shopLink : $default_link_url;
                    $link_target = $shopLink ? '_blank' : $default_link_target;

                    ?>

                    <div class="purpose-item">
                        <div class="purpose-item__icon">
                            <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" decoding="async" loading="lazy">
                            </a>
                        </div>
                        <h4 class="purpose-item__title">
                            <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    </div>
                                    
                <?php endwhile; ?>
                <?php if ($offerte_title) { ?>
                    <div class="offerte-message wow" data-wow-delay="0.5s">
                        <div class="offerte-message-icon">
                            <span>?</span>
                        </div>
                        <div class="offerte-message-content">
                            <h3 class="offerte-message__title"><?php echo $offerte_title; ?></h3>
                            <p class="offerte-message__text"><?php echo $offerte_text; ?></p>
                            <?php if( $offerte_link ) {
                                $link_url = $offerte_link['url'];
                                $link_title = $offerte_link['title'];
                                $link_target = $offerte_link['target'] ? $offerte_link['target'] : '_self'; ?>

                                <a class="button-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>


        <?php endif; 
        wp_reset_postdata(); ?>

    </div>
</section>