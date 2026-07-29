<?php

/**
 * How We Help section — homepage services preview.
 * Loaded via: get_template_part( 'template-parts/sections/how-we-help' );
 *
 * Bento-style grid: the first service (see downside_up_get_how_we_help_data()'s
 * docblock) renders with .du-help-card--featured for the larger "primary
 * service" treatment; CSS grid-auto-flow: dense packs the remaining five
 * around it. Closes with a compact bridge CTA back to the Assessment.
 *
 * Self-contained: fetches its own data (inc/how-we-help.php).
 */

$du_help = downside_up_get_how_we_help_data();
?>
<section class="du-help" aria-labelledby="du-help-heading">
    <div class="du-container">

        <div class="du-help__header">
            <p class="du-help__eyebrow du-text-label-caps"><?php echo esc_html($du_help['eyebrow']); ?></p>
            <h2 id="du-help-heading" class="du-help__heading du-text-headline-xl">
                <?php echo esc_html($du_help['heading']); ?>
            </h2>
            <p class="du-help__description du-text-body-md">
                <?php echo esc_html($du_help['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_help['services']) && is_array($du_help['services'])) : ?>
            <div class="du-help__grid">
                <?php foreach ($du_help['services'] as $du_index => $du_service) :
                    $du_is_featured = (0 === $du_index);
                ?>
                    <a
                        href="<?php echo esc_url($du_service['url']); ?>"
                        class="du-help-card<?php echo $du_is_featured ? ' du-help-card--featured' : ''; ?>"
                    >
                        <span class="du-help-card__icon">
                            <?php echo downside_up_icon($du_service['icon'], [
                                'width'  => $du_is_featured ? 28 : 22,
                                'height' => $du_is_featured ? 28 : 22,
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

        <!-- <div class="du-help__bridge">
            <h3 class="du-help__bridge-heading du-text-headline-lg">
                <?php echo esc_html($du_help['bridge_heading']); ?>
            </h3>
            <p class="du-help__bridge-description du-text-body-md">
                <?php echo esc_html($du_help['bridge_description']); ?>
            </p>
            <a href="<?php echo esc_url($du_help['bridge_button_url']); ?>" class="du-btn du-btn--primary">
                <?php echo esc_html($du_help['bridge_button_text']); ?>
                <span class="du-help__bridge-cta-icon">
                    <?php echo downside_up_icon('arrow-right', ['width' => 18, 'height' => 18]); ?>
                </span>
            </a>
        </div> -->

    </div>
</section>
