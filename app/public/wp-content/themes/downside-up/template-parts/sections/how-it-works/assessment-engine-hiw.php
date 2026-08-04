<?php
/**
 * How It Works Assessment Engine section.
 * Reuses the layout, animation hooks, and CSS definitions from the homepage.
 */

$du_data = downside_up_get_how_it_works_assessment_data();

$du_gauge_radius        = 80;
$du_gauge_circumference = M_PI * $du_gauge_radius;
?>
<section id="assessment-engine" class="du-assessment du-hiw-assessment" aria-labelledby="du-hiw-assessment-heading">
    <div class="du-assessment__inner du-container">

        <div class="du-assessment__content">
            <p class="du-assessment__eyebrow du-text-label-caps">
                <?php esc_html_e( 'The Core Engine', 'downside-up' ); ?>
            </p>

            <span class="du-assessment__eyebrow-line" aria-hidden="true"></span>

            <h2 id="du-hiw-assessment-heading" class="du-assessment__heading du-text-headline-xl">
                <?php echo esc_html( $du_data['heading_line1'] ); ?><br>
                <?php echo esc_html( $du_data['heading_line2'] ); ?>
            </h2>

            <p class="du-assessment__description du-text-body-md">
                <?php echo esc_html( $du_data['description'] ); ?>
            </p>

            <?php if ( ! empty( $du_data['checklist'] ) && is_array( $du_data['checklist'] ) ) : ?>
                <ul class="du-assessment__checklist">
                    <?php foreach ( $du_data['checklist'] as $du_check_item ) : ?>
                        <li class="du-assessment__checklist-item">
                            <span class="du-assessment__checklist-icon">
                                <?php echo downside_up_icon( 'check', [ 'width' => 20, 'height' => 20 ] ); ?>
                            </span>
                            <span><?php echo esc_html( $du_check_item ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <a href="<?php echo esc_url( $du_data['cta_url'] ); ?>" class="du-btn du-btn--primary du-assessment__cta">
                <?php echo esc_html( $du_data['cta_text'] ); ?>
                <span class="du-assessment__cta-icon">
                    <?php echo downside_up_icon( 'arrow-right', [ 'width' => 18, 'height' => 18 ] ); ?>
                </span>
            </a>
        </div>

        <div class="du-assessment__cards">

            <!-- Card 1: Liquid Resilience (Gauge Card) -->
            <?php 
                $du_metric1 = $du_data['metrics'][0]; 
                $du_val1 = max(0, min(100, (float)$du_metric1['value']));
                $du_offset1 = $du_gauge_circumference * (1 - $du_val1 / 100);
            ?>
            <div class="du-assessment-card" data-du-reveal-item>
                <div class="du-assessment-card__top">
                    <p class="du-assessment-card__title du-text-label-caps"><?php echo esc_html( $du_metric1['label'] ); ?></p>
                    <span class="du-assessment-card__badge du-assessment-card__badge--<?php echo esc_attr( $du_metric1['status'] ); ?>">
                        <?php echo esc_html( downside_up_assessment_status_label( $du_metric1['status'] ) ); ?>
                    </span>
                </div>

                <div class="du-assessment-card__gauge">
                    <svg viewBox="0 0 200 110" class="du-assessment-card__gauge-svg" aria-hidden="true">
                        <path class="du-gauge__track" d="M 20 100 A 80 80 0 0 1 180 100" fill="none"></path>
                        <path
                            class="du-gauge__value du-assessment-card__gauge-value du-assessment-card__gauge-value--<?php echo esc_attr( $du_metric1['status'] ); ?>"
                            d="M 20 100 A 80 80 0 0 1 180 100"
                            fill="none"
                            stroke-dasharray="<?php echo esc_attr( $du_gauge_circumference ); ?>"
                            stroke-dashoffset="<?php echo esc_attr( $du_offset1 ); ?>"
                            data-du-gauge-fill
                            data-value="<?php echo esc_attr( $du_val1 ); ?>"
                            data-circumference="<?php echo esc_attr( $du_gauge_circumference ); ?>"
                        ></path>
                    </svg>
                    <p class="du-assessment-card__score du-text-number-display" data-du-gauge-number><?php echo (int) $du_val1; ?></p>
                </div>

                <p class="du-assessment-card__insight du-text-quote">
                    &#8220;<?php echo esc_html( $du_metric1['insight'] ); ?>&#8221;
                </p>
            </div>

            <!-- Card 2: Velocity Tracking (Progress Bar Card) -->
            <?php $du_metric2 = $du_data['metrics'][1]; ?>
            <div class="du-assessment-card" data-du-reveal-item>
                <div class="du-assessment-card__top">
                    <p class="du-assessment-card__title du-text-label-caps"><?php echo esc_html( $du_metric2['label'] ); ?></p>
                    <span class="du-assessment-card__badge du-assessment-card__badge--<?php echo esc_attr( $du_metric2['status'] ); ?>">
                        <?php echo esc_html( downside_up_assessment_status_label( $du_metric2['status'] ) ); ?>
                    </span>
                </div>

                <p class="du-assessment-card__insight du-text-quote" style="text-align: left; margin-bottom: var(--space-md);">
                    &#8220;<?php echo esc_html( $du_metric2['insight'] ); ?>&#8221;
                </p>

                <div class="du-progress-bar du-assessment-card__reality-progress">
                    <div
                        class="du-progress-bar__fill"
                        data-du-progress-fill
                        data-value="<?php echo esc_attr( $du_metric2['value'] ); ?>"
                        style="width: <?php echo esc_attr( $du_metric2['value'] ); ?>%;"
                    ></div>
                </div>
            </div>

            <!-- Card 3: Risk Aperture (Gauge Card) -->
            <?php 
                $du_metric3 = $du_data['metrics'][2]; 
                $du_val3 = max(0, min(100, (float)$du_metric3['value']));
                $du_offset3 = $du_gauge_circumference * (1 - $du_val3 / 100);
            ?>
            <div class="du-assessment-card" data-du-reveal-item>
                <div class="du-assessment-card__top">
                    <p class="du-assessment-card__title du-text-label-caps"><?php echo esc_html( $du_metric3['label'] ); ?></p>
                    <span class="du-assessment-card__badge du-assessment-card__badge--<?php echo esc_attr( $du_metric3['status'] ); ?>">
                        <?php echo esc_html( downside_up_assessment_status_label( $du_metric3['status'] ) ); ?>
                    </span>
                </div>

                <div class="du-assessment-card__gauge">
                    <svg viewBox="0 0 200 110" class="du-assessment-card__gauge-svg" aria-hidden="true">
                        <path class="du-gauge__track" d="M 20 100 A 80 80 0 0 1 180 100" fill="none"></path>
                        <path
                            class="du-gauge__value du-assessment-card__gauge-value du-assessment-card__gauge-value--<?php echo esc_attr( $du_metric3['status'] ); ?>"
                            d="M 20 100 A 80 80 0 0 1 180 100"
                            fill="none"
                            stroke-dasharray="<?php echo esc_attr( $du_gauge_circumference ); ?>"
                            stroke-dashoffset="<?php echo esc_attr( $du_offset3 ); ?>"
                            data-du-gauge-fill
                            data-value="<?php echo esc_attr( $du_val3 ); ?>"
                            data-circumference="<?php echo esc_attr( $du_gauge_circumference ); ?>"
                        ></path>
                    </svg>
                    <p class="du-assessment-card__score du-text-number-display" data-du-gauge-number><?php echo (int) $du_val3; ?></p>
                </div>

                <p class="du-assessment-card__insight du-text-quote">
                    &#8220;<?php echo esc_html( $du_metric3['insight'] ); ?>&#8221;
                </p>
            </div>

            <!-- Card 4: Reality Check Slider (Interactive Range Input Card) -->
            <div class="du-assessment-card du-assessment-card--slider" data-du-reveal-item>
                <div class="du-assessment-card__top">
                    <h3 class="du-assessment-card__reality-title du-text-headline-lg" style="margin: 0;">
                        <?php echo esc_html( $du_data['reality_check_title'] ); ?>
                    </h3>
                </div>

                <p class="du-assessment-card__reality-text du-text-body-md" style="margin-bottom: var(--space-sm);">
                    <?php echo esc_html( $du_data['reality_check_text'] ); ?>
                </p>

                <div class="du-slider-container" style="margin-top: auto;">
                    <p class="du-text-label-caps" style="margin: 0; color: var(--on-surface-variant); display: flex; align-items: center;">
                        <span><?php echo esc_html( $du_data['reality_check_label'] ); ?></span>
                        <span class="du-slider-value-display">(<?php echo esc_html( $du_data['reality_check_value'] ); ?>%)</span>
                    </p>
                    <input 
                        type="range" 
                        class="du-slider" 
                        min="0" 
                        max="15" 
                        step="0.1" 
                        value="<?php echo esc_attr( $du_data['reality_check_value'] ); ?>"
                        aria-label="<?php echo esc_attr( $du_data['reality_check_label'] ); ?>"
                    >
                </div>

                <!-- Decorative Compass Icon -->
                <span class="du-assessment-card__compass-icon">
                    <?php echo downside_up_icon( 'compass', [ 'width' => 72, 'height' => 72 ] ); ?>
                </span>
            </div>

        </div>
    </div>
</section>
