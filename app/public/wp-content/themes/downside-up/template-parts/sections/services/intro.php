<?php
/**
 * Services page introduction.
 * Loaded via: get_template_part('template-parts/sections/services/intro');
 *
 * Reuses the Three Pillars of Discovery component wholesale — same
 * .du-pillars / .du-pillar-card classes and reveal animation (driven by
 * assets/js/how-it-works.js, already enqueued site-wide) as
 * template-parts/sections/how-it-works/three-pillars.php. Only the
 * eyebrow line above the heading is new markup, using the same inline
 * eyebrow treatment already used in
 * template-parts/sections/how-it-works/comparison.php. No new CSS.
 */

$du_intro = downside_up_get_services_intro_data();
?>
<section class="du-pillars" aria-labelledby="du-services-intro-heading">
    <div class="du-container">

        <div class="du-pillars__header">
            <?php if (!empty($du_intro['eyebrow'])) : ?>
                <p class="du-text-label-caps" style="color: var(--surface-tint); margin-bottom: var(--space-xs);">
                    <?php echo esc_html($du_intro['eyebrow']); ?>
                </p>
            <?php endif; ?>

            <h2 id="du-services-intro-heading" class="du-pillars__heading du-text-headline-xl">
                <?php echo esc_html($du_intro['heading']); ?>
            </h2>
            <p class="du-pillars__description du-text-body-md">
                <?php echo esc_html($du_intro['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_intro['highlights']) && is_array($du_intro['highlights'])) : ?>
            <div class="du-pillars__grid">
                <?php foreach ($du_intro['highlights'] as $du_highlight) : ?>
                    <div class="du-pillar-card">
                        <span class="du-pillar-card__icon">
                            <?php echo downside_up_icon($du_highlight['icon'], [
                                'width'  => 22,
                                'height' => 22,
                            ]); ?>
                        </span>

                        <h3 class="du-pillar-card__title du-text-headline-lg">
                            <?php echo esc_html($du_highlight['title']); ?>
                        </h3>

                        <p class="du-pillar-card__description du-text-body-md">
                            <?php echo esc_html($du_highlight['description']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
