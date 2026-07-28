<?php
/**
 * Hero statistics section.
 * Loaded via: get_template_part( 'template-parts/sections/hero-stats' );
 * Positioned directly beneath the hero, per the design brief.
 *
 * Numbers animate from 0 on scroll-into-view (assets/js/stat-counter.js).
 * The visible number defaults to its correct final formatted value in the
 * markup itself (progressive enhancement: correct even with JS disabled),
 * and carries an aria-label with that same final value so screen readers
 * get it once rather than reading the animation. The animated digits are
 * aria-hidden.
 */

$du_data  = downside_up_get_hero_stats_data();
$du_stats = $du_data['stats'];

if (empty($du_stats) || !is_array($du_stats)) {
    return;
}
?>
<section class="du-hero-stats" aria-labelledby="du-hero-stats-heading">
    <h2 id="du-hero-stats-heading" class="du-sr-only">
        <?php esc_html_e('Our Track Record', 'downside-up'); ?>
    </h2>

    <div class="du-hero-stats__inner du-container">

        <div class="du-hero-stats__intro">
            <p class="du-hero-stats__eyebrow du-text-label-caps">
                <?php echo esc_html($du_data['eyebrow']); ?>
            </p>
            <span class="du-hero-stats__accent" aria-hidden="true"></span>
        </div>

        <div class="du-hero-stats__grid" data-stat-group>
            <?php foreach ($du_stats as $du_stat) : ?>
                <?php
                $du_formatted = downside_up_format_stat_number($du_stat['value'], $du_stat['prefix'], $du_stat['suffix']);
                ?>
                <div class="du-hero-stats__item">
                    <span class="du-hero-stats__icon" aria-hidden="true">
                        <?php echo downside_up_icon($du_stat['icon'], ['width' => 24, 'height' => 24]); ?>
                    </span>

                    <p
                        class="du-hero-stats__number"
                        data-stat-number
                        data-value="<?php echo esc_attr($du_stat['value']); ?>"
                        data-prefix="<?php echo esc_attr($du_stat['prefix']); ?>"
                        data-suffix="<?php echo esc_attr($du_stat['suffix']); ?>"
                        aria-label="<?php echo esc_attr($du_formatted); ?>"
                    >
                        <span aria-hidden="true" data-stat-number-display><?php echo esc_html($du_formatted); ?></span>
                    </p>

                    <p class="du-hero-stats__label"><?php echo esc_html($du_stat['label']); ?></p>
                    <span class="du-hero-stats__label-accent" aria-hidden="true"></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="du-hero-stats__trust">
            <span class="du-hero-stats__trust-icon" aria-hidden="true">
                <?php echo downside_up_icon('shield-check', ['width' => 16, 'height' => 16]); ?>
            </span>
            <?php echo esc_html($du_data['trust_line']); ?>
        </p>

    </div>
</section>
