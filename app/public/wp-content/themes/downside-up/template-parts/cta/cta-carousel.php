<?php
/**
 * CTA carousel — cycles through every persona in inc/cta/cta-personas.php.
 *
 * Use ONLY on broad-entry pages (Home, About, Resources, Blog, landing
 * pages). Service pages that already know their audience should call
 * downside_up_cta( 'persona-slug' ) instead for a single static card.
 *
 * Behaviour (autoplay, pause, swipe, keyboard, reduced-motion) lives in
 * assets/js/cta-carousel.js and is driven entirely by the data-du-carousel-*
 * attributes below — no persona-specific JS.
 */

$du_personas = downside_up_get_cta_personas();

if (empty($du_personas)) {
    return;
}

$du_carousel_id = 'du-cta-carousel-' . wp_unique_id();
?>
<section
    class="du-cta-carousel"
    id="<?php echo esc_attr($du_carousel_id); ?>"
    data-du-carousel
    data-interval="9000"
    aria-roledescription="carousel"
    aria-label="<?php esc_attr_e('Find your financial starting point', 'downside-up'); ?>"
>
    <div class="du-cta-carousel__viewport">
        <div class="du-cta-carousel__track" data-du-carousel-track>
            <?php $du_slide_index = 0; ?>
            <?php foreach ($du_personas as $du_key => $du_persona) : ?>
                <?php
                get_template_part('template-parts/cta/cta-card', null, [
                    'persona_key'       => $du_key,
                    'heading_level'     => 'h2',
                    'is_carousel_slide' => true,
                    'is_active'          => 0 === $du_slide_index,
                ]);
                $du_slide_index++;
                ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="du-cta-carousel__controls du-container">
        <button
            type="button"
            class="du-cta-carousel__arrow du-cta-carousel__arrow--prev"
            data-du-carousel-prev
            aria-label="<?php esc_attr_e('Previous', 'downside-up'); ?>"
        >
            <?php echo downside_up_icon('chevron-left'); ?>
        </button>

        <div class="du-cta-carousel__dots" data-du-carousel-dots role="tablist" aria-label="<?php esc_attr_e('Slides', 'downside-up'); ?>">
            <?php $du_i = 0; ?>
            <?php foreach ($du_personas as $du_key => $du_persona) : ?>
                <button
                    type="button"
                    class="du-cta-carousel__dot"
                    role="tab"
                    data-du-carousel-dot
                    data-index="<?php echo esc_attr($du_i); ?>"
                    aria-selected="<?php echo 0 === $du_i ? 'true' : 'false'; ?>"
                    aria-label="<?php echo esc_attr(sprintf(
                        /* translators: %s: persona label, e.g. "Parent" */
                        __('Show CTA for: %s', 'downside-up'),
                        $du_persona['label']
                    )); ?>"
                ></button>
                <?php $du_i++; ?>
            <?php endforeach; ?>
        </div>

        <button
            type="button"
            class="du-cta-carousel__arrow du-cta-carousel__arrow--next"
            data-du-carousel-next
            aria-label="<?php esc_attr_e('Next', 'downside-up'); ?>"
        >
            <?php echo downside_up_icon('chevron-right'); ?>
        </button>
    </div>

    <span class="du-sr-only" data-du-carousel-live aria-live="polite"></span>
</section>
