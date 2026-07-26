<?php

/**
 * Homepage hero.
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'home' );
 *
 * Self-contained: fetches its own content (inc/hero.php) and renders
 * everything needed. front-page.php should only reference this file,
 * never contain the markup directly.
 */

$du_hero = downside_up_get_hero_home_data();

$du_image_url = get_template_directory_uri() . '/assets/images/homepage-image.png';

/**
 * TODO: replace with the file's real intrinsic dimensions once confirmed —
 * these are a placeholder estimate (4:3) so width/height still exist and
 * layout shift is prevented in the meantime, but they should match the
 * actual PNG exactly for pixel-accurate reserved space.
 */
$du_image_width  = 1200;
$du_image_height = 900;
?>
<section class="du-hero" aria-labelledby="du-hero-heading">
  <div class="du-hero__inner du-container">

    <div class="du-hero__content">
      <h1 id="du-hero-heading" class="du-hero__headline du-text-display-lg">
        <?php echo esc_html($du_hero['headline_line1']); ?><br>
        <?php echo esc_html($du_hero['headline_line2']); ?>
        <em class="du-hero__emphasis"><?php echo esc_html($du_hero['headline_emphasis']); ?></em>
      </h1>

      <p class="du-hero__description du-text-body-lg">
        <?php echo esc_html($du_hero['description']); ?>
      </p>

      <div class="du-hero__actions">
        <a href="<?php echo esc_url($du_hero['primary_button_url']); ?>" class="du-btn du-btn--primary">
          <?php echo esc_html($du_hero['primary_button_text']); ?>
        </a>
        <a href="<?php echo esc_url($du_hero['secondary_button_url']); ?>" class="du-btn du-btn--secondary">
          <?php echo esc_html($du_hero['secondary_button_text']); ?>
        </a>
      </div>
    </div>

    <div class="du-hero__media">
      <img
        src="<?php echo esc_url($du_image_url); ?>"
        alt="<?php echo esc_attr($du_hero['image_alt']); ?>"
        class="du-hero__image"
        width="<?php echo esc_attr($du_image_width); ?>"
        height="<?php echo esc_attr($du_image_height); ?>"
        loading="eager"
        fetchpriority="high"
        decoding="async">
    </div>

  </div>

  <?php if (!empty($du_hero['partners']) && is_array($du_hero['partners'])) : ?>
    <div class="du-hero__trust-bar">
      <div class="du-hero__trust-bar-inner du-container">
        <p class="du-hero__trust-label du-text-label-caps">
          <?php echo esc_html($du_hero['trust_label']); ?>
        </p>
        <ul class="du-hero__partners">
          <?php foreach ($du_hero['partners'] as $du_partner) : ?>
            <li class="du-hero__partner du-text-label-caps"><?php echo esc_html($du_partner); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>
</section>