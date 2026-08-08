<?php

/**
 * Operational Flow card — office hours + global-support note.
 * Loaded via: get_template_part( 'template-parts/contact/operational-flow' ).
 */

$du_flow = downside_up_get_operational_flow_data();
?>
<div class="du-operational-flow">

    <div class="du-operational-flow__header">
        <h2 class="du-operational-flow__heading du-text-headline-lg">
            <?php echo esc_html($du_flow['heading']); ?>
        </h2>
        <span class="du-operational-flow__icon" aria-hidden="true">
            <?php echo downside_up_icon('clock', ['width' => 22, 'height' => 22]); ?>
        </span>
    </div>

    <div class="du-operational-flow__rows">
        <?php foreach ($du_flow['rows'] as $du_row) : ?>
            <div class="du-operational-flow__row">
                <span class="du-operational-flow__label"><?php echo esc_html($du_row['label']); ?></span>
                <span class="du-operational-flow__value<?php echo !empty($du_row['reserved']) ? ' du-operational-flow__value--reserved' : ''; ?>">
                    <?php echo esc_html($du_row['value']); ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($du_flow['note'])) : ?>
        <p class="du-operational-flow__note du-text-caption">
            <?php echo esc_html($du_flow['note']); ?>
        </p>
    <?php endif; ?>

</div>
