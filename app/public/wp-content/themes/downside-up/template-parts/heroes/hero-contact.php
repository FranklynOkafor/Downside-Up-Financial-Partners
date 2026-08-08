<?php

/**
 * Contact Us page hero — "Our Presence".
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'contact' ).
 *
 * Reuses the .du-hero base (eyebrow/headline/description treatment)
 * already established by hero-about.php / hero-services.php. Layout
 * modifier (.du-hero--contact / .du-contact-hero) and the map visual are
 * new, additive rules in assets/css/_contact.css only.
 */

$du_contact_hero = downside_up_get_hero_contact_data();
?>
<section class="du-hero du-hero--contact" aria-labelledby="du-contact-hero-heading">
    <div class="du-hero__inner du-container du-contact-hero">

        <div class="du-hero__content">

            <?php if (!empty($du_contact_hero['eyebrow'])) : ?>
                <p class="du-hero__eyebrow du-text-label-caps">
                    <?php echo esc_html($du_contact_hero['eyebrow']); ?>
                </p>
            <?php endif; ?>

            <h1 id="du-contact-hero-heading" class="du-hero__headline du-text-headline-xl">
                <?php echo esc_html($du_contact_hero['headline']); ?>
            </h1>

            <p class="du-hero__description du-text-body-md">
                <?php echo esc_html($du_contact_hero['description']); ?>
            </p>

            <?php if (!empty($du_contact_hero['locations'])) : ?>
                <ul class="du-contact-locations">
                    <?php foreach ($du_contact_hero['locations'] as $du_location) : ?>
                        <li class="du-contact-location">
                            <span class="du-contact-location__icon" aria-hidden="true">
                                <?php echo downside_up_icon('map-pin', ['width' => 22, 'height' => 22]); ?>
                            </span>
                            <span>
                                <p class="du-contact-location__name"><?php echo esc_html($du_location['name']); ?></p>
                                <p class="du-contact-location__address"><?php echo esc_html($du_location['address']); ?></p>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

        <!-- Decorative location/presence visual — no map API, no external
             request. The addresses above already carry the real,
             accessible information, so this whole panel is aria-hidden. -->
        <div class="du-contact-map" aria-hidden="true">
            <div class="du-contact-map__chrome">
                <span class="du-contact-map__chrome-item">Platform</span>
                <span class="du-contact-map__chrome-item">Solutions</span>
                <span class="du-contact-map__chrome-item">About</span>
                <span class="du-contact-map__chrome-item du-contact-map__chrome-item--active">Contact</span>
            </div>
            <div class="du-contact-map__viewport">
                <span class="du-contact-map__river"></span>

                <?php if (!empty($du_contact_hero['map_title'])) : ?>
                    <p class="du-contact-map__title"><?php echo esc_html($du_contact_hero['map_title']); ?></p>
                <?php endif; ?>

                <?php foreach ($du_contact_hero['map_markers'] as $du_marker) :
                    $du_marker_classes = 'du-contact-map__marker';
                    if (!empty($du_marker['primary'])) {
                        $du_marker_classes .= ' du-contact-map__marker--primary';
                    }
                    ?>
                    <span
                        class="<?php echo esc_attr($du_marker_classes); ?>"
                        style="left:<?php echo esc_attr($du_marker['x']); ?>%; top:<?php echo esc_attr($du_marker['y']); ?>%;">
                        <span class="du-contact-map__marker-dot"></span>
                        <?php echo esc_html($du_marker['label']); ?>
                    </span>
                <?php endforeach; ?>

                <?php if (!empty($du_contact_hero['map_status'])) : ?>
                    <span class="du-contact-map__status">
                        <span class="du-contact-map__status-dot"></span>
                        <?php echo esc_html($du_contact_hero['map_status']); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>
