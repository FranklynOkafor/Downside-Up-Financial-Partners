<?php
/**
 * Testimonials section.
 * Loaded via: get_template_part( 'template-parts/sections/testimonials' );
 *
 * Two-column layout per the supplied design:
 *   Left  — testimonial carousel (quote, attribution, prev/next nav)
 *   Right — one static supporting image (assets/images/testimonial-image-right.jpg),
 *           independent of which testimonial is active
 *
 * Self-contained: fetches its own data (inc/testimonials.php) and renders
 * everything needed. front-page.php should only reference this file.
 */

$du_testimonials = downside_up_get_testimonials();

if (empty($du_testimonials)) {
    return;
}

$du_total = count($du_testimonials);

$du_image_url = get_template_directory_uri() . '/assets/images/testimonial-image-right.jpg';

/**
 * TODO: replace with the file's real intrinsic dimensions once confirmed —
 * same placeholder-dimensions caveat as the hero image (see hero-home.php).
 */
$du_image_width  = 900;
$du_image_height = 1100;
?>
<section class="du-testimonials" aria-labelledby="du-testimonials-heading">
    <h2 id="du-testimonials-heading" class="du-sr-only">
        <?php esc_html_e('What Our Clients Say', 'downside-up'); ?>
    </h2>

    <div class="du-testimonials__inner du-container">

        <div
            class="du-testimonials__carousel"
            data-du-carousel
            aria-roledescription="carousel"
            aria-label="<?php esc_attr_e('Client testimonials', 'downside-up'); ?>"
        >
            <span class="du-testimonials__quote-mark" aria-hidden="true">&#8220;</span>

            <div class="du-testimonials__track" data-du-carousel-track>
                <?php foreach ($du_testimonials as $du_index => $du_testimonial) : ?>
                    <?php
                    $du_avatar_url = downside_up_testimonial_avatar_url($du_testimonial['avatar']);
                    $du_title      = trim($du_testimonial['role'] . ', ' . $du_testimonial['company'], ', ');
                    ?>
                    <div
                        class="du-testimonials__slide"
                        data-du-slide
                        role="group"
                        aria-roledescription="slide"
                        aria-label="<?php echo esc_attr(sprintf(
                            /* translators: 1: position, 2: total count, 3: client name */
                            __('Testimonial %1$d of %2$d, %3$s', 'downside-up'),
                            $du_index + 1,
                            $du_total,
                            $du_testimonial['name']
                        )); ?>"
                    >
                        <blockquote class="du-testimonials__quote">
                            <p class="du-text-quote">&#8220;<?php echo esc_html($du_testimonial['quote']); ?>&#8221;</p>
                        </blockquote>

                        <footer class="du-testimonials__attribution">
                            <?php if ($du_avatar_url) : ?>
                                <img
                                    src="<?php echo esc_url($du_avatar_url); ?>"
                                    alt=""
                                    class="du-testimonials__avatar"
                                    width="48"
                                    height="48"
                                    loading="lazy"
                                    decoding="async"
                                >
                            <?php else : ?>
                                <span class="du-testimonials__avatar du-testimonials__avatar--placeholder" aria-hidden="true"></span>
                            <?php endif; ?>

                            <div class="du-testimonials__person">
                                <p class="du-testimonials__name"><?php echo esc_html($du_testimonial['name']); ?></p>
                                <p class="du-testimonials__role du-text-label-caps"><?php echo esc_html($du_title); ?></p>
                            </div>
                        </footer>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($du_total > 1) : ?>
            <div class="du-testimonials__controls">
                <button
                    type="button"
                    class="du-testimonials__arrow du-testimonials__arrow--prev"
                    data-du-carousel-prev
                    aria-label="<?php esc_attr_e('Previous testimonial', 'downside-up'); ?>"
                >
                    <?php echo downside_up_icon('chevron-left'); ?>
                </button>
                <button
                    type="button"
                    class="du-testimonials__arrow du-testimonials__arrow--next"
                    data-du-carousel-next
                    aria-label="<?php esc_attr_e('Next testimonial', 'downside-up'); ?>"
                >
                    <?php echo downside_up_icon('chevron-right'); ?>
                </button>
            </div>
            <?php endif; ?>

            <span class="du-sr-only" data-du-carousel-live aria-live="polite"></span>
        </div>

        <div class="du-testimonials__media">
            <img
                src="<?php echo esc_url($du_image_url); ?>"
                alt="<?php esc_attr_e('A DownSide Up client reviewing their financial plan at a sunlit desk.', 'downside-up'); ?>"
                class="du-testimonials__image"
                width="<?php echo esc_attr($du_image_width); ?>"
                height="<?php echo esc_attr($du_image_height); ?>"
                loading="lazy"
                decoding="async"
            >
        </div>

    </div>
</section>
