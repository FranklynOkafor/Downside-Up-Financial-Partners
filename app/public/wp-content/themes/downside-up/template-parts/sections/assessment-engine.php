<?php

/**
 * Assessment Engine section.
 * Loaded via: get_template_part( 'template-parts/sections/assessment-engine' );
 *
 * Two-column layout: left = pitch (heading, description, checklist, CTA),
 * right = 2x2 card grid (3 gauge metric cards + 1 "Reality Check™" card).
 *
 * Self-contained: fetches its own data (inc/assessment-engine.php) and
 * renders everything needed. front-page.php should only reference this file.
 *
 * Gauges are plain semi-circular SVG arcs using stroke-dasharray/offset —
 * no chart library. The dashoffset below is pre-computed here so the arc
 * already shows its correct final value with JS disabled (progressive
 * enhancement); assets/js/assessment-engine.js animates from 0 on scroll
 * into view when JS is available.
 */

$du_data = downside_up_get_assessment_engine_data();

// Fixed radius shared by every gauge in this section — keep in sync with
// the `r` values in the SVG paths below if that ever changes.
$du_gauge_radius        = 80;
$du_gauge_circumference = M_PI * $du_gauge_radius;
?>
<section class="du-assessment" aria-labelledby="du-assessment-heading">
    <div class="du-assessment__inner du-container">

        <div class="du-assessment__content">
            <span class="du-assessment__eyebrow-line" aria-hidden="true"></span>

            <h2 id="du-assessment-heading" class="du-assessment__heading du-text-headline-xl">
                <?php echo esc_html($du_data['heading_line1']); ?><br>
                <?php echo esc_html($du_data['heading_line2']); ?>
            </h2>

            <p class="du-assessment__description du-text-body-md">
                <?php echo esc_html($du_data['description']); ?>
            </p>

            <?php if (!empty($du_data['checklist']) && is_array($du_data['checklist'])) : ?>
                <ul class="du-assessment__checklist">
                    <?php foreach ($du_data['checklist'] as $du_check_item) : ?>
                        <li class="du-assessment__checklist-item">
                            <span class="du-assessment__checklist-icon">
                                <?php echo downside_up_icon('check', ['width' => 20, 'height' => 20]); ?>
                            </span>
                            <span><?php echo esc_html($du_check_item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <a href="<?php echo esc_url($du_data['cta_url']); ?>" class="du-btn du-btn--primary du-assessment__cta">
                <?php echo esc_html($du_data['cta_text']); ?>
                <span class="du-assessment__cta-icon">
                    <?php echo downside_up_icon('arrow-right', ['width' => 18, 'height' => 18]); ?>
                </span>
            </a>
        </div>

        <div class="du-assessment__cards">

            <?php foreach ($du_data['metrics'] as $du_metric) :
                $du_percent = max(0, min(100, (float) $du_metric['value']));
                $du_offset  = $du_gauge_circumference * (1 - $du_percent / 100);
                $du_status  = $du_metric['status'];
                $du_status_label = downside_up_assessment_status_label($du_status);
            ?>
                <div class="du-assessment-card" data-du-reveal-item>

                    <div class="du-assessment-card__top">
                        <p class="du-assessment-card__title du-text-label-caps"><?php echo esc_html($du_metric['label']); ?></p>
                        <span class="du-assessment-card__badge du-assessment-card__badge--<?php echo esc_attr($du_status); ?>">
                            <?php echo esc_html($du_status_label); ?>
                        </span>
                    </div>

                    <div class="du-assessment-card__gauge">
                        <svg viewBox="0 0 200 110" class="du-assessment-card__gauge-svg" aria-hidden="true">
                            <path class="du-gauge__track" d="M 20 100 A 80 80 0 0 1 180 100" fill="none"></path>
                            <path
                                class="du-gauge__value du-assessment-card__gauge-value du-assessment-card__gauge-value--<?php echo esc_attr($du_status); ?>"
                                d="M 20 100 A 80 80 0 0 1 180 100"
                                fill="none"
                                stroke-dasharray="<?php echo esc_attr($du_gauge_circumference); ?>"
                                stroke-dashoffset="<?php echo esc_attr($du_offset); ?>"
                                data-du-gauge-fill
                                data-value="<?php echo esc_attr($du_percent); ?>"
                                data-circumference="<?php echo esc_attr($du_gauge_circumference); ?>"
                            ></path>
                        </svg>

                        <p
                            class="du-assessment-card__score du-text-number-display"
                            data-du-gauge-number
                            aria-label="<?php echo esc_attr(sprintf(
                                /* translators: %d: score out of 100 */
                                __('%d out of 100', 'downside-up'),
                                $du_percent
                            )); ?>"
                        ><?php echo esc_html((int) $du_percent); ?></p>
                    </div>

                    <p class="du-assessment-card__insight du-text-quote">
                        &#8220;<?php echo esc_html($du_metric['insight']); ?>&#8221;
                    </p>
                </div>
            <?php endforeach; ?>

            <div class="du-assessment-card du-assessment-card--reality" data-du-reveal-item>
                <span class="du-assessment-card__reality-icon">
                    <?php echo downside_up_icon('reality-check', ['width' => 26, 'height' => 26]); ?>
                </span>

                <h3 class="du-assessment-card__reality-title du-text-headline-lg">
                    <?php echo esc_html($du_data['reality_check_title']); ?>
                </h3>

                <p class="du-assessment-card__reality-text du-text-body-md">
                    <?php echo esc_html($du_data['reality_check_text']); ?>
                </p>

                <div class="du-progress-bar du-assessment-card__reality-progress">
                    <div
                        class="du-progress-bar__fill"
                        data-du-progress-fill
                        data-value="<?php echo esc_attr($du_data['reality_check_progress']); ?>"
                        style="width: <?php echo esc_attr($du_data['reality_check_progress']); ?>%;"
                    ></div>
                </div>
            </div>

        </div>
    </div>
</section>
