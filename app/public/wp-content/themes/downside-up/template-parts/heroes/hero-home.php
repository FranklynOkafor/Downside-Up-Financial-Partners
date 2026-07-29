<?php
/**
 * Homepage hero.
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'home' );
 *
 * Revisions applied (all scoped to this file and inc/hero.php):
 *   R1 — Eyebrow above headline
 *   R2 — Improved supporting copy
 *   R3 — Primary CTA renamed "Start Your Financial Assessment"
 *   R4 — Trust indicators strip beneath buttons
 *   R5 — Social proof line beneath trust strip
 *   R6 — Floating dashboard context label
 *   R7 — Dashboard: fade-up reveal, idle float, mouse-tilt (hero.js)
 */

$du_hero = downside_up_get_hero_home_data();

$du_image_url    = get_template_directory_uri() . '/assets/images/homepage-image.png';
$du_image_width  = 1200;
$du_image_height = 900;
?>
<section class="du-hero" aria-labelledby="du-hero-heading">
  <div class="du-hero__inner du-container">

    <div class="du-hero__content">

      <?php /* R1 — Eyebrow */ ?>
      <?php if ( ! empty( $du_hero['eyebrow'] ) ) : ?>
        <p class="du-hero__eyebrow du-text-label-caps">
          <?php echo esc_html( $du_hero['eyebrow'] ); ?>
        </p>
      <?php endif; ?>

      <h1 id="du-hero-heading" class="du-hero__headline du-text-display-lg">
        <?php echo esc_html( $du_hero['headline_line1'] ); ?><br>
        <?php echo esc_html( $du_hero['headline_line2'] ); ?>
        <em class="du-hero__emphasis"><?php echo esc_html( $du_hero['headline_emphasis'] ); ?></em>
      </h1>

      <?php /* R2 — Improved description */ ?>
      <p class="du-hero__description du-text-body-md">
        <?php echo esc_html( $du_hero['description'] ); ?>
      </p>

      <?php /* R3 — CTA buttons (label updated in inc/hero.php data defaults) */ ?>
      <div class="du-hero__actions">
        <a href="<?php echo esc_url( $du_hero['primary_button_url'] ); ?>" class="du-btn du-btn--primary">
          <?php echo esc_html( $du_hero['primary_button_text'] ); ?>
        </a>
        <a href="<?php echo esc_url( $du_hero['secondary_button_url'] ); ?>" class="du-btn du-btn--secondary">
          <?php echo esc_html( $du_hero['secondary_button_text'] ); ?>
        </a>
      </div>

      <?php /* R4 — Trust indicators strip */ ?>
      <?php if ( ! empty( $du_hero['trust_indicators'] ) && is_array( $du_hero['trust_indicators'] ) ) : ?>
        <ul class="du-hero__trust-strip" aria-label="<?php esc_attr_e( 'Assessment trust signals', 'downside-up' ); ?>">
          <?php foreach ( $du_hero['trust_indicators'] as $du_item ) : ?>
            <li class="du-hero__trust-item">
              <?php echo downside_up_icon( 'circle-check', [ 'class' => 'du-hero__trust-icon', 'width' => 14, 'height' => 14 ] ); ?>
              <span><?php echo esc_html( $du_item ); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php /* R5 — Social proof */ ?>
      <?php if ( ! empty( $du_hero['social_proof'] ) ) : ?>
        <p class="du-hero__social-proof du-text-caption">
          <?php echo esc_html( $du_hero['social_proof'] ); ?>
        </p>
      <?php endif; ?>

    </div>

    <?php /* R6 — Dashboard illustration + floating context label, R7 — interactions driven by hero.js */ ?>
    <div class="du-hero__media" data-hero-media>
      <img
        src="<?php echo esc_url( $du_image_url ); ?>"
        alt="<?php echo esc_attr( $du_hero['image_alt'] ); ?>"
        class="du-hero__image"
        width="<?php echo esc_attr( $du_image_width ); ?>"
        height="<?php echo esc_attr( $du_image_height ); ?>"
        loading="eager"
        fetchpriority="high"
        decoding="async">

      <?php if ( ! empty( $du_hero['dashboard_label'] ) ) : ?>
        <span class="du-hero__dashboard-label du-text-caption" aria-hidden="true">
          <?php echo esc_html( $du_hero['dashboard_label'] ); ?>
        </span>
      <?php endif; ?>
    </div>

  </div>

  <?php if ( ! empty( $du_hero['partners'] ) && is_array( $du_hero['partners'] ) ) : ?>
    <div class="du-hero__trust-bar">
      <div class="du-hero__trust-bar-inner du-container">
        <p class="du-hero__trust-label du-text-label-caps">
          <?php echo esc_html( $du_hero['trust_label'] ); ?>
        </p>
        <ul class="du-hero__partners">
          <?php foreach ( $du_hero['partners'] as $du_partner ) : ?>
            <li class="du-hero__partner du-text-label-caps"><?php echo esc_html( $du_partner ); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>
</section>
