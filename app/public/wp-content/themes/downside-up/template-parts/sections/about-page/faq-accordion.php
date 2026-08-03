<?php

/**
 * FAQ Accordion — about page section.
 *
 * Loaded via: get_template_part( 'template-parts/sections/about-page/faq-accordion' );
 *
 * Displays a list of frequently asked questions using an accessible
 * accordion pattern, followed by a support note strip.
 *
 * Self-contained: fetches its own data (inc/about-page/faq-accordion.php),
 * so it can be dropped into any template without modification.
 */

$du_faq = downside_up_get_faq_data();
$du_faq_items = $du_faq['items'];
$du_faq_support = $du_faq['support_note'];
?>

<section class="du-faq" aria-labelledby="du-faq-heading">
    <div class="du-container">

        <!-- ---- Section header ---- -->
        <div class="du-faq__header">
            <p class="du-faq__eyebrow du-text-label-caps">
                <?php echo esc_html($du_faq['eyebrow']); ?>
            </p>
            <span class="du-faq__eyebrow-rule" aria-hidden="true"></span>
            <h2 id="du-faq-heading" class="du-faq__heading du-text-headline-xl">
                <?php echo esc_html($du_faq['heading']); ?>
            </h2>
            <p class="du-faq__description du-text-body-md">
                <?php echo esc_html($du_faq['description']); ?>
            </p>
        </div>

        <!-- ---- Accordion List ---- -->
        <?php if (!empty($du_faq_items)) : ?>
            <div class="du-faq__accordion">
                <?php foreach ($du_faq_items as $index => $item) : 
                    $item_id = 'faq-item-' . ($index + 1);
                    $trigger_id = 'faq-trigger-' . ($index + 1);
                    $panel_id = 'faq-panel-' . ($index + 1);
                ?>
                    <div class="du-faq-item">
                        <h3>
                            <button 
                                id="<?php echo esc_attr($trigger_id); ?>"
                                class="du-faq-item__trigger"
                                aria-expanded="false"
                                aria-controls="<?php echo esc_attr($panel_id); ?>"
                                type="button"
                            >
                                <span class="du-faq-item__question">
                                    <?php echo esc_html($item['question']); ?>
                                </span>
                                <span class="du-faq-item__icon-wrap" aria-hidden="true">
                                    <span class="du-faq-item__icon"></span>
                                </span>
                            </button>
                        </h3>
                        <div 
                            id="<?php echo esc_attr($panel_id); ?>"
                            class="du-faq-item__panel"
                            aria-labelledby="<?php echo esc_attr($trigger_id); ?>"
                            role="region"
                            hidden
                        >
                            <div class="du-faq-item__content du-text-body-md">
                                <p><?php echo esc_html($item['answer']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- ---- Support Note Strip ---- -->
        <div class="du-faq__support-note">
            <div class="du-faq__support-icon-wrap" aria-hidden="true">
                <span class="du-faq__support-icon">
                    <?php echo downside_up_icon($du_faq_support['icon'], [
                        'width'  => 22,
                        'height' => 22,
                    ]); ?>
                </span>
            </div>
            
            <div class="du-faq__support-divider" aria-hidden="true"></div>

            <div class="du-faq__support-text-wrap">
                <h3 class="du-faq__support-title du-text-headline-lg">
                    <?php echo esc_html($du_faq_support['title']); ?>
                </h3>
                <p class="du-faq__support-copy du-text-body-md">
                    <?php echo esc_html($du_faq_support['copy']); ?>
                </p>
            </div>
        </div>

    </div>
</section>
