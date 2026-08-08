<?php

/**
 * Discovery Call card.
 * Loaded via: get_template_part( 'template-parts/contact/discovery-call' ).
 *
 * Extends .du-cta--compact (template-parts/cta/cta-card.php's dark,
 * vertical CTA card, defined in _cta.css) rather than duplicating it —
 * same dark surface, icon badge and inverse-button language, plus the
 * page-specific availability widget added via .du-discovery-availability
 * in _contact.css.
 */

$du_discovery = downside_up_get_discovery_call_data();
?>
<div class="du-cta du-cta--compact du-cta--discovery">

    <span class="du-cta__icon" aria-hidden="true">
        <?php echo downside_up_icon('calendar', ['width' => 20, 'height' => 20]); ?>
    </span>

    <h2 class="du-cta__headline du-cta__headline--compact du-text-headline-lg">
        <?php echo esc_html($du_discovery['heading']); ?>
    </h2>

    <p class="du-cta__description du-cta__description--compact du-text-body-md">
        <?php echo esc_html($du_discovery['description']); ?>
    </p>

    <div class="du-discovery-availability" aria-hidden="true">
        <div class="du-discovery-availability__header">
            <span class="du-discovery-availability__label">
                <?php echo esc_html($du_discovery['availability_label']); ?>
            </span>
            <span class="du-discovery-availability__next">
                <?php echo esc_html($du_discovery['next_slot_label']); ?>
            </span>
        </div>
        <div class="du-discovery-availability__slots">
            <?php for ($du_i = 0; $du_i < 7; $du_i++) :
                $du_slot_class = 'du-discovery-availability__slot';
                if (in_array($du_i, [2, 4], true)) {
                    $du_slot_class .= ' du-discovery-availability__slot--available';
                }
                if (4 === $du_i) {
                    $du_slot_class .= ' du-discovery-availability__slot--selected';
                }
                ?>
                <span class="<?php echo esc_attr($du_slot_class); ?>"></span>
            <?php endfor; ?>
        </div>
    </div>

    <a href="<?php echo esc_url($du_discovery['button_url']); ?>" class="du-btn du-btn--inverse du-cta__primary">
        <?php echo esc_html($du_discovery['button_text']); ?>
    </a>

</div>
