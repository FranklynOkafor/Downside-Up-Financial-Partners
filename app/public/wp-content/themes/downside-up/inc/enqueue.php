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

    // JavaScript
    wp_enqueue_script('du-navigation', $theme_uri . '/assets/js/navigation.js', [], $theme_version, true);
    wp_enqueue_script('du-main', $theme_uri . '/assets/js/main.js', [], $theme_version, true);
}

add_action('wp_enqueue_scripts', 'downside_up_enqueue_assets');
