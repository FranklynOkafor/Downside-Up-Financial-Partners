<?php

if (!defined('ABSPATH')) {
    exit;
}

function downside_up_enqueue_assets() {

    wp_enqueue_style(
        'downside-up-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'downside-up-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );
}

add_action('wp_enqueue_scripts', 'downside_up_enqueue_assets');