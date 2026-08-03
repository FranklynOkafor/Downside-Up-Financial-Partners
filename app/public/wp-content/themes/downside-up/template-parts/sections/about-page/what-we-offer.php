<?php

/**
 * Who We Help — about page section.
 *
 * Loaded via: get_template_part( 'template-parts/sections/about-page/what-we-offer' );
 *
 * Self-contained: fetches its own data (inc/about-page/what-we-offer_data.php),
 * so it can be dropped into any template without modification.
 */

$du_what_we_offer = downside_up_get_what_we_offer();
?>

<section class="du-who-we-help" aria-labelledby="du-who-we-help-heading">
    <div class="du-container">

        <div class="du-who-we-help__header">
            <p class="du-who-we-help__eyebrow du-text-label-caps">Who It's For</p>
            <h2 id="du-who-we-help-heading" class="du-who-we-help__heading du-text-headline-xl">
                Who We Help
            </h2>
            <p class="du-who-we-help__description du-text-body-md">
                Every financial journey is unique. We meet you where you are<br>
                and help you move forward with clarity and confidence.
            </p>
        </div>

        <?php if (!empty($du_what_we_offer) && is_array($du_what_we_offer)) : ?>

            <div class="du-who-we-help__grid">
                <?php foreach ($du_what_we_offer as $offer) : ?>
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
                <?php echo downside_up_icon('users', [
                    'width'  => 20,
                    'height' => 20,
                ]); ?>
            </span>
            <p class="du-who-we-help__footer-text du-text-body-md">
                Different stages. Different challenges. One partner committed to your financial clarity.
            </p>
        </div>

    </div>
</section>