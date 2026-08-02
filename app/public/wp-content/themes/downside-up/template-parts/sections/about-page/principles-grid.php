<?php

/**
 * Core Principles Grid — reusable component.
 * Loaded via: get_template_part( 'template-parts/sections/about-us/principles-grid' );
 *
 * Sits directly after Mission & Vision. Centered heading + supporting copy,
 * then three equal-height cards (icon circle, title, description) — no
 * links, no stats, no CTA. Simpler sibling of .du-help-card: same tokens
 * and hover language, without the bento/featured-card behaviour that
 * component doesn't need here.
 *
 * Self-contained: fetches its own data (inc/about-us/core-principles.php),
 * so it can be dropped into any template without modification.
 */

$du_principles = downside_up_get_core_principles_data();
?>
<section class="du-principles" aria-labelledby="du-principles-heading">
    <div class="du-container">

        <div class="du-principles__header">
            <h2 id="du-principles-heading" class="du-principles__heading du-text-headline-xl">
                <?php echo esc_html($du_principles['heading']); ?>
            </h2>
            <p class="du-principles__description du-text-body-md">
                <?php echo esc_html($du_principles['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_principles['principles']) && is_array($du_principles['principles'])) : ?>
            <div class="du-principles__grid">
                <?php foreach ($du_principles['principles'] as $du_principle) : ?>
                    <article class="du-principle-card">
                        <span class="du-principle-card__icon">
                            <?php echo downside_up_icon($du_principle['icon'], [
                                'width'  => 22,
                                'height' => 22,
                            ]); ?>
                        </span>

                        <h3 class="du-principle-card__title du-text-headline-lg">
                            <?php echo esc_html($du_principle['title']); ?>
                        </h3>

                        <p class="du-principle-card__description du-text-body-md">
                            <?php echo esc_html($du_principle['description']); ?>
                        </p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
