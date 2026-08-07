<?php
/**
 * Services page process section.
 * Loaded via: get_template_part('template-parts/sections/services/process');
 *
 * Reuses the Reality Check™ Process component wholesale — same .du-rcp
 * markup/classes and reveal behaviour (assets/js/about-page/reality-check-process.js,
 * already enqueued site-wide) as
 * template-parts/sections/about-page/reality-check-process.php, extended
 * from four steps to five. The .du-rcp--services class adds a five-column
 * desktop grid in assets/css/_services.css; nothing in
 * about-page/_reality-check-process.css is touched.
 */

$du_process       = downside_up_get_services_process_data();
$du_process_steps = $du_process['steps'];
$du_process_note  = $du_process['note'];
$du_process_last  = count($du_process_steps) - 1;
?>
<section class="du-rcp du-rcp--services" aria-labelledby="du-services-process-heading">
    <div class="du-container">

        <div class="du-rcp__header">
            <p class="du-rcp__eyebrow du-text-label-caps">
                <?php echo esc_html($du_process['eyebrow']); ?>
            </p>
            <span class="du-rcp__eyebrow-rule" aria-hidden="true"></span>
            <h2 id="du-services-process-heading" class="du-rcp__heading du-text-headline-xl">
                <?php echo esc_html($du_process['heading']); ?>
            </h2>
            <p class="du-rcp__description du-text-body-md">
                <?php echo nl2br(esc_html($du_process['description'])); ?>
            </p>
        </div>

        <div class="du-rcp__tracker" aria-hidden="true">
            <?php foreach ($du_process_steps as $i => $step) : ?>

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

                <?php if ($i < $du_process_last) : ?>
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

        <?php if (!empty($du_process_steps)) : ?>
            <ol class="du-rcp__grid" role="list">
                <?php foreach ($du_process_steps as $step) : ?>
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

        <div class="du-rcp__note">

            <div class="du-rcp__note-icon-wrap" aria-hidden="true">
                <span class="du-rcp__note-icon">
                    <?php echo downside_up_icon($du_process_note['icon'], [
                        'width'  => 22,
                        'height' => 22,
                    ]); ?>
                </span>
            </div>

            <div class="du-rcp__note-left">
                <p class="du-rcp__note-quote du-text-headline-lg">
                    <?php echo nl2br(esc_html($du_process_note['quote'])); ?>
                </p>
            </div>

            <div class="du-rcp__note-divider" aria-hidden="true"></div>

            <div class="du-rcp__note-right">
                <p class="du-rcp__note-copy du-text-body-md">
                    <?php echo esc_html($du_process_note['copy']); ?>
                </p>
            </div>

        </div>

    </div>
</section>
