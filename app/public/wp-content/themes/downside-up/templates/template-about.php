<?php

/**
 * Template Name: Editorial Page
 * Description: Long-form editorial page layout with modular content sections.
 */

get_header();

get_template_part('template-parts/heroes/hero', 'about');

// Story Section
get_template_part('template-parts/sections/about-page/story-editorial');

// Mission & Vision Grid
get_template_part('template-parts/sections/about-page/mission-vision-grid');

// Core Principles Grid
get_template_part('template-parts/sections/about-page/principles-grid');

// What We Offer (Who We Help)
get_template_part('template-parts/sections/about-page/what-we-offer');

// Reality Check™ Process
get_template_part('template-parts/sections/about-page/reality-check-process');

// FAQ Accordion
get_template_part('template-parts/sections/about-page/faq-accordion');




get_footer();
