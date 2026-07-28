<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Hero statistics content.
 *
 * 'value' is the raw number the count-up animates to; 'prefix'/'suffix'
 * are static strings the JS wraps around the formatted number
 * (assets/js/stat-counter.js) — kept separate from 'value' so the
 * thousands-separator formatting during animation stays correct
 * (e.g. "£" + "1,500" + "+", not "£1,500+" parsed back apart).
 */
return [

    [
        'icon'    => 'people',
        'value'   => 1500,
        'prefix'  => '',
        'suffix'  => '+',
        'label'   => __('Financial Assessments Completed', 'downside-up'),
    ],

    [
        'icon'    => 'shield-check',
        'value'   => 95,
        'prefix'  => '',
        'suffix'  => '%',
        'label'   => __('Clients Report Greater Financial Confidence', 'downside-up'),
    ],

    [
        'icon'    => 'trending-up',
        'value'   => 50,
        'prefix'  => '₦',
        'suffix'  => 'B+',
        'label'   => __('Assets Guided Through Strategic Planning', 'downside-up'),
    ],

];
