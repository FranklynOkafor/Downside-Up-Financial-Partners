<?php
/**
 * Why Choose DownSide Up.
 * Loaded via: get_template_part('template-parts/sections/services/why-choose');
 *
 * Reuses the Core Principles card component wholesale — same
 * .du-principles / .du-principle-card classes and reveal behaviour
 * (assets/js/about-page/principles-grid.js, already enqueued site-wide)
 * as template-parts/sections/about-page/principles-grid.php, extended
 * from three cards to four. The .du-principles--services class adds a
 * four-column desktop grid in assets/css/_services.css; nothing in
 * about-page/_principles-grid.css is touched.
 */

$du_why_choose = downside_up_get_services_why_choose_data();
?>
<section class="du-principles du-principles--services" aria-labelledby="du-services-why-choose-heading">
    <div class="du-container">

        <div class="du-principles__header">
            <h2 id="du-services-why-choose-heading" class="du-principles__heading du-text-headline-xl">
                <?php echo esc_html($du_why_choose['heading']); ?>
            </h2>
            <p class="du-principles__description du-text-body-md">
                <?php echo esc_html($du_why_choose['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_why_choose['items']) && is_array($du_why_choose['items'])) : ?>
            <div class="du-principles__grid">
                <?php foreach ($du_why_choose['items'] as $du_item) : ?>
                    <article class="du-principle-card">
                        <span class="du-principle-card__icon">
                            <?php echo downside_up_icon($du_item['icon'], [
                                'width'  => 22,
                                'height' => 22,
                            ]); ?>
                        </span>

                        <h3 class="du-principle-card__title du-text-headline-lg">
                            <?php echo esc_html($du_item['title']); ?>
                        </h3>

                        <p class="du-principle-card__description du-text-body-md">
                            <?php echo esc_html($du_item['description']); ?>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
