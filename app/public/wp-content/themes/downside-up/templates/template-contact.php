<?php

/**
 * Template Name: Contact Page
 * Description: Contact Us page — presence/hub intro, Direct Inquiry form,
 * operational hours, Discovery Call booking, closing testimonial.
 *
 * Follows the same assembly pattern as templates/template-about.php and
 * templates/template-services.php: get_header(), a run of
 * get_template_part() calls (each section self-contained and reused where
 * the design system already provides an equivalent), get_footer(). No
 * markup or styling lives directly in this file.
 */

get_header();

// 1. "Our Presence" hero — intro copy, hub list, decorative map visual.
get_template_part('template-parts/heroes/hero', 'contact');

// 2. Direct Inquiry form (left) + Operational Flow / Discovery Call (right).
?>
<section class="du-contact-grid du-container" aria-label="<?php esc_attr_e('Contact form and office information', 'downside-up'); ?>">

    <div class="du-contact-grid__main">
        <?php get_template_part('template-parts/contact/contact-form'); ?>
    </div>

    <div class="du-contact-grid__sidebar">
        <?php get_template_part('template-parts/contact/operational-flow'); ?>
        <?php get_template_part('template-parts/contact/discovery-call'); ?>
    </div>

</section>
<?php

// 3. Closing testimonial — reuses the theme's existing testimonial/quote
// component wholesale (template-parts/sections/testimonials.php), same as
// front-page.php. No separate testimonial component was created for this
// page.
get_template_part('template-parts/sections/testimonials');

get_footer();
