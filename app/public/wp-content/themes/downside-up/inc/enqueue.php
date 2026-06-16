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
    $css_dir   = get_template_directory_uri() . '/assets/css/';
    $js_dir    = get_template_directory_uri() . '/assets/js/';

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
        $css_dir . '_variable.css',
        ['downside-up-fonts'],
        $version
    );

    // Base typography rules.
    wp_enqueue_style(
        'downside-up-typography',
        $css_dir . '_typography.css',
        ['downside-up-variables'],
        $version
    );

    // Layout: containers, sections, grids, header/footer structure.
    wp_enqueue_style(
        'downside-up-layout',
        $css_dir . '_layout.css',
        ['downside-up-typography'],
        $version
    );

    // Reusable components: buttons, cards, nav, etc.
    wp_enqueue_style(
        'downside-up-components',
        $css_dir . '_components.css',
        ['downside-up-layout'],
        $version
    );

    // Global reset + base body styles.
    wp_enqueue_style(
        'downside-up-main',
        $css_dir . 'main.css',
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


    // Navigation JS.
    wp_enqueue_script(
        'downside-up-navigation',
        $js_dir . 'navigation.js',
        [],
        $version,
        true
    );
    // Global JS.
    wp_enqueue_script(
        'downside-up-main',
        $js_dir . 'main.js',
        [],
        $version,
        true
    );
}
add_action('wp_enqueue_scripts', 'downside_up_enqueue_assets');
