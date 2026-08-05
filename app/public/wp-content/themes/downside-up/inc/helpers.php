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

        'chevron-left' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>',

        'chevron-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>',

        'people' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><circle cx="9" cy="8" r="3"/><path d="M3.5 19c.7-3 2.8-5 5.5-5s4.8 2 5.5 5"/><path d="M16 8.5c1.1 0 2 .9 2 2s-.9 2-2 2"/><path d="M16.5 12.2c1.9.4 3.3 2 3.8 4.3"/></svg>',

        'shield-check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M12 3l7 3v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V6l7-3z"/><polyline points="9 12 11 14 15 10"/></svg>',

        'trending-up' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><polyline points="3 17 9 11 13 15 21 6"/><polyline points="15 6 21 6 21 12"/></svg>',

        'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><circle cx="12" cy="12" r="9"/><polyline points="8 12.5 10.5 15 16 9"/></svg>',

        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><line x1="4" y1="12" x2="20" y2="12"/><polyline points="13 5 20 12 13 19"/></svg>',

        'reality-check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M9 10.5a3 3 0 1 1 4.2 2.7c-.7.35-1.2.9-1.2 1.55V15"/><circle cx="12" cy="18.2" r="0.15" fill="currentColor" stroke="none"/><rect x="3" y="3" width="18" height="18" rx="9"/></svg>',

        'circle-check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>',

        'compass' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><circle cx="12" cy="12" r="9"/><polygon points="14.5 9.5 13 13 9.5 14.5 11 11 14.5 9.5"/></svg>',

        'sunrise' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M6 15a6 6 0 0 1 12 0"/><line x1="12" y1="4" x2="12" y2="7"/><line x1="4.5" y1="9" x2="6.3" y2="10.3"/><line x1="19.5" y1="9" x2="17.7" y2="10.3"/><line x1="2" y1="19" x2="22" y2="19"/></svg>',

        'trending-down' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><polyline points="3 7 9 13 13 9 21 18"/><polyline points="15 18 21 18 21 12"/></svg>',

        'briefcase' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><rect x="3" y="7.5" width="18" height="12" rx="2"/><path d="M8 7.5V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1.5"/><line x1="3" y1="12.5" x2="21" y2="12.5"/></svg>',

        'graduation-cap' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5"/><line x1="22" y1="10" x2="22" y2="16"/></svg>',

        'heart-handshake' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M19 14c1.5-1 2.5-2.6 2.5-4.5a4.5 4.5 0 0 0-8.5-1.5"/><path d="M2 12a9 9 0 0 0 9 9 9 9 0 0 0 7-3.3"/><path d="M5 10a4.5 4.5 0 0 1 8.5-2.1"/><path d="m9 11 3 3 4-5"/></svg>',

        'users' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',

        'building-store' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M3 9l1-5h16l1 5"/><path d="M3 9a3 3 0 0 0 6 0 3 3 0 0 0 6 0 3 3 0 0 0 6 0"/><path d="M5 9v11h14V9"/><rect x="9" y="14" width="6" height="6"/></svg>',

        'eye' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>',

        'rocket' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M12 2.5c2.6 1.3 4.5 4.2 4.5 8 0 2-1 4-1.8 5.2l-2.7 2.8-2.7-2.8C8.5 14.5 7.5 12.5 7.5 10.5c0-3.8 1.9-6.7 4.5-8z"/><circle cx="12" cy="9.5" r="1.6"/><path d="M8.5 15.5 6 17.8c-.3.3-.5.7-.5 1.2v1.5h1.5c.5 0 .9-.2 1.2-.5l2.3-2.5"/><path d="M15.5 15.5 18 17.8c.3.3.5.7.5 1.2v1.5H17c-.5 0-.9-.2-1.2-.5l-2.3-2.5"/></svg>',

        // 'handshake' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M18.5 14.5V18a2 2 0 0 1-2 2H2.5"/><path d="M12 22.5v-6.4a3.4 3.4 0 0 0 3.4-3.4V5.6"/><path d="M12 22.5v-10.4a2 2 0 0 1 2-2h3.4"/><path d="M18.5 7.9V5.9a2 2 0 0 0-2-2H8.5a2 2 0 0 0-2 2v5.1"/><path d="M12.2 11.2H6.9a2 2 0 0 0-2 2v3.3"/><path d="M17.5 17.4 19 18.7"/><path d="M22 9.7V7.8a2 2 0 0 0-2-2h-3.3"/><path d="M19 11.5V9.5a2 2 0 0 0-2-2h-3.3"/></svg>',


        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M12 3l7 3v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V6l7-3z"/></svg>',

        'book-open' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M12 6.5c-1.6-1-3.7-1.5-5.8-1.5-.6 0-1.2.4-1.2 1v11.5c0 .6.6 1 1.2 1 2.1 0 4.2.5 5.8 1.5"/><path d="M12 6.5c1.6-1 3.7-1.5 5.8-1.5.6 0 1.2.4 1.2 1v11.5c0 .6-.6 1-1.2 1-2.1 0-4.2.5-5.8 1.5V6.5z"/></svg>',

        'brain' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M9.5 4a2.5 2.5 0 0 0-2.5 2.5v.3A2.5 2.5 0 0 0 5 9.2v1.6a2.5 2.5 0 0 0 1 2v2.7A2.5 2.5 0 0 0 8.5 18h1A2.5 2.5 0 0 0 12 15.5v-9A2.5 2.5 0 0 0 9.5 4z"/><path d="M14.5 4a2.5 2.5 0 0 1 2.5 2.5v.3a2.5 2.5 0 0 1 2 2.4v1.6a2.5 2.5 0 0 1-1 2v2.7a2.5 2.5 0 0 1-2.5 2.5h-1a2.5 2.5 0 0 1-2.5-2.5v-9A2.5 2.5 0 0 1 14.5 4z"/></svg>',

        'clipboard-list' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M8 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-2"/><line x1="9" y1="11" x2="15" y2="11"/><line x1="9" y1="15" x2="13" y2="15"/></svg>',

        'lightbulb' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><path d="M9 21h6"/><path d="M12 3a6 6 0 0 1 6 6c0 2.2-1.2 4.1-3 5.2V17a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1v-2.8C7.2 13.1 6 11.2 6 9a6 6 0 0 1 6-6z"/></svg>',

        'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',

        'star' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',

        'search' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="%1$s" width="%2$d" height="%3$d" aria-hidden="true"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',

    ];

    if (!isset($icons[$name])) {
        return '';
    }

    return sprintf($icons[$name], esc_attr($args['class']), (int) $args['width'], (int) $args['height']);
}
