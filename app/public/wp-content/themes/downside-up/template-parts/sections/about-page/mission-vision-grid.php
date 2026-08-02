<?php

/**
 * Mission & Vision Grid — reusable component.
 * Loaded via: get_template_part( 'template-parts/sections/about-page/mission-vision-grid' );
 *
 * Sits directly after the Story section. Two equal cards — Vision (light,
 * outlined, subtle) and Mission (dark, primary emphasis) — belonging to the
 * same card family, differing only in emphasis. No buttons, no stats, no
 * illustrations: just icon, heading, and supporting copy per card.
 *
 * Self-contained: fetches its own data (inc/about-us/mission-vision.php),
 * so it can be dropped into any template without modification.
 */

$du_mv = downside_up_get_mission_vision_data();
?>
<section class="du-mv" aria-labelledby="du-mv-heading">
    <div class="du-container">

        <h2 id="du-mv-heading" class="du-sr-only">
            <?php echo esc_html($du_mv['heading']); ?>
        </h2>

        <div class="du-mv__grid">

            <article class="du-mv-card du-mv-card--vision">
                <span class="du-mv-card__icon">
                    <?php echo downside_up_icon($du_mv['cards']['vision']['icon'], [
                        'width'  => 24,
                        'height' => 24,
                    ]); ?>
                </span>

                <h3 class="du-mv-card__heading du-text-headline-xl">
                    <?php echo esc_html($du_mv['cards']['vision']['heading']); ?>
                </h3>

                <p class="du-mv-card__copy du-text-body-md">
                    <?php echo esc_html($du_mv['cards']['vision']['copy']); ?>
                </p>
            </article>

            <article class="du-mv-card du-mv-card--mission">
                <span class="du-mv-card__icon">
                    <?php echo downside_up_icon($du_mv['cards']['mission']['icon'], [
                        'width'  => 24,
                        'height' => 24,
                    ]); ?>
                </span>

                <h3 class="du-mv-card__heading du-text-headline-xl">
                    <?php echo esc_html($du_mv['cards']['mission']['heading']); ?>
                </h3>

                <p class="du-mv-card__copy du-text-body-md">
                    <?php echo esc_html($du_mv['cards']['mission']['copy']); ?>
                </p>
            </article>

        </div>

    </div>
</section>
