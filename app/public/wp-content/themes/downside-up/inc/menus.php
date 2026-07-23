<?php
// Always use protection
if (!defined('ABSPATH')) {
    exit;
}




// Register navigation menus
function menu_setup()
{
    register_nav_menus([
        'primary'         => __('Primary Menu', 'downside-up'),
        'footer-platform' => __('Platform', 'downside-up'),
        'footer-customer' => __('Customer', 'downside-up'),
        'footer-legal'    => __('Legal', 'downside-up'),
        'mobile'    => __('Mobile Navigation', 'downside-up'),
    ]);
}


add_action('after_setup_theme', 'menu_setup');
