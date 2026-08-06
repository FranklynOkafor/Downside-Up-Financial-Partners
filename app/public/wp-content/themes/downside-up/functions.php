<?php

// Always use protection 
if (!defined('ABSPATH')) {
    exit;
}


// Include inc files
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/hero.php';
require_once get_template_directory() . '/inc/hero-stats.php';
require_once get_template_directory() . '/inc/assessment-engine.php';
require_once get_template_directory() . '/inc/how-we-help.php';
require_once get_template_directory() . '/inc/how-it-works-data.php';
require_once get_template_directory() . '/inc/resources.php';
require_once get_template_directory() . '/inc/newsletter.php';


require_once get_template_directory() . '/inc/menus.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/sidebars.php';
require_once get_template_directory() . '/inc/template-functions.php';

// About Page
require_once get_template_directory() . '/inc/about-page/mission-vision.php';
require_once get_template_directory() . '/inc/about-page/core-principles.php';
require_once get_template_directory() . '/inc/about-page/what-we-offer_data.php';
require_once get_template_directory() . '/inc/about-page/reality-check-process.php';
require_once get_template_directory() . '/inc/about-page/faq-accordion.php';

// CTA
require_once get_template_directory() . '/inc/cta/cta.php';

// Require files for testimonials 
require_once get_template_directory() . '/inc/testimonials.php';


// Article-specific helpers + shortcodes — companion to template-parts/heroes/hero-article.php
// and the other single.php components (TOC, share toolbar, etc.).
require_once get_template_directory() . '/inc/article.php';



?>