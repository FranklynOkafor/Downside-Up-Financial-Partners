<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Assessment Engine section content.
 *
 * Outcome-focused messaging throughout: every data point here answers a
 * real financial question a visitor might ask themselves, not a technical
 * metric name. The template (template-parts/sections/assessment-engine.php)
 * is structure-only — all copy lives here and can be overridden via ACF
 * without touching any markup.
 *
 * Data shape consumed by the template:
 *   heading_line1         string
 *   heading_line2         string
 *   description           string
 *   checklist             string[]
 *   cta_text              string
 *   cta_url               string
 *   metrics               array of { label, status, value, insight }
 *   reality_check_title   string
 *   reality_check_text    string
 *   reality_check_progress int  (0–100)
 */
function downside_up_get_assessment_engine_data() {

    $defaults = [

        /* ---- Left column ---- */
        'heading_line1' => __( 'Understand Your Financial Health', 'downside-up' ),
        'heading_line2' => __( 'Before Making Your Next Move.', 'downside-up' ),

        'description' => __( 'Our assessment reveals where you stand across every dimension of your financial life — uncovering hidden strengths, identifying risks you may not know exist, and giving you a clear picture of what to prioritise next.', 'downside-up' ),

        'checklist' => [
            __( 'Discover financial blind spots before they become costly.', 'downside-up' ),
            __( 'Understand your strengths and areas for improvement.', 'downside-up' ),
            __( 'Receive practical recommendations tailored to your situation.', 'downside-up' ),
            __( 'Build a clearer roadmap towards your financial goals.', 'downside-up' ),
        ],

        'cta_text' => __( 'Begin My Assessment', 'downside-up' ),
        'cta_url'  => home_url( '/quiz/' ),

        /* ---- Right column: metric cards ----
           'label'   — the question the metric answers (outcome-first)
           'status'  — maps to semantic token: healthy / fragile / critical
           'value'   — numeric score (0–100) used by the gauge animation
           'insight' — plain-language interpretation of the score
        */
        'metrics' => [
            [
                'label'   => __( 'Emergency Readiness', 'downside-up' ),
                'status'  => 'healthy',
                'value'   => 82,
                'insight' => __( 'Could you comfortably cover an unexpected expense?', 'downside-up' ),
            ],
            [
                'label'   => __( 'Investment Risk', 'downside-up' ),
                'status'  => 'fragile',
                'value'   => 48,
                'insight' => __( 'Are your investments aligned with your comfort level?', 'downside-up' ),
            ],
            [
                'label'   => __( 'Financial Protection', 'downside-up' ),
                'status'  => 'critical',
                'value'   => 24,
                'insight' => __( 'How resilient would your finances be during a difficult period?', 'downside-up' ),
            ],
        ],

        /* ---- Reality Check card ---- */
        'reality_check_title'    => __( 'Reality Check™', 'downside-up' ),
        'reality_check_text'     => __( 'Explore realistic financial scenarios — job loss, market drops, major expenses — before they happen, so you can make decisions with confidence rather than uncertainty.', 'downside-up' ),
        'reality_check_progress' => 35,

    ];

    if ( ! function_exists( 'get_field' ) ) {
        return apply_filters( 'downside_up_assessment_engine_data', $defaults );
    }

    $overrides = [
        'heading_line1'           => get_field( 'assessment_heading_line1' ),
        'heading_line2'           => get_field( 'assessment_heading_line2' ),
        'description'             => get_field( 'assessment_description' ),
        'checklist'               => get_field( 'assessment_checklist' ),
        'cta_text'                => get_field( 'assessment_cta_text' ),
        'cta_url'                 => get_field( 'assessment_cta_url' ),
        'metrics'                 => get_field( 'assessment_metrics' ),
        'reality_check_title'     => get_field( 'assessment_reality_check_title' ),
        'reality_check_text'      => get_field( 'assessment_reality_check_text' ),
        'reality_check_progress'  => get_field( 'assessment_reality_check_progress' ),
    ];

    foreach ( $overrides as $key => $value ) {
        if ( ! empty( $value ) ) {
            $defaults[ $key ] = $value;
        }
    }

    return apply_filters( 'downside_up_assessment_engine_data', $defaults );
}

/**
 * Maps a card's 'status' key to its human-readable badge label.
 * Called by the template for every metric card.
 */
function downside_up_assessment_status_label( $status ) {
    $labels = [
        'success'  => __( 'Excellent', 'downside-up' ),
        'healthy'  => __( 'Healthy', 'downside-up' ),
        'fragile'  => __( 'Review', 'downside-up' ),
        'critical' => __( 'At Risk', 'downside-up' ),
    ];

    return isset( $labels[ $status ] ) ? $labels[ $status ] : ucfirst( $status );
}
