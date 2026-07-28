<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the hero stats content (eyebrow + 3 stat entries + trust line).
 *
 * ACF-ready: if ACF is active and fields are populated, they override
 * these defaults. Same pattern as downside_up_get_hero_home_data().
 */
function downside_up_get_hero_stats_data()
{
    $defaults = [
        'eyebrow'    => __('Trusted by individuals and families', 'downside-up'),
        'trust_line' => __('Your privacy is our priority. All data is secure and confidential.', 'downside-up'),
        'stats'      => require get_template_directory() . '/inc/data/hero-stats.php',
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'eyebrow'    => get_field('hero_stats_eyebrow'),
        'trust_line' => get_field('hero_stats_trust_line'),
        'stats'      => get_field('hero_stats_items'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_hero_stats_data', $defaults);
}

/**
 * Formats a stat's final value for display/accessibility — same formatting
 * the JS count-up animation lands on (thousands separator via
 * number_format, wrapped in the static prefix/suffix). Used both as the
 * no-JS fallback text and as the aria-label so screen readers get the
 * correct final value once, rather than reading the animation.
 */
function downside_up_format_stat_number($value, $prefix = '', $suffix = '')
{
    return $prefix . number_format((float) $value) . $suffix;
}
