<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns data for the How It Works Hero section.
 */
function downside_up_get_how_it_works_hero_data()
{
    $defaults = [
        'eyebrow'              => __('Interpretation Beats Calculation', 'downside-up'),
        'headline_line1'       => __('Understand the Flow', 'downside-up'),
        'headline_line2'       => __('Behind Your Wealth', 'downside-up'),
        'description'          => __('Our assessment transforms raw financial data into a living map of movement, value, and trust. We don\'t just calculate numbers; we interpret your unique financial narrative.', 'downside-up'),
        'primary_button_text'  => __('Begin Journey', 'downside-up'),
        'primary_button_url'   => home_url('/assessment/'),
        'secondary_button_text'=> __('Explore the Engine', 'downside-up'),
        'secondary_button_url' => '#assessment-engine',
        'dashboard_label'      => __('Real-time Portfolio Health', 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_how_it_works_hero_data', $defaults);
    }

    $overrides = [
        'eyebrow'              => get_field('hiw_hero_eyebrow'),
        'headline_line1'       => get_field('hiw_hero_headline_line1'),
        'headline_line2'       => get_field('hiw_hero_headline_line2'),
        'description'          => get_field('hiw_hero_description'),
        'primary_button_text'  => get_field('hiw_hero_primary_button_text'),
        'primary_button_url'   => get_field('hiw_hero_primary_button_url'),
        'secondary_button_text'=> get_field('hiw_hero_secondary_button_text'),
        'secondary_button_url' => get_field('hiw_hero_secondary_button_url'),
        'dashboard_label'      => get_field('hiw_hero_dashboard_label'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_how_it_works_hero_data', $defaults);
}

/**
 * Returns data for the Three Pillars of Discovery section.
 */
function downside_up_get_how_it_works_pillars()
{
    $defaults = [
        'heading'     => __('The Three Pillars of Discovery', 'downside-up'),
        'description' => __('A structured path from uncertainty to absolute clarity in your financial standing.', 'downside-up'),
        'pillars'     => [
            [
                'icon'        => 'clipboard-list',
                'title'       => __('1. Assess', 'downside-up'),
                'description' => __('Participate in our \'One-Question-at-a-Time\' flow designed to capture not just your balance sheet, but your intent and appetite for risk.', 'downside-up'),
            ],
            [
                'icon'        => 'compass',
                'title'       => __('2. Understand', 'downside-up'),
                'description' => __('Our engine translates data into clear metrics, visualizing your standing with intuitive financial gauges and reality checks.', 'downside-up'),
            ],
            [
                'icon'        => 'rocket',
                'title'       => __('3. Act', 'downside-up'),
                'description' => __('Receive a custom roadmap with specific advisory interventions, transforming insights into immediate wealth protection and growth.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_how_it_works_pillars_data', $defaults);
    }

    $overrides = [
        'heading'     => get_field('hiw_pillars_heading'),
        'description' => get_field('hiw_pillars_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    if (have_rows('hiw_pillars')) {
        $pillars = [];
        while (have_rows('hiw_pillars')) {
            the_row();
            $pillars[] = [
                'icon'        => get_sub_field('icon'),
                'title'       => get_sub_field('title'),
                'description' => get_sub_field('description'),
            ];
        }
        if (!empty($pillars)) {
            $defaults['pillars'] = $pillars;
        }
    }

    return apply_filters('downside_up_how_it_works_pillars_data', $defaults);
}

/**
 * Returns data for the Assessment Engine section of the How It Works page.
 */
function downside_up_get_how_it_works_assessment_data()
{
    $defaults = [
        'heading_line1'       => __('The Assessment Engine', 'downside-up'),
        'heading_line2'       => __('Algorithm Meets Narrative.', 'downside-up'),
        'description'         => __('Precision logic meets human narratives. Our algorithm weightings are adjusted in real-time based on your responses, ensuring every journey is unique.', 'downside-up'),
        'checklist'           => [
            __('Dynamic weighing models adapt instantly.', 'downside-up'),
            __('Identifies correlations standard calculators miss.', 'downside-up'),
            __('Generates stress-test scenarios on demand.', 'downside-up'),
        ],
        'cta_text'            => __('Run Your Engine', 'downside-up'),
        'cta_url'             => home_url('/assessment/'),
        'metrics'             => [
            [
                'label'   => __('Liquid Resilience', 'downside-up'),
                'status'  => 'healthy',
                'value'   => 82,
                'insight' => __('Measures your immediate ability to withstand shocks. Calculated using the Lardelli-to-Resilience ratio, ensuring you maintain a safety buffer without sacrificing growth.', 'downside-up'),
            ],
            [
                'label'   => __('Velocity Tracking', 'downside-up'),
                'status'  => 'fragile',
                'value'   => 45,
                'insight' => __('Pinpoints the speed of your wealth accumulation versus current liabilities, forecasting future limits.', 'downside-up'),
            ],
            [
                'label'   => __('Risk Aperture', 'downside-up'),
                'status'  => 'critical',
                'value'   => 24,
                'insight' => __('The balance of protective actions versus growth-seeking risk, showing whether your investments match your plans.', 'downside-up'),
            ],
        ],
        'reality_check_title' => __('The Reality Check Slider', 'downside-up'),
        'reality_check_text'  => __('Manipulate assumptions like inflation, tax rates, and lifespan in real-time to see how long your current plan will truly last.', 'downside-up'),
        'reality_check_label' => __('Inflation Vector', 'downside-up'),
        'reality_check_value' => 5.2,
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_how_it_works_assessment_data', $defaults);
    }

    $overrides = [
        'heading_line1'       => get_field('hiw_assess_heading_line1'),
        'heading_line2'       => get_field('hiw_assess_heading_line2'),
        'description'         => get_field('hiw_assess_description'),
        'checklist'           => get_field('hiw_assess_checklist'),
        'cta_text'            => get_field('hiw_assess_cta_text'),
        'cta_url'             => get_field('hiw_assess_cta_url'),
        'metrics'             => get_field('hiw_assess_metrics'),
        'reality_check_title' => get_field('hiw_assess_reality_title'),
        'reality_check_text'  => get_field('hiw_assess_reality_text'),
        'reality_check_label' => get_field('hiw_assess_reality_label'),
        'reality_check_value' => get_field('hiw_assess_reality_value'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_how_it_works_assessment_data', $defaults);
}

/**
 * Returns data for the comparison section (Why Our Method Is Different).
 */
function downside_up_get_how_it_works_comparison_data()
{
    $defaults = [
        'eyebrow'     => __('Methodology Comparison', 'downside-up'),
        'heading'     => __('Why Our Method Is Different', 'downside-up'),
        'description' => __('How DownSide Up compares to standard planning models across execution, depth, and clarity.', 'downside-up'),
        'columns'     => [
            [
                'id'         => 'advisor',
                'title'      => __('Traditional Advisor', 'downside-up'),
                'icon'       => 'users',
                'highlight'  => false,
                'features'   => [
                    __('Static annual reviews', 'downside-up'),
                    __('Averages-based asset allocation', 'downside-up'),
                    __('High asset under management fees', 'downside-up'),
                    __('Subjective, non-verifiable logic', 'downside-up'),
                ],
            ],
            [
                'id'         => 'calculator',
                'title'      => __('Financial Calculator', 'downside-up'),
                'icon'       => 'clipboard-list',
                'highlight'  => false,
                'features'   => [
                    __('Instant but rigid inputs', 'downside-up'),
                    __('Pure linear projections (no volatility)', 'downside-up'),
                    __('Ignores major real-world risk scenarios', 'downside-up'),
                    __('No personalized advisory overlay', 'downside-up'),
                ],
            ],
            [
                'id'         => 'assessment',
                'title'      => __('DownSide Up Assessment', 'downside-up'),
                'icon'       => 'reality-check',
                'highlight'  => true,
                'tag'        => __('Proprietary Method', 'downside-up'),
                'features'   => [
                    __('Real-time adaptive weighting models', 'downside-up'),
                    __('Comprehensive volatility & tax stress tests', 'downside-up'),
                    __('Flat, transparent fee structure', 'downside-up'),
                    __('Empathetic, math-backed advisory roadmap', 'downside-up'),
                ],
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_how_it_works_comparison_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('hiw_compare_eyebrow'),
        'heading'     => get_field('hiw_compare_heading'),
        'description' => get_field('hiw_compare_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_how_it_works_comparison_data', $defaults);
}

/**
 * Returns data for the Privacy Section.
 */
function downside_up_get_how_it_works_privacy_data()
{
    $defaults = [
        'eyebrow'     => __('Uncompromising Privacy', 'downside-up'),
        'heading'     => __('Your Data Stays Yours.', 'downside-up'),
        'description' => __('We understand that financial details are deeply personal. Our platform is built from the ground up to protect your privacy and guarantee safety.', 'downside-up'),
        'features'    => [
            [
                'icon'        => 'shield',
                'title'       => __('Zero-Knowledge Protocols', 'downside-up'),
                'description' => __('Your data is encrypted at the source. Our advisors only see aggregated metrics, not your raw account details unless you grant explicit temporary access.', 'downside-up'),
            ],
            [
                'icon'        => 'shield-check',
                'title'       => __('Bank-Level Safeguards', 'downside-up'),
                'description' => __('We utilize 256-bit AES encryption and regular third-party audits to ensure your financial footprint remains yours alone.', 'downside-up'),
            ],
            [
                'icon'        => 'check', 
                'title'       => __('No Data Harvesting', 'downside-up'),
                'description' => __('Our business model is built on advisory fees, not selling data. Your inputs are never shared with advertisers or third-party brokers.', 'downside-up'),
            ],
        ],
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_how_it_works_privacy_data', $defaults);
    }

    $overrides = [
        'eyebrow'     => get_field('hiw_privacy_eyebrow'),
        'heading'     => get_field('hiw_privacy_heading'),
        'description' => get_field('hiw_privacy_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_how_it_works_privacy_data', $defaults);
}

/**
 * Returns data for the closing CTA section.
 */
function downside_up_get_how_it_works_cta_data()
{
    $defaults = [
        'heading'             => __('Ready to see your map?', 'downside-up'),
        'description'         => __('The average assessment takes 7 minutes. The clarity lasts for years.', 'downside-up'),
        'primary_button_text' => __('Start Your Assessment', 'downside-up'),
        'primary_button_url'  => home_url('/assessment/'),
        'secondary_button_text'=> __('Download Sample Report', 'downside-up'),
        'secondary_button_url'=> home_url('/sample-report.pdf'), 
        'supporting_text'     => __('Join 12,000+ high-net-worth individuals who trust DownSide Up.', 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return apply_filters('downside_up_how_it_works_cta_data', $defaults);
    }

    $overrides = [
        'heading'             => get_field('hiw_cta_heading'),
        'description'         => get_field('hiw_cta_description'),
        'primary_button_text' => get_field('hiw_cta_primary_button_text'),
        'primary_button_url'  => get_field('hiw_cta_primary_button_url'),
        'secondary_button_text'=> get_field('hiw_cta_secondary_button_text'),
        'secondary_button_url'=> get_field('hiw_cta_secondary_button_url'),
        'supporting_text'     => get_field('hiw_cta_supporting_text'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_how_it_works_cta_data', $defaults);
}
