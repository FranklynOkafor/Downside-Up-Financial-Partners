<?php
/**
 * Uncompromising Privacy Section (Dark Theme)
 * Loaded via: get_template_part('template-parts/sections/how-it-works/privacy');
 */

$du_privacy = downside_up_get_how_it_works_privacy_data();
?>
<section class="du-privacy" aria-labelledby="du-privacy-heading">
    <div class="du-privacy__inner du-container">

        <div class="du-privacy__content">
            <?php if (!empty($du_privacy['eyebrow'])) : ?>
                <p class="du-privacy__eyebrow du-text-label-caps">
                    <?php echo esc_html($du_privacy['eyebrow']); ?>
                </p>
            <?php endif; ?>

            <h2 id="du-privacy-heading" class="du-privacy__heading du-text-headline-xl">
                <?php echo esc_html($du_privacy['heading']); ?>
            </h2>

            <p class="du-privacy__description du-text-body-md">
                <?php echo esc_html($du_privacy['description']); ?>
            </p>

            <?php if (!empty($du_privacy['features']) && is_array($du_privacy['features'])) : ?>
                <div class="du-privacy__features">
                    <?php foreach ($du_privacy['features'] as $du_feat) : ?>
                        <div class="du-privacy-feature">
                            <span class="du-privacy-feature__icon">
                                <?php echo downside_up_icon($du_feat['icon'], [
                                    'width'  => 20,
                                    'height' => 20,
                                ]); ?>
                            </span>
                            <div class="du-privacy-feature__info">
                                <h3 class="du-privacy-feature__title">
                                    <?php echo esc_html($du_feat['title']); ?>
                                </h3>
                                <p class="du-privacy-feature__description du-text-body-md">
                                    <?php echo esc_html($du_feat['description']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pulse Shield Illustration -->
        <div class="du-privacy__media">
            <div class="du-privacy-shield-container">
                <span class="du-privacy-shield-icon">
                    <?php echo downside_up_icon('shield-check', [
                        'width'  => 72,
                        'height' => 72,
                    ]); ?>
                </span>
                
                <div class="du-privacy-shield-badge">
                    <span style="color: var(--success); display: inline-flex;">
                        <?php echo downside_up_icon('check', ['width' => 12, 'height' => 12]); ?>
                    </span>
                    <p class="du-privacy-shield-badge__text"><?php esc_html_e('Shield Protected', 'downside-up'); ?></p>
                </div>
            </div>
        </div>

    </div>
</section>
