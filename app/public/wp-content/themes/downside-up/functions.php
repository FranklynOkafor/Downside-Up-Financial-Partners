<?php

if (!defined('ABSPATH')) {
    exit;
}

function downside_up_theme_setup() {

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => __('Primary Menu', 'downside-up')
    ]);

}

add_action('after_setup_theme', 'downside_up_theme_setup');