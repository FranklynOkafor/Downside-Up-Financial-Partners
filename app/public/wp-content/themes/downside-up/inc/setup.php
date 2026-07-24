<?php

// Always use protection
if (!defined('ABSPATH')) {
    exit;
}


/**
 * Theme Setup
 * Registers theme features and support.
 */
function downside_up_setup() {

    // Title tag — lets WordPress manage the <title> tag automatically
    add_theme_support('title-tag');

    // Featured images — enables post thumbnail support
    add_theme_support('post-thumbnails');

    // Custom logo — enables the custom logo option in Customizer
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 60,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // HTML5 support — outputs cleaner HTML5 markup for core elements
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Wide alignment — enables wide & full-width block alignment in the editor
    add_theme_support('align-wide');

    // Editor styles — loads a stylesheet inside the block editor to match frontend
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    

}
add_action('after_setup_theme', 'downside_up_setup');
