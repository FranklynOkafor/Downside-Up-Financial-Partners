<?php
/**
 * Resources Hero.
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'resources' );
 */

$du_hero = downside_up_get_hero_resources_data();
?>
<section class="du-resources-hero" aria-labelledby="du-resources-hero-heading">
    <div class="du-resources-hero__inner du-container">

        <div class="du-resources-hero__content">
            <h1 id="du-resources-hero-heading" class="du-resources-hero__headline du-text-headline-xl">
                <?php echo esc_html($du_hero['headline']); ?>
            </h1>

            <p class="du-resources-hero__description du-text-body-md">
                <?php echo esc_html($du_hero['description']); ?>
            </p>
        </div>

        <div class="du-resources-hero__search">
            <?php
            get_template_part('template-parts/components/search-field', null, [
                'placeholder' => $du_hero['search_placeholder'],
                'aria_label'  => __('Search resources', 'downside-up'),
            ]);
            ?>
        </div>

    </div>
</section>
