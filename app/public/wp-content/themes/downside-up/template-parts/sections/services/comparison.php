<?php
/**
 * Services page comparison section.
 * Loaded via: get_template_part('template-parts/sections/services/comparison');
 *
 * Reuses the Methodology Comparison component wholesale — same
 * .du-comparison / .du-compare-card classes and reveal behaviour
 * (assets/js/how-it-works.js, already enqueued site-wide) as
 * template-parts/sections/how-it-works/comparison.php, with two columns
 * instead of three. The .du-comparison--services class adds a
 * two-column desktop grid in assets/css/_services.css; nothing in
 * _how-it-works.css is touched.
 */

$du_comparison = downside_up_get_services_comparison_data();
?>
<section class="du-comparison du-comparison--services" aria-labelledby="du-services-comparison-heading">
    <div class="du-container">

        <div class="du-comparison__header">
            <?php if (!empty($du_comparison['eyebrow'])) : ?>
                <p class="du-text-label-caps" style="color: var(--surface-tint); margin-bottom: var(--space-xs);">
                    <?php echo esc_html($du_comparison['eyebrow']); ?>
                </p>
            <?php endif; ?>
            <h2 id="du-services-comparison-heading" class="du-comparison__heading du-text-headline-xl">
                <?php echo esc_html($du_comparison['heading']); ?>
            </h2>
            <p class="du-comparison__description du-text-body-md">
                <?php echo esc_html($du_comparison['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_comparison['columns']) && is_array($du_comparison['columns'])) : ?>
            <div class="du-comparison__grid">
                <?php foreach ($du_comparison['columns'] as $du_col) :
                    $du_is_highlight = !empty($du_col['highlight']);
                    $du_classes = 'du-compare-card';
                    if ($du_is_highlight) {
                        $du_classes .= ' du-compare-card--highlight';
                    }
                ?>
                    <article class="<?php echo esc_attr($du_classes); ?>">
                        <?php if ($du_is_highlight && !empty($du_col['tag'])) : ?>
                            <span class="du-compare-card__tag"><?php echo esc_html($du_col['tag']); ?></span>
                        <?php endif; ?>

                        <span class="du-compare-card__icon">
                            <?php echo downside_up_icon($du_col['icon'], [
                                'width'  => 22,
                                'height' => 22,
                            ]); ?>
                        </span>

                        <h3 class="du-compare-card__title du-text-headline-lg">
                            <?php echo esc_html($du_col['title']); ?>
                        </h3>

                        <?php if (!empty($du_col['features']) && is_array($du_col['features'])) : ?>
                            <ul class="du-compare-card__features">
                                <?php foreach ($du_col['features'] as $du_feat) : ?>
                                    <li class="du-compare-card__feature">
                                        <span class="du-compare-card__feature-icon">
                                            <?php
                                                $icon_name = $du_is_highlight ? 'circle-check' : 'check';
                                                echo downside_up_icon($icon_name, [
                                                    'width'  => 16,
                                                    'height' => 16,
                                                ]);
                                            ?>
                                        </span>
                                        <span><?php echo esc_html($du_feat); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
