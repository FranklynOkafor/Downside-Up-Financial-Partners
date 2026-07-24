<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Renders the site's custom logo image (set under Appearance > Customize >
 * Site Identity), or an empty string if none has been uploaded yet.
 * Usage: echo downside_up_logo_image( [ 'class' => 'du-site-branding__image' ] );
 */
function downside_up_logo_image($args = [])
{
    $logo_id = get_theme_mod('custom_logo');

    if (!$logo_id) {
        return '';
    }

    $defaults = ['class' => 'du-logo-image'];
    $args = wp_parse_args($args, $defaults);

    return wp_get_attachment_image($logo_id, 'full', false, [
        'class' => $args['class'],
    ]);
}

/**
 * Central helper for inline SVG icons.
 * Usage: echo downside_up_icon( 'menu', [ 'class' => 'du-nav__icon' ] );
 */
function downside_up_icon($name, $args = [])
{
    $defaults = [
        'class'  => 'du-icon',
        'width'  => 20,
        'height' => 20,
    ];
    $args = wp_parse_args($args, $defaults);

    $icons = [
        'menu' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',

        'close' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',

        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.2 8.5h4.6V23H.2V8.5zM8.3 8.5h4.4v2h.06c.61-1.16 2.12-2.38 4.36-2.38C21.7 8.12 23 10.4 23 14.2V23h-4.6v-7.6c0-1.8-.03-4.12-2.5-4.12-2.51 0-2.9 1.96-2.9 3.98V23H8.3V8.5z"/></svg>',

        'x-twitter' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M18.9 2H22l-7.6 8.7L23.3 22h-6.9l-5.4-6.6L4.8 22H1.7l8.1-9.3L1 2h7.1l4.9 6.1L18.9 2zm-1.2 18h1.9L7.4 4H5.4l12.3 16z"/></svg>',
    ];

    if (!isset($icons[$name])) {
        return '';
    }

    return sprintf($icons[$name], esc_attr($args['class']), (int) $args['width'], (int) $args['height']);
}
