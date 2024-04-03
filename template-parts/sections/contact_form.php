<?php
$sectionId = get_sub_field('section_id');
$logo = get_sub_field('logo');
$form = get_sub_field('contact_form');
$formId = $form->ID;
$showEmails = get_sub_field('add_emails_list');
$formWrapperClass = $showEmails ? 'contact-form-wrapper show-emails' : 'contact-form-wrapper';
?>

<section class="contact-form" <?php if ($sectionId) echo 'id="'. $sectionId . '"'; ?>>
    <div class="container">
        <?php if( $logo ): ?>
            <div class="contact-form__logo">
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
            </div>
        <?php endif; ?>
        
        <?php if (get_sub_field('text')) { ?>
            <div class="contact-form__text">
                <?php the_sub_field('text'); ?>
            </div>
        <?php } ?>

        <div class="<?php echo $formWrapperClass; ?>">
            <div class="form-col">
                <?php echo do_shortcode( '[contact-form-7 id="'.$formId.'"]' ); ?>
            </div>
            <?php if( have_rows('emails_list') ): ?>
                <div class="emails-col">
                    <ul class="emails-list">
                    <?php while( have_rows('emails_list') ): the_row(); 
                    $email = get_sub_field('email');
                    $add_indent = get_sub_field('add_indent');
                    $itemClassName = $add_indent ? 'email has-indent' : 'email';
                    ?>
                        <li class="<?php echo $itemClassName; ?>">
                            <div class="email__title"><?php the_sub_field('title'); ?></div>
                            <a class="email__link" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            
        </div>
    </div>
</section>