<?php
/**
 * Services page hero.
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'services' );
 *
 * Reuses the .du-hero base (design tokens, buttons, eyebrow/emphasis
 * treatment) already established by hero-home.php and hero-about.php.
 * Layout modifier (.du-hero--services / .du-services-hero) and the wider
 * media aspect ratio are new, additive rules in assets/css/_services.css
 * — nothing in _hero.css is touched or duplicated.
 */

$du_services_hero = downside_up_get_services_hero_data();
?>
<section class="du-hero du-hero--services" aria-labelledby="du-services-hero-heading">
    <div class="du-hero__inner du-container du-services-hero">

        <div class="du-hero__content">

            <?php if (!empty($du_services_hero['eyebrow'])) : ?>
                <p class="du-hero__eyebrow du-text-label-caps">
                    <?php echo esc_html($du_services_hero['eyebrow']); ?>
                </p>
            <?php endif; ?>

            <h1 id="du-services-hero-heading" class="du-hero__headline du-text-headline-xl">
                <?php echo esc_html($du_services_hero['headline_line1']); ?>
                <em class="du-hero__emphasis"><?php echo esc_html($du_services_hero['headline_emphasis']); ?></em>
            </h1>

            <p class="du-hero__description du-text-body-md">
                <?php echo esc_html($du_services_hero['description']); ?>
            </p>

            <div class="du-hero__actions">
                <a href="<?php echo esc_url($du_services_hero['primary_button_url']); ?>" class="du-btn du-btn--primary">
                    <?php echo esc_html($du_services_hero['primary_button_text']); ?>
                </a>
                <a href="<?php echo esc_url($du_services_hero['secondary_button_url']); ?>" class="du-btn du-btn--secondary">
                    <?php echo esc_html($du_services_hero['secondary_button_text']); ?>
                </a>
            </div>

        </div>

        <div class="du-services-hero__media">
            <img
                src="<?php echo esc_url($du_services_hero['image_url']); ?>"
                alt="<?php echo esc_attr($du_services_hero['image_alt']); ?>"
                class="du-services-hero__image"
                loading="eager"
                fetchpriority="high"
                decoding="async">
        </div>

    </div>
</section>
