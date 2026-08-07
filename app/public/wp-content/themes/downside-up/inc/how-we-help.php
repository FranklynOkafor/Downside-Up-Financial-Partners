<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the homepage "How We Help" section's content — a services
 * preview that bridges to the Services page, closing with a compact
 * CTA back into the Financial Assessment.
 *
 * ACF-ready, same pattern as downside_up_get_hero_home_data() /
 * downside_up_get_assessment_engine_data(): hardcoded defaults render a
 * complete section with zero CMS content entered; ACF field values (if
 * active and populated) override them in place.
 *
 * Each service's 'featured' flag marks exactly one card (by convention,
 * the first) for the larger "primary" treatment in the bento-style grid
 * — see .du-help-card--featured in _how-we-help.css. If a CMS user
 * reorders services via ACF, featured stays tied to array position 0
 * rather than a specific title, so the layout logic never has to guess.
 *
 * Expected ACF field names (Field Group: "How We Help", on the front page):
 *   help_eyebrow, help_heading, help_description, help_services (repeater:
 *   title, description, icon, url), help_bridge_heading,
 *   help_bridge_description, help_bridge_button_text, help_bridge_button_url.
 */
function downside_up_get_how_we_help_data()
{
    $services_page_url = home_url('/services/');

    $defaults = [
        'eyebrow'     => __('How We Help', 'downside-up'),
        'heading'     => __('Financial advice for every stage of your journey.', 'downside-up'),
        'description' => __("Whether you're just starting out, growing your wealth, managing a business or preparing for retirement, our services help you make informed financial decisions with confidence.", 'downside-up'),

        'services' => [
            [
                'title'       => __('Financial Planning', 'downside-up'),
                'description' => __('Build a financial roadmap aligned with your goals, lifestyle and future ambitions.', 'downside-up'),
                'icon'        => 'compass',
                'url'         => $services_page_url . '#financial-planning',
            ],
            [
                'title'       => __('Investment Guidance', 'downside-up'),
                'description' => __('Develop an investment approach that balances opportunity with long-term stability.', 'downside-up'),
                'icon'        => 'trending-up',
                'url'         => $services_page_url . '#investment-guidance',
            ],
            [
                'title'       => __('Retirement Planning', 'downside-up'),
                'description' => __('Prepare for retirement with a strategy designed around your future income and lifestyle.', 'downside-up'),
                'icon'        => 'sunrise',
                'url'         => $services_page_url . '#retirement-planning',
            ],
            [
                'title'       => __('Debt Management', 'downside-up'),
                'description' => __('Reduce financial pressure with structured plans that help you regain control.', 'downside-up'),
                'icon'        => 'trending-down',
                'url'         => $services_page_url . '#debt-management',
            ],
            [
                'title'       => __('Wealth Preservation', 'downside-up'),
                'description' => __('Protect what you have built with strategies that guard against inflation, risk and unnecessary erosion.', 'downside-up'),
                'icon'        => 'shield-check',
                'url'         => $services_page_url . '#wealth-preservation',
            ],
            [
                'title'       => __('Estate Planning', 'downside-up'),
                'description' => __('Put a clear, legally sound plan in place for transferring what you\'ve built to the people who matter most.', 'downside-up'),
                'icon'        => 'book-open',
                'url'         => $services_page_url . '#estate-planning',
            ],
        ],

        'bridge_heading'     => __('Not sure which service is right for you?', 'downside-up'),
        'bridge_description' => __('Start with our Financial Assessment and receive personalised recommendations based on your current financial situation.', 'downside-up'),
        'bridge_button_text' => __('Start Your Financial Assessment', 'downside-up'),
        'bridge_button_url'  => home_url('/quiz/'),
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'eyebrow'             => get_field('help_eyebrow'),
        'heading'             => get_field('help_heading'),
        'description'         => get_field('help_description'),
        'services'            => get_field('help_services'),
        'bridge_heading'      => get_field('help_bridge_heading'),
        'bridge_description'  => get_field('help_bridge_description'),
        'bridge_button_text'  => get_field('help_bridge_button_text'),
        'bridge_button_url'   => get_field('help_bridge_button_url'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_how_we_help_data', $defaults);
}
