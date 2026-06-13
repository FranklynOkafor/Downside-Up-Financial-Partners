<?php

if (!defined('ABSPATH')) {
    exit;
}

function downside_up_register_menus()
{

    register_nav_menus([
        'primary' => __('Primary Menu', 'downside-up'),
        'footer'  => __('Footer Menu', 'downside-up'),
    ]);
}

add_action('after_setup_theme', 'downside_up_register_menus');
