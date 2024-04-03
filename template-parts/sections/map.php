<section class="map">
    <div class="container">
        <div class="map-row">
            <div class="map-image">
                <?php $map = get_sub_field('map_image');
                if( $map ): ?>
                    <img src="<?php echo esc_url($map['url']); ?>" alt="<?php echo esc_attr($map['alt']); ?>" loading="lazy">
                <?php endif; ?>
            </div>
            <div class="map-contacts">
                <?php 
                if (get_sub_field('contacts')) {
                    the_sub_field('contacts');
                } ?>
            </div>
        </div>
    </div>
</section>