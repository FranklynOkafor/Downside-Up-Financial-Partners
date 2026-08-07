<?php
/**
 * Services grid.
 * Loaded via: get_template_part('template-parts/sections/services/services-grid');
 *
 * Reuses the existing service card component — .du-help-card, the same
 * card the homepage's "How We Help" section (template-parts/sections/how-we-help.php)
 * already links out to this page's anchors with. Only the grid container
 * is new (a plain 2-up layout instead of How We Help's asymmetric bento
 * grid), plus a light .du-help-card--service modifier for a more
 * prominent icon and a bolder "Learn More" affordance — both additive
 * rules in assets/css/_services.css, nothing in _how-we-help.css changes.
 */

$du_grid = downside_up_get_services_grid_data();
?>
<section class="du-services-grid" aria-labelledby="du-services-grid-heading">
    <div class="du-container">

        <div class="du-help__header">
            <?php if (!empty($du_grid['eyebrow'])) : ?>
                <p class="du-help__eyebrow du-text-label-caps"><?php echo esc_html($du_grid['eyebrow']); ?></p>
            <?php endif; ?>
            <h2 id="du-services-grid-heading" class="du-help__heading du-text-headline-xl">
                <?php echo esc_html($du_grid['heading']); ?>
            </h2>
            <p class="du-help__description du-text-body-md">
                <?php echo esc_html($du_grid['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_grid['services']) && is_array($du_grid['services'])) : ?>
            <div class="du-services-grid__grid">
                <?php foreach ($du_grid['services'] as $du_service) : ?>
                    <a
                        id="<?php echo esc_attr($du_service['anchor']); ?>"
                        href="<?php echo esc_url(home_url('/services/#' . $du_service['anchor'])); ?>"
                        class="du-help-card du-help-card--service"
                    >
                        <span class="du-help-card__icon">
                            <?php echo downside_up_icon($du_service['icon'], [
                                'width'  => 26,
                                'height' => 26,
                            ]); ?>
                        </span>

                        <h3 class="du-help-card__title du-text-headline-lg">
                            <?php echo esc_html($du_service['title']); ?>
                        </h3>

                        <p class="du-help-card__description du-text-body-md">
                            <?php echo esc_html($du_service['description']); ?>
                        </p>

                        <span class="du-help-card__link">
                            <?php esc_html_e('Learn More', 'downside-up'); ?>
                            <span class="du-help-card__link-icon">
                                <?php echo downside_up_icon('arrow-right', ['width' => 16, 'height' => 16]); ?>
                            </span>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
