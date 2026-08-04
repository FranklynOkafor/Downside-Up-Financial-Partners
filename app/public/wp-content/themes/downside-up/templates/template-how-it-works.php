<?php
/**
 * Template Name: How It Works Page
 * Description: Educational page explaining the proprietary assessment process.
 */

get_header();

// 1. Hero Section
get_template_part('template-parts/heroes/hero', 'how-it-works');

// 2. Three Pillars of Discovery
get_template_part('template-parts/sections/how-it-works/three-pillars');

// 3. Assessment Engine
get_template_part('template-parts/sections/how-it-works/assessment-engine-hiw');

// 4. Why Our Method Is Different (Comparison Section)
get_template_part('template-parts/sections/how-it-works/comparison');

// 5. Privacy Section
get_template_part('template-parts/sections/how-it-works/privacy');

// 6. Final CTA
get_template_part('template-parts/sections/how-it-works/cta-hiw');

get_footer();
