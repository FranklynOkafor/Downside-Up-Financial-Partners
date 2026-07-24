<?php
/**
 * Single CTA card.
 *
 * Args (passed via get_template_part's third parameter):
 *   'persona_key'       (string, required) — key into inc/cta/cta-personas.php
 *   'is_carousel_slide' (bool, optional)   — adds slide-specific classes/attrs
 *
 * Content lives entirely in inc/cta/cta-personas.php — nothing persona-
 * specific is hardcoded here, so adding an 8th persona later needs no
 * template changes.
 */

$du_persona_key = isset($args['persona_key']) ? $args['persona_key'] : '';
$du_persona     = downside_up_get_cta_persona($du_persona_key);

if (!$du_persona) {
    return;
}

$du_is_slide       = !empty($args['is_carousel_slide']);
$du_is_active      = !empty($args['is_active']);
$du_assessment_url = downside_up_cta_assessment_url($du_persona_key);

$du_classes = 'du-cta';
if ($du_is_slide) {
    $du_classes .= ' du-cta--slide';
}
if ($du_is_active) {
    $du_classes .= ' is-active';
}
?>
<div
    class="<?php echo esc_attr($du_classes); ?>"
    data-persona="<?php echo esc_attr($du_persona_key); ?>"
    <?php if ($du_is_slide) : ?>role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr($du_persona['label']); ?>"<?php endif; ?>
>
    <div class="du-cta__inner du-container">

        <h2 class="du-cta__headline du-text-headline-xl"><?php echo esc_html($du_persona['headline']); ?></h2>

        <p class="du-cta__description du-text-body-md">
            <?php echo esc_html($du_persona['description']); ?>
        </p>

        <div class="du-cta__actions">
            <a href="<?php echo esc_url($du_assessment_url); ?>" class="du-btn du-btn--inverse du-cta__primary">
                <?php echo esc_html($du_persona['button_text']); ?>
            </a>
        </div>

        <p class="du-cta__supporting du-text-label-caps">
            <?php echo esc_html($du_persona['supporting_text']); ?>
        </p>

        <a href="<?php echo esc_url(home_url('/consultation/')); ?>" class="du-cta__secondary-link">
            <?php esc_html_e('Prefer to talk first? Schedule a consultation', 'downside-up'); ?>
        </a>

    </div>
</div>
