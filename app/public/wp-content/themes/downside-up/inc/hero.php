<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the hero's content.
 *
 * ACF-ready: if Advanced Custom Fields is active and fields have been
 * populated on the front page, their values override these defaults —
 * nothing here needs to change when ACF fields are wired up later.
 * Without ACF (or with empty fields), it falls back to the copy from the
 * homepage mockup, so the hero always renders something sensible.
 *
 * Expected ACF field names (Field Group: "Homepage Hero", on the front page):
 *   hero_headline_line1, hero_headline_line2, hero_headline_emphasis,
 *   hero_description, hero_primary_button_text, hero_primary_button_url,
 *   hero_secondary_button_text, hero_secondary_button_url,
 *   hero_trust_label, hero_partners (repeater or textarea of names),
 *   hero_image_alt
 */
function downside_up_get_hero_home_data()
{
    $defaults = [
        // 'eyebrow'               => __('Personalised Financial Planning & Wealth Advisory', 'downside-up'),
        'headline_line1'        => __('Financial Planning', 'downside-up'),
        'headline_line2'        => __('Made', 'downside-up'),
        'headline_emphasis'     => __('Simple.', 'downside-up'),
        'description'           => __("Understand where you stand financially and receive personalised guidance to help you build, protect, and grow your wealth.", 'downside-up'),
        'primary_button_text'   => __('Start Your Assessment', 'downside-up'),
        'primary_button_url'    => home_url('/quiz/'),
        'secondary_button_text' => __('Learn More', 'downside-up'),
        'secondary_button_url'  => home_url('/about/'),
        'trust_indicators'      => [
            __('Secure & Confidential', 'downside-up'),
            __('Personalised Recommendations', 'downside-up'),
            __('Takes Under 10 Minutes', 'downside-up'),
        ],
        'social_proof'          => __('Trusted by 1,500+ individuals and families', 'downside-up'),
        'dashboard_label'       => __('Example Financial Health Report', 'downside-up'),
        'trust_label'           => __('Trusted by leading institutional partners', 'downside-up'),
        'partners'              => ['Fortuna', 'AlphaVest', 'Novacore', 'Quantum', 'Meridian'],
        'image_alt'             => __('DownSide Up dashboard showing a financial health score of 82, labeled Healthy, alongside supporting metric gauges.', 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'eyebrow'               => get_field('hero_eyebrow'),
        'headline_line1'        => get_field('hero_headline_line1'),
        'headline_line2'        => get_field('hero_headline_line2'),
        'headline_emphasis'     => get_field('hero_headline_emphasis'),
        'description'           => get_field('hero_description'),
        'primary_button_text'   => get_field('hero_primary_button_text'),
        'primary_button_url'    => get_field('hero_primary_button_url'),
        'secondary_button_text' => get_field('hero_secondary_button_text'),
        'secondary_button_url'  => get_field('hero_secondary_button_url'),
        'trust_indicators'      => get_field('hero_trust_indicators'),
        'social_proof'          => get_field('hero_social_proof'),
        'dashboard_label'       => get_field('hero_dashboard_label'),
        'trust_label'           => get_field('hero_trust_label'),
        'partners'              => get_field('hero_partners'),
        'image_alt'             => get_field('hero_image_alt'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return $defaults;
}


function downside_up_get_hero_about_data()
{
    $defaults = [
        'eyebrow'               => __('OUR PHILOSOPHY', 'downside-up'),
        'headline_line1'        => __('Before Numbers', 'downside-up'),
        'headline_line2'        => __('Comes', 'downside-up'),
        'headline_emphasis'     => __('People.', 'downside-up'),
        'description'           => __("Traditional finance often starts with products, projections, and performance. We start somewhere different: understanding the person behind the portfolio. Because better financial decisions begin with better conversations.", 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'eyebrow'               => get_field('about_hero_eyebrow'),
        'headline_line1'        => get_field('about_hero_headline_line1'),
        'headline_line2'        => get_field('about_hero_headline_line2'),
        'headline_emphasis'     => get_field('about_hero_headline_emphasis'),
        'description'           => get_field('about_hero_description'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return $defaults;
}


function downside_up_get_hero_resources_data()
{
    $defaults = [
        'headline'    => __('Knowledge Library', 'downside-up'),
        'description' => __('Interpretation beats calculation. Discover insights tailored to your specific financial lifecycle.', 'downside-up'),
        'search_placeholder' => __('Search insights…', 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'headline'           => get_field('resources_hero_headline'),
        'description'        => get_field('resources_hero_description'),
        'search_placeholder' => get_field('resources_hero_search_placeholder'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return $defaults;
}

/**
 * Returns the About Page story Section
 */

function downside_up_get_story_data()
{
    $defaults = [
        'eyebrow' => __('Our Story', 'downside-up'),
        'heading' => __('A Different Starting Point.', 'downside-up'),
        'paragraphs' => [
            __('DownSide Up began with a simple observation: most financial advice starts too late. By the time portfolios are reviewed and strategies are discussed, the most important part of the conversation has already been overlooked—the person making the decisions. We believed there had to be a better place to begin.', 'downside-up'),
            __("Instead of asking what to invest in first, we ask what matters most to the individual behind the portfolio. Their goals, uncertainties, habits, and perspective shape every recommendation that follows. That belief became the foundation of our Reality Check™ approach, where understanding people isn't an introduction to financial planning—it's the plan itself.", 'downside-up')
        ],
        'image_url'  => get_template_directory_uri() . '/assets/images/Editorial story.jpg',
        'image_alt'  => __('A team gathered around a table reviewing financial charts and discussing strategy together.', 'downside-up'),

    ];

    if (! function_exists('get_field')) {
        return apply_filters('downside_up_story_data', $defaults);
    }

    $overrides = [
        'eyebrow'    => get_field('story_eyebrow'),
        'heading'    => get_field('story_heading'),
        'paragraphs' => get_field('story_paragraphs'),
        'image_url'  => (get_field('story_image')) ? get_field('story_image')['url'] : null,
        'image_alt'  => (get_field('story_image')) ? get_field('story_image')['alt'] : null,
    ];

    foreach ($overrides as $key => $value) {
        if (! empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return apply_filters('downside_up_story_data', $defaults);
}
