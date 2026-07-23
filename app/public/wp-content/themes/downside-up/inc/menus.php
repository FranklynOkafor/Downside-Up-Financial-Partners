<?php
// Always use protection
if (!defined('ABSPATH')) {
    exit;
}




// Register navigation menus
function menu_setup() {
    register_nav_menus([
        'primary'   => __('Primary Navigation', 'downside-up'),
        'footer'    => __('Footer Navigation', 'downside-up'),
        'mobile'    => __('Mobile Navigation', 'downside-up'),
    ]);
}


add_action('after_setup_theme', 'menu_setup');