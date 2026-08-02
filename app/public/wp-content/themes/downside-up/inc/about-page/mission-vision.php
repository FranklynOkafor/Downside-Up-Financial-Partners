<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the Mission & Vision Grid content (two cards: Vision + Mission).
 *
 * Appears immediately after the Story section on the About page. Answers
 * "how do DownSide Up's beliefs shape the company" — Vision describes the
 * future being built toward, Mission describes what's actively done every
 * day to get there. Deliberately has no buttons, stats, or eyebrow beyond
 * the section heading — this is a quiet, editorial pause, not a pitch.
 *
 * ACF-ready: if ACF is active and fields are populated, they override these
 * defaults. Same pattern as downside_up_get_hero_stats_data().
 */
function downside_up_get_mission_vision_data()
{
    $defaults = [
        'heading' => __('How Our Beliefs Shape the Company', 'downside-up'),
        'cards'   => [
            'vision' => [
                'icon'    => 'eye',
                'heading' => __('Our Vision', 'downside-up'),
                'copy'    => __('To redefine wealth management as a narrative of human progress, where clarity replaces complexity and every decision is grounded in personal truth.', 'downside-up'),
            ],
            'mission' => [
                'icon'    => 'rocket',
                'heading' => __('Our Mission', 'downside-up'),
                'copy'    => __("We provide the technical precision of institutional finance combined with the intuitive clarity of a modern partner, empowering you to navigate life's downsides and upsides with confidence.", 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'heading' => get_field('mission_vision_heading'),
        'cards'   => [
            'vision' => [
                'icon'    => get_field('mission_vision_vision_icon'),
                'heading' => get_field('mission_vision_vision_heading'),
                'copy'    => get_field('mission_vision_vision_copy'),
            ],
            'mission' => [
                'icon'    => get_field('mission_vision_mission_icon'),
                'heading' => get_field('mission_vision_mission_heading'),
                'copy'    => get_field('mission_vision_mission_copy'),
            ],
        ],
    ];

    if (!empty($overrides['heading'])) {
        $defaults['heading'] = $overrides['heading'];
    }

    foreach (['vision', 'mission'] as $du_card_key) {
        foreach ($overrides['cards'][$du_card_key] as $du_field => $du_value) {
            if (!empty($du_value)) {
                $defaults['cards'][$du_card_key][$du_field] = $du_value;
            }
        }
    }

    return apply_filters('downside_up_mission_vision_data', $defaults);
}
