<?php 
$set_timer = get_sub_field('set_timer');
$endDate = get_sub_field('final_date');
$total_days = get_sub_field('total_days');
$dataAtributes = '';
if ($set_timer) {
    $dataAtributes = 'data-end="'. $endDate. '" data-days="'. $total_days. '"';
} 

$countdownClass = $set_timer ? 'countdown countdown_active' : 'countdown';
?>

<section class="timer">
    <div class="container">
        <div class="<?php echo $countdownClass; ?>" <?php echo $dataAtributes; ?> >
            <div class="countdown__block" id="days">
                <?php get_template_part('template-parts/circle'); ?>
                <span>00</span>
                <div class="countdown__caption">DAGEN</div>
            </div>
            <div class="countdown__block" id="hours">
                <?php get_template_part('template-parts/circle'); ?>
                <span>00</span>
                <div class="countdown__caption">UREN</div>
                
            </div>
            <div class="countdown__block" id="minutes">
                <?php get_template_part('template-parts/circle'); ?>
                <span>00</span>
                <div class="countdown__caption">MINUTEN</div>
                
            </div>
            <div class="countdown__block" id="seconds">
                <?php get_template_part('template-parts/circle'); ?>
                <span>00</span>
                <div class="countdown__caption">SECONDEN</div>
            </div>
        </div>

        <?php if (get_sub_field('text')) { ?>
            <div class="timer__text">
                <?php the_sub_field('text'); ?>
            </div>
        <?php } ?>
        
        <div class="text-center">
            <button class="scroll-next"></button>
        </div>

    </div>
</section>