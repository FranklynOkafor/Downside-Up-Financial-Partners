<?php

/**
 * Reality Check™ Process — about page section.
 *
 * Loaded via: get_template_part( 'template-parts/sections/about-page/reality-check-process' );
 *
 * Explains the four-step process (Learn → Assess → Understand → Book)
 * through an icon tracker row followed by four editorial process cards,
 * closing with a two-column editorial note strip.
 *
 * Self-contained: fetches its own data (inc/about-page/reality-check-process.php),
 * so it can be dropped into any template without modification.
 */

$du_rcp       = downside_up_get_reality_check_process_data();
$du_rcp_steps = $du_rcp['steps'];
$du_rcp_note  = $du_rcp['note'];
$du_rcp_last  = count($du_rcp_steps) - 1;
?>

<section class="du-rcp" aria-labelledby="du-rcp-heading">
    <div class="du-container">

        <!-- ---- Section header ---- -->
        <div class="du-rcp__header">
            <p class="du-rcp__eyebrow du-text-label-caps">
                <?php echo esc_html($du_rcp['eyebrow']); ?>
            </p>
            <span class="du-rcp__eyebrow-rule" aria-hidden="true"></span>
            <h2 id="du-rcp-heading" class="du-rcp__heading du-text-headline-xl">
                <?php echo esc_html($du_rcp['heading']); ?>
            </h2>
            <p class="du-rcp__description du-text-body-md">
                <?php echo nl2br(esc_html($du_rcp['description'])); ?>
            </p>
        </div>

        <!-- ---- Icon tracker: step number → icon chip → connector → … ----
             aria-hidden: purely decorative. The <ol> below communicates
             sequence to assistive technology. -->
        <div class="du-rcp__tracker" aria-hidden="true">
            <?php foreach ($du_rcp_steps as $i => $step) : ?>

                <div class="du-rcp__tracker-item">
                    <span class="du-rcp__tracker-number du-text-label-caps">
                        <?php echo esc_html($step['number']); ?>
                    </span>
                    <span class="du-rcp__tracker-chip">
                        <?php echo downside_up_icon($step['icon'], [
                            'width'  => 24,
                            'height' => 24,
                        ]); ?>
                    </span>
                </div>

                <?php if ($i < $du_rcp_last) : ?>
                    <div class="du-rcp__connector">
                        <span class="du-rcp__connector-line"></span>
                        <span class="du-rcp__connector-arrow">
                            <?php echo downside_up_icon('chevron-right', [
                                'width'  => 14,
                                'height' => 14,
                            ]); ?>
                        </span>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>

        <!-- ---- Four-step process cards (ordered list — sequence matters) ---- -->
        <?php if (!empty($du_rcp_steps)) : ?>
            <ol class="du-rcp__grid" role="list">
                <?php foreach ($du_rcp_steps as $step) : ?>
                    <li class="du-rcp-card">
                        <h3 class="du-rcp-card__title du-text-headline-lg">
                            <?php echo esc_html($step['title']); ?>
                        </h3>
                        <p class="du-rcp-card__tag du-text-label-caps">
                            <?php echo esc_html($step['tag']); ?>
                        </p>
                        <p class="du-rcp-card__description du-text-body-md">
                            <?php echo esc_html($step['description']); ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

        <!-- ---- Editorial note strip ---- -->
        <div class="du-rcp__note">

            <div class="du-rcp__note-icon-wrap" aria-hidden="true">
                <span class="du-rcp__note-icon">
                    <?php echo downside_up_icon($du_rcp_note['icon'], [
                        'width'  => 22,
                        'height' => 22,
                    ]); ?>
                </span>
            </div>

            <div class="du-rcp__note-left">
                <p class="du-rcp__note-quote du-text-headline-lg">
                    <?php echo nl2br(esc_html($du_rcp_note['quote'])); ?>
                </p>
            </div>

            <div class="du-rcp__note-divider" aria-hidden="true"></div>

            <div class="du-rcp__note-right">
                <p class="du-rcp__note-copy du-text-body-md">
                    <?php echo esc_html($du_rcp_note['copy']); ?>
                </p>
            </div>

        </div>

    </div>
</section>
