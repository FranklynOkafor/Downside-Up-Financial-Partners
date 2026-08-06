<?php

/**
 * Template Name: Resources
 * Description: Knowledge Library / Resources page — hero, featured resource,
 * goal navigation, resource grid, assessment CTA, newsletter.
 */

get_header();

get_template_part('template-parts/heroes/hero', 'resources');

get_template_part('template-parts/sections/resources/featured-resource');

get_template_part('template-parts/sections/resources/goal-navigation');

get_template_part('template-parts/sections/resources/resource-grid');

get_template_part('template-parts/sections/resources/assessment-cta');

get_template_part('template-parts/components/newsletter');

get_footer();
