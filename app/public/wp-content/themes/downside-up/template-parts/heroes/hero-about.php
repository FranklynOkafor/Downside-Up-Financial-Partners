<?php
// About Us Hero

$du_about_hero = downside_up_get_hero_about_data();

$du_image_url = get_template_directory_uri() . '/assets/images/About-us-hero.jpg';
$du_image_height = 400;

?>

<section class="du-hero du-hero--about">
    <div class="du-hero__inner du-container du-about-hero">
        <div class="du-hero__content">
            <!-- EYEBROW -->
            <?php if (! empty($du_about_hero['eyebrow'])) : ?>
                <p class="du-hero__eyebrow du-text-label-caps">
                    <?php echo esc_html($du_about_hero['eyebrow']); ?>
                </p>
            <?php endif; ?>

            <!-- Heading -->
            <h1 class="du-hero__headline du-text-headline-xl">
                <?php echo esc_html($du_about_hero['headline_line1']); ?><br>
                <?php echo esc_html($du_about_hero['headline_line2']); ?>
                <em class="du-hero__emphasis"><?php echo esc_html($du_about_hero['headline_emphasis']); ?></em>
            </h1>

            <!-- Supporting Text -->
            <?php /* R2 — Improved description */ ?>
            <p class="du-hero__description du-text-quote">
                <?php echo esc_html($du_about_hero['description']); ?>
            </p>
        </div>
        <!-- RIGHT SIDE (IMAGE AND QUOTE) -->
        <div class="du-about-hero__media">
            <div class="about-img-div">
                <img
                    src="<?php echo esc_url($du_image_url); ?>"
                    alt="<?php echo esc_attr('Men communicating'); ?>"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                    class="du-about-hero__image">
                <div class="about__quote">
                    <p class="du-text-caption">"Clarity isn't built with spreadsheets. It's built through understanding."</p>
                </div>
            </div>


        </div>
    </div>
</section>