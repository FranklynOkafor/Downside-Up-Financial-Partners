<?php
/**
 * Three Pillars of Discovery section.
 * Loaded via: get_template_part('template-parts/sections/how-it-works/three-pillars');
 */

$du_pillars_data = downside_up_get_how_it_works_pillars();
?>
<section class="du-pillars" aria-labelledby="du-pillars-heading">
    <div class="du-container">

        <div class="du-pillars__header">
            <h2 id="du-pillars-heading" class="du-pillars__heading du-text-headline-xl">
                <?php echo esc_html($du_pillars_data['heading']); ?>
            </h2>
            <p class="du-pillars__description du-text-body-md">
                <?php echo esc_html($du_pillars_data['description']); ?>
            </p>
        </div>

        <?php if (!empty($du_pillars_data['pillars']) && is_array($du_pillars_data['pillars'])) : ?>
            <div class="du-pillars__grid">
                <?php foreach ($du_pillars_data['pillars'] as $du_pillar) : ?>
                    <div class="du-pillar-card">
                        <span class="du-pillar-card__icon">
                            <?php echo downside_up_icon($du_pillar['icon'], [
                                'width'  => 22,
                                'height' => 22,
                            ]); ?>
                        </span>

                        <h3 class="du-pillar-card__title du-text-headline-lg">
                            <?php echo esc_html($du_pillar['title']); ?>
                        </h3>

                        <p class="du-pillar-card__description du-text-body-md">
                            <?php echo esc_html($du_pillar['description']); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
