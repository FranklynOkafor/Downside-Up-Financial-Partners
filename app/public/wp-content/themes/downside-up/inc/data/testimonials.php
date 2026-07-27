<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Placeholder testimonial content.
 *
 * Pure data — no markup, no logic. This is a stand-in for a future data
 * source (custom post type, ACF repeater, etc.) — see inc/testimonials.php
 * for where that swap happens. The template
 * (template-parts/sections/testimonials.php) only ever calls
 * downside_up_get_testimonials(), so switching the source later needs no
 * template changes.
 *
 * 'avatar' is a filename expected under assets/images/testimonials/ —
 * swap for an attachment ID once these are real, editor-managed entries.
 */
return [

    [
        'quote'   => __("The 'Reality Check' simulation changed how I look at my business equity. It's the first time a financial tool felt like it was speaking my language, not just reciting data points.", 'downside-up'),
        'name'    => __('Jameson Thorne', 'downside-up'),
        'role'    => __('Founder', 'downside-up'),
        'company' => __('Thorne Logistics', 'downside-up'),
        'avatar'  => 'jameson-thorne.jpg',
    ],

    [
        'quote'   => __("Seeing our retirement readiness score alongside a clear action plan, instead of a wall of spreadsheets, is what finally got both of us to take it seriously.", 'downside-up'),
        'name'    => __('Priya Anand', 'downside-up'),
        'role'    => __('Physician', 'downside-up'),
        'company' => __('Anand Family Practice', 'downside-up'),
        'avatar'  => 'priya-anand.jpg',
    ],

    [
        'quote'   => __("I've used three other advisory platforms before this one. None of them told me what to actually do next. DownSide Up did, in the first session.", 'downside-up'),
        'name'    => __('Marcus Webb', 'downside-up'),
        'role'    => __('VP of Operations', 'downside-up'),
        'company' => __('Fortuna Retail Group', 'downside-up'),
        'avatar'  => 'marcus-webb.jpg',
    ],

];
