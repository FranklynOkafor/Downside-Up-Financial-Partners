<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the Core Principles Grid content — heading, description, and the
 * three principles that shape every client interaction.
 *
 * Sits directly after Mission & Vision. Where Mission & Vision answered
 * "how do our beliefs shape the company," this answers "what principles
 * guide every recommendation" — a direct, practical follow-through, not a
 * restatement. Deliberately no links/buttons/stats per card.
 *
 * ACF-ready: if ACF is active and fields are populated, they override these
 * defaults. Same pattern as downside_up_get_how_we_help_data().
 */
function downside_up_get_core_principles_data()
{
    $defaults = [
        'heading'     => __('Core Principles', 'downside-up'),
        'description' => __("Our values aren't just words; they are the filters through which we view every investment and every relationship.", 'downside-up'),
        'principles'  => [
            [
                'icon'        => 'book-open',
                'title'       => __('Radical Clarity', 'downside-up'),
                'description' => __('We strip away the jargon to reveal the underlying story of your capital.', 'downside-up'),
            ],
            [
                'icon'        => 'brain',
                'title'       => __('Empathetic Logic', 'downside-up'),
                'description' => __('We pair rigorous analysis with a deep understanding of human behavior and goals.', 'downside-up'),
            ],
            [
                'icon'        => 'shield',
                'title'       => __('Preservation First', 'downside-up'),
                'description' => __('Growth is essential, but understanding your downside is the key to lasting wealth.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $du_overrides_heading     = get_field('core_principles_heading');
    $du_overrides_description = get_field('core_principles_description');

    if (!empty($du_overrides_heading)) {
        $defaults['heading'] = $du_overrides_heading;
    }

    if (!empty($du_overrides_description)) {
        $defaults['description'] = $du_overrides_description;
    }

    if (have_rows('core_principles')) {
        $du_principles = [];

        while (have_rows('core_principles')) {
            the_row();

            $du_principles[] = [
                'icon'        => get_sub_field('icon'),
                'title'       => get_sub_field('title'),
                'description' => get_sub_field('description'),
            ];
        }

        if (!empty($du_principles)) {
            $defaults['principles'] = $du_principles;
        }
    }

    return apply_filters('downside_up_core_principles_data', $defaults);
}
