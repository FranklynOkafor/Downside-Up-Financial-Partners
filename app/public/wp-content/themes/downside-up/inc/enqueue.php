<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme styles and scripts.
 */
function downside_up_enqueue_assets()
{
    $version = wp_get_theme()->get('Version');

    // Google Fonts used by the design system (Manrope for headings, Inter for body).
    wp_enqueue_style(
        'downside-up-fonts',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@500;700;800&family=Inter:wght@400;500;600&display=swap',
        [],
        null
    );

    // Design tokens (CSS custom properties).
    wp_enqueue_style(
        'downside-up-variables',
        get_template_directory_uri() . '/assets/css/_variable.css',
        [],
        $version
    );

    // Base typography rules.
    wp_enqueue_style(
        'downside-up-typography',
        get_template_directory_uri() . '/assets/css/_typography.css',
        ['downside-up-variables'],
        $version
    );

    // Layout: containers, sections, grids, header/footer structure.
    wp_enqueue_style(
        'downside-up-layout',
        get_template_directory_uri() . '/assets/css/_layout.css',
        ['downside-up-typography'],
        $version
    );

    // Reusable components: buttons, cards, nav, etc.
    wp_enqueue_style(
        'downside-up-components',
        get_template_directory_uri() . '/assets/css/_components.css',
        ['downside-up-layout'],
        $version
    );

    // Global reset + base body styles.
    wp_enqueue_style(
        'downside-up-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['downside-up-components'],
        $version
    );

    // Theme stylesheet (required by WordPress, loaded last so it can override).
    wp_enqueue_style(
        'downside-up-style',
        get_stylesheet_uri(),
        ['downside-up-main'],
        $version
    );

    // Global JS (nav, carousels, etc.).
    wp_enqueue_script(
        'downside-up-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $version,
        true
    );
}
add_action('wp_enqueue_scripts', 'downside_up_enqueue_assets');
