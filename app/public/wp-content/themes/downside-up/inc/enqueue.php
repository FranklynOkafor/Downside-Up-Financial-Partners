<?php

if (!defined('ABSPATH')) {
    exit;
}

function downside_up_enqueue_assets()
{
    $theme_version = wp_get_theme()->get('Version');
    $theme_uri     = get_template_directory_uri();

    // Google Fonts — EB Garamond / Hanken Grotesk / JetBrains Mono
    wp_enqueue_style(
        'du-fonts',
        'https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..700;1,400..700&family=Hanken+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap',
        [],
        null
    );

    // 1. Design tokens — must load first, everything below depends on these
    wp_enqueue_style('du-variables', $theme_uri . '/assets/css/_variable.css', [], $theme_version);

    // 2. Typography — depends on tokens
    wp_enqueue_style('du-typography', $theme_uri . '/assets/css/_typography.css', ['du-variables'], $theme_version);

    // 3. Layout (grid/containers/breakpoints)
    wp_enqueue_style('du-layout', $theme_uri . '/assets/css/_layout.css', ['du-typography'], $theme_version);

    // 4. Components
    wp_enqueue_style('du-components', $theme_uri . '/assets/css/_components.css', ['du-layout'], $theme_version);

    // 5. Buttons
    wp_enqueue_style('du-buttons', $theme_uri . '/assets/css/_buttons.css', ['du-components'], $theme_version);

    // 6. Animations / transitions
    wp_enqueue_style('du-animations', $theme_uri . '/assets/css/_animations.css', ['du-buttons'], $theme_version);

    // 7. style.css last — theme header + page-level overrides
    wp_enqueue_style('du-main', get_stylesheet_uri(), ['du-animations'], $theme_version);

    // 8. Header
    wp_enqueue_style('du-header', $theme_uri . '/assets/css/_header.css', ['du-components'], $theme_version);

    // 8b. Hero (homepage, above-the-fold)
    wp_enqueue_style('du-hero', $theme_uri . '/assets/css/_hero.css', ['du-header'], $theme_version);

    // 8c. Hero stats (directly beneath the hero)
    wp_enqueue_style('du-hero-stats', $theme_uri . '/assets/css/_hero-stats.css', ['du-hero'], $theme_version);


    // 9. Footer
    wp_enqueue_style('du-footer', $theme_uri . '/assets/css/_footer.css', ['du-header'], $theme_version);

    // 9b. CTA (single card + carousel)
    wp_enqueue_style('du-cta', $theme_uri . '/assets/css/_cta.css', ['du-footer'], $theme_version);

    // 9c. Testimonials
    wp_enqueue_style('du-testimonials', $theme_uri . '/assets/css/_testimonials.css', ['du-cta'], $theme_version);

    // 9d. Wealth Info
    wp_enqueue_style('du-wealth-info', $theme_uri . '/assets/css/_wealth-section.css', ['du-testimonials'], $theme_version);

    // 9e. Assessment Engine
    wp_enqueue_style('du-assessment-engine', $theme_uri . '/assets/css/_assessment-engine.css', ['du-wealth-info'], $theme_version);

    // 9f. How We Help
    wp_enqueue_style('du-how-we-help', $theme_uri . '/assets/css/_how-we-help.css', ['du-assessment-engine'], $theme_version);

    // 10. About Page
    wp_enqueue_style('du-story-editorial', $theme_uri . '/assets/css/about-page/_story-editorial.css', ['du-how-we-help'], $theme_version);

    // 10b. About Page — Mission & Vision Grid
    wp_enqueue_style('du-mission-vision', $theme_uri . '/assets/css/about-page/_mission-vision.css', ['du-story-editorial'], $theme_version);

    // 10c. About Page — Core Principles Grid
    wp_enqueue_style('du-principles-grid', $theme_uri . '/assets/css/about-page/_principles-grid.css', ['du-mission-vision'], $theme_version);


    // JavaScript
    wp_enqueue_script('du-navigation', $theme_uri . '/assets/js/navigation.js', [], $theme_version, true);
    wp_enqueue_script('du-cta-carousel', $theme_uri . '/assets/js/cta-carousel.js', [], $theme_version, true);
    wp_enqueue_script('du-stat-counter', $theme_uri . '/assets/js/stat-counter.js', [], $theme_version, true);
    wp_enqueue_script('du-assessment-engine', $theme_uri . '/assets/js/assessment-engine.js', [], $theme_version, true);
    wp_enqueue_script('du-story-editorial', $theme_uri . '/assets/js/about-page/story-editorial.js', [], $theme_version, true);

    wp_enqueue_script('du-main', $theme_uri . '/assets/js/main.js', [], $theme_version, true);
    wp_enqueue_script('du-how-we-help', $theme_uri . '/assets/js/how-we-help.js', [], $theme_version, true);
    wp_enqueue_script('du-hero', $theme_uri . '/assets/js/hero.js', [], $theme_version, true);

    wp_enqueue_script('du-mission-vision', $theme_uri . '/assets/js/about-page/mission-vision.js', [], $theme_version, true);
    wp_enqueue_script('du-principles-grid', $theme_uri . '/assets/js/about-page/principles-grid.js', [], $theme_version, true);
}

add_action('wp_enqueue_scripts', 'downside_up_enqueue_assets');
