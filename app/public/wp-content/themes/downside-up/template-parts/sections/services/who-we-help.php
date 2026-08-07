<?php
/**
 * Who We Help.
 * Loaded via: get_template_part('template-parts/sections/services/who-we-help');
 *
 * Reuses the About page's audience/persona card component wholesale —
 * same .du-who-we-help / .du-who-we-help-card classes and reveal
 * behaviour (assets/js/about-page/what-we-offer.js, already enqueued
 * site-wide) as template-parts/sections/about-page/what-we-offer.php.
 * Data extends downside_up_get_what_we_offer() with a seventh persona
 * (Retirees) via downside_up_get_services_who_we_help_data() — see
 * inc/services/services-data.php — without changing the shared About
 * page data function. No new CSS.
 */

$du_who_we_help = downside_up_get_services_who_we_help_data();
?>
<section class="du-who-we-help" aria-labelledby="du-services-who-we-help-heading">
    <div class="du-container">

        <div class="du-who-we-help__header">
            <p class="du-who-we-help__eyebrow du-text-label-caps"><?php echo esc_html($du_who_we_help['eyebrow']); ?></p>
            <h2 id="du-services-who-we-help-heading" class="du-who-we-help__heading du-text-headline-xl">
                <?php echo esc_html($du_who_we_help['heading']); ?>
            </h2>
            <p class="du-who-we-help__description du-text-body-md">
                <?php echo esc_html($du_who_we_help['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_who_we_help['items']) && is_array($du_who_we_help['items'])) : ?>

            <div class="du-who-we-help__grid">
                <?php foreach ($du_who_we_help['items'] as $offer) : ?>
                    <article class="du-who-we-help-card">

                        <div class="du-who-we-help-card__top-rule"></div>

                        <div class="du-who-we-help-card__identity">
                            <span class="du-who-we-help-card__icon-chip">
                                <?php echo downside_up_icon($offer['icon'], [
                                    'width'  => 20,
                                    'height' => 20,
                                ]); ?>
                            </span>
                            <span class="du-who-we-help-card__label du-text-label-caps">
                                <?php echo esc_html($offer['label']); ?>
                            </span>
                        </div>

                        <h3 class="du-who-we-help-card__title du-text-headline-lg">
                            <?php echo esc_html($offer['title']); ?>
                        </h3>

                        <p class="du-who-we-help-card__intro du-text-body-md">
                            <?php echo esc_html($offer['intro']); ?>
                        </p>

                        <div class="du-who-we-help-card__focus">
                            <div class="du-who-we-help-card__focus-header">
                                <?php echo downside_up_icon('circle-check', [
                                    'width'  => 16,
                                    'height' => 16,
                                ]); ?>
                                <span class="du-who-we-help-card__focus-label du-text-label-caps">
                                    <?php echo esc_html($offer['focus_label']); ?>
                                </span>
                            </div>
                            <p class="du-who-we-help-card__focus-text du-text-body-md">
                                <?php echo esc_html($offer['focus']); ?>
                            </p>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

        <div class="du-who-we-help__footer">
            <span class="du-who-we-help__footer-icon">
                <?php echo downside_up_icon($du_who_we_help['footer_icon'], [
                    'width'  => 20,
                    'height' => 20,
                ]); ?>
            </span>
            <p class="du-who-we-help__footer-text du-text-body-md">
                <?php echo esc_html($du_who_we_help['footer_text']); ?>
            </p>
        </div>

    </div>
</section>
