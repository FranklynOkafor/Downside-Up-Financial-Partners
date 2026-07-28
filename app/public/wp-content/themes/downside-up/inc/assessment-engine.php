<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the homepage "Assessment Engine" section's content.
 *
 * ACF-ready, same pattern as downside_up_get_hero_home_data() and
 * downside_up_get_hero_stats_data(): hardcoded defaults render a complete,
 * correct section with zero CMS content entered; if ACF is active and its
 * fields are populated, their values override these defaults in place.
 *
 * 'metrics' holds the three gauge cards. Each metric's 'status' key must be
 * one of 'healthy' | 'fragile' | 'critical' — these map directly to the
 * --healthy / --fragile / --critical tokens in _variable.css and to the
 * .du-gauge__value--{status} modifier classes in _assessment-engine.css,
 * so adding a metric never requires touching CSS.
 *
 * Expected ACF field names (Field Group: "Assessment Engine", on the front
 * page): assessment_eyebrow, assessment_heading_line1, assessment_heading_line2,
 * assessment_description, assessment_checklist (repeater/textarea),
 * assessment_cta_text, assessment_cta_url, assessment_metrics (repeater:
 * label, status, value, insight), assessment_reality_check_title,
 * assessment_reality_check_text, assessment_reality_check_progress.
 */
function downside_up_get_assessment_engine_data()
{
    $defaults = [
        'heading_line1'   => __('The DownSide', 'downside-up'),
        'heading_line2'   => __('Assessment Engine', 'downside-up'),
        'description'     => __('Our proprietary engine evaluates your financial position across 5 core dimensions with institutional precision.', 'downside-up'),
        'checklist'       => [
            __('Stress-test against market volatility.', 'downside-up'),
            __("Identify 'Fragile' zones early.", 'downside-up'),
        ],
        'cta_text'        => __('Begin Assessment', 'downside-up'),
        'cta_url'         => home_url('/quiz/'),

        'metrics'         => [
            [
                'label'   => __('Liquidity Ratio', 'downside-up'),
                'status'  => 'healthy',
                'value'   => 82,
                'insight' => __('Optimally positioned for immediate opportunities.', 'downside-up'),
            ],
            [
                'label'   => __('Market Exposure', 'downside-up'),
                'status'  => 'fragile',
                'value'   => 48,
                'insight' => __('High concentration in volatile growth assets.', 'downside-up'),
            ],
            [
                'label'   => __('Downside Protection', 'downside-up'),
                'status'  => 'critical',
                'value'   => 24,
                'insight' => __('Lacking adequate hedging for a 10% dip.', 'downside-up'),
            ],
        ],

        'reality_check_title'    => __('Reality Check™', 'downside-up'),
        'reality_check_text'     => __('Simulate market events in real-time.', 'downside-up'),
        'reality_check_progress' => 20,
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'heading_line1'           => get_field('assessment_heading_line1'),
        'heading_line2'           => get_field('assessment_heading_line2'),
        'description'             => get_field('assessment_description'),
        'checklist'               => get_field('assessment_checklist'),
        'cta_text'                => get_field('assessment_cta_text'),
        'cta_url'                 => get_field('assessment_cta_url'),
        'metrics'                 => get_field('assessment_metrics'),
        'reality_check_title'     => get_field('assessment_reality_check_title'),
        'reality_check_text'      => get_field('assessment_reality_check_text'),
        'reality_check_progress'  => get_field('assessment_reality_check_progress'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_assessment_engine_data', $defaults);
}

/**
 * Maps a metric's status to its display label. Centralized here (rather
 * than hardcoded in the template) so the mapping is translation-ready and
 * only lives in one place.
 */
function downside_up_assessment_status_label($status)
{
    $labels = [
        'healthy'  => __('Healthy', 'downside-up'),
        'fragile'  => __('Fragile', 'downside-up'),
        'critical' => __('Critical', 'downside-up'),
    ];

    return isset($labels[$status]) ? $labels[$status] : ucfirst($status);
}
