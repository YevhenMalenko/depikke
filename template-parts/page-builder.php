<?php

if( have_rows('page_builder') ):

 
    while ( have_rows('page_builder') ) : the_row();

        if( get_row_layout() === 'hero' ): 
            get_template_part('template-parts/sections/hero');	

        elseif( get_row_layout() === 'purpose' ): 
            get_template_part('template-parts/sections/purpose');	

        elseif( get_row_layout() === 'services' ): 
            get_template_part('template-parts/sections/services');

        elseif( get_row_layout() === 'about' ): 
            get_template_part('template-parts/sections/about');

        elseif( get_row_layout() === 'about_us' ): 
            get_template_part('template-parts/sections/about_us');

        elseif( get_row_layout() === 'latest_news' ): 
            get_template_part('template-parts/sections/latest_news');

        elseif( get_row_layout() === 'contact_form' ): 
            get_template_part('template-parts/sections/contact_form');

        elseif( get_row_layout() === 'map' ): 
            get_template_part('template-parts/sections/map');

        elseif( get_row_layout() === 'timer' ): 
            get_template_part('template-parts/sections/timer');
            
        endif;

    endwhile;

// No value.
else :
    // Do something...
endif;

?>