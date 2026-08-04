<?php
/**
 * How It Works hero.
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'how-it-works' );
 */

$du_hero = downside_up_get_how_it_works_hero_data();
?>
<section class="du-hiw-hero" aria-labelledby="du-hiw-hero-heading">
    <div class="du-hiw-hero__inner du-container">

        <div class="du-hiw-hero__content">
            <?php if (!empty($du_hero['eyebrow'])) : ?>
                <p class="du-hiw-hero__eyebrow du-text-label-caps">
                    <?php echo esc_html($du_hero['eyebrow']); ?>
                </p>
            <?php endif; ?>

            <h1 id="du-hiw-hero-heading" class="du-hiw-hero__headline du-text-display-lg">
                <?php echo esc_html($du_hero['headline_line1']); ?><br>
                <em class="du-hiw-hero__emphasis"><?php echo esc_html($du_hero['headline_line2']); ?></em>
            </h1>

            <p class="du-hiw-hero__description du-text-body-md">
                <?php echo esc_html($du_hero['description']); ?>
            </p>

            <div class="du-hiw-hero__actions">
                <a href="<?php echo esc_url($du_hero['primary_button_url']); ?>" class="du-btn du-btn--primary">
                    <?php echo esc_html($du_hero['primary_button_text']); ?>
                </a>
                <a href="<?php echo esc_url($du_hero['secondary_button_url']); ?>" class="du-btn du-btn--secondary">
                    <?php echo esc_html($du_hero['secondary_button_text']); ?>
                </a>
            </div>
        </div>

        <div class="du-hiw-hero__media">
            <!-- SaaS Mockup Panel -->
            <div class="du-hiw-dashboard">
                <div class="du-hiw-dashboard__header">
                    <h3 class="du-hiw-dashboard__title"><?php echo esc_html($du_hero['dashboard_label']); ?></h3>
                    <span class="du-hiw-dashboard__badge"><?php esc_html_e('Active', 'downside-up'); ?></span>
                </div>

                <div class="du-hiw-dashboard__grid">
                    <div class="du-hiw-dashboard__metric">
                        <p class="du-hiw-dashboard__metric-label du-text-label-caps"><?php esc_html_e('Liquid Assets', 'downside-up'); ?></p>
                        <p class="du-hiw-dashboard__metric-value du-text-number-display" data-hiw-metric="liquid">$0</p>
                    </div>
                    <div class="du-hiw-dashboard__metric">
                        <p class="du-hiw-dashboard__metric-label du-text-label-caps"><?php esc_html_e('Risk Exposure', 'downside-up'); ?></p>
                        <p class="du-hiw-dashboard__metric-value du-text-number-display" data-hiw-metric="risk">0%</p>
                    </div>
                </div>

                <!-- Animated Line Graph Area -->
                <div class="du-hiw-dashboard__chart-wrap">
                    <svg viewBox="0 0 360 140" class="du-hiw-dashboard__chart-svg" aria-hidden="true">
                        <!-- Horizontal Grid Lines -->
                        <line x1="0" y1="20" x2="360" y2="20" stroke="var(--border)" stroke-width="1" stroke-dasharray="4 4" />
                        <line x1="0" y1="60" x2="360" y2="60" stroke="var(--border)" stroke-width="1" stroke-dasharray="4 4" />
                        <line x1="0" y1="100" x2="360" y2="100" stroke="var(--border)" stroke-width="1" stroke-dasharray="4 4" />
                        
                        <!-- Smooth Growth Curve -->
                        <path 
                            class="du-hiw-dashboard__chart-line" 
                            d="M 10 110 Q 90 90, 160 50 T 340 30" 
                            fill="none" 
                            stroke="var(--success)" 
                            stroke-width="3" 
                            stroke-linecap="round"
                        />
                    </svg>

                    <!-- Floating Widgets/Context Elements -->
                    <div class="du-hiw-dashboard__float du-hiw-dashboard__float--left">
                        <span class="du-hiw-dashboard__float-icon">
                            <?php echo downside_up_icon('circle-check', ['width' => 14, 'height' => 14]); ?>
                        </span>
                        <p class="du-hiw-dashboard__float-text"><?php esc_html_e('Healthy Standing', 'downside-up'); ?></p>
                    </div>

                    <div class="du-hiw-dashboard__float du-hiw-dashboard__float--right">
                        <span class="du-hiw-dashboard__float-icon">
                            <?php echo downside_up_icon('trending-up', ['width' => 14, 'height' => 14]); ?>
                        </span>
                        <p class="du-hiw-dashboard__float-text"><?php esc_html_e('+14.2% Wealth Flow', 'downside-up'); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
