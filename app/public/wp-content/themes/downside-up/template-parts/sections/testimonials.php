<?php
$downside_up_testimonials = [
    [
        'quote' => __("\"The level of precision Downside Up brought to my estate planning was transformative. I finally feel my capital is truly protected and working with a clarity I hadn't experienced before.\"", 'downside-up'),
        'name'  => 'Julian Vance',
        'role'  => __('CEO, Altura Ventures', 'downside-up'),
    ],
    [
        'quote' => __("\"From our first conversation, it was clear this team operates on a different level. Our portfolio restructuring paid for itself within a single quarter.\"", 'downside-up'),
        'name'  => 'Elena Marsh',
        'role'  => __('Founder, Marsh & Co.', 'downside-up'),
    ],
];
?>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <h2><?php esc_html_e('Voices of Partnership', 'downside-up'); ?></h2>
        </div>

        <div class="testimonials__card-wrap" data-testimonial-carousel>
            <?php foreach ($downside_up_testimonials as $index => $testimonial) : ?>
                <div class="testimonial-card" data-testimonial-slide<?php echo $index === 0 ? '' : ' hidden'; ?>>
                    <p class="testimonial-card__quote"><?php echo esc_html($testimonial['quote']); ?></p>
                    <p class="testimonial-card__name"><?php echo esc_html($testimonial['name']); ?></p>
                    <p class="testimonial-card__role"><?php echo esc_html($testimonial['role']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="testimonials__controls">
            <button type="button" class="carousel-control" data-testimonial-prev aria-label="<?php esc_attr_e('Previous testimonial', 'downside-up'); ?>">
                <?php downside_up_icon('chevron-left'); ?>
            </button>
            <button type="button" class="carousel-control" data-testimonial-next aria-label="<?php esc_attr_e('Next testimonial', 'downside-up'); ?>">
                <?php downside_up_icon('chevron-right'); ?>
            </button>
        </div>
    </div>
</section>
