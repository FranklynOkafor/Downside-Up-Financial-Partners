<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns all CTA personas, keyed by slug.
 * Loaded once per request and cached in a static var.
 */
function downside_up_get_cta_personas()
{
    static $personas = null;

    if (null === $personas) {
        $personas = require get_template_directory() . '/inc/cta/cta-personas.php';

        /**
         * Allows other code (a plugin, ACF field group, etc.) to filter or
         * extend the persona list without touching this file.
         */
        $personas = apply_filters('downside_up_cta_personas', $personas);
    }

    return $personas;
}

/**
 * Returns a single persona's data, or null if the key doesn't exist.
 */
function downside_up_get_cta_persona($persona_key)
{
    $personas = downside_up_get_cta_personas();

    return isset($personas[$persona_key]) ? $personas[$persona_key] : null;
}

/**
 * Builds the "Start Assessment" URL for a given persona, tagged with
 * ?persona=<slug> so the assessment engine can branch/pre-fill by persona.
 */
function downside_up_cta_assessment_url($persona_key)
{
    $url = home_url('/quiz/');

    return add_query_arg('persona', sanitize_title($persona_key), $url);
}

/**
 * Public entry point for placing a CTA anywhere in the theme.
 *
 * downside_up_cta();                          -> full rotating carousel (all personas)
 * downside_up_cta( 'small-business-owner' );   -> single static CTA for that persona
 *
 * Use the carousel only on broad-entry pages (Home, About, Resources, Blog,
 * landing pages). Use a single persona CTA on pages that already know their
 * audience (e.g. a "For Small Business Owners" service page).
 */
function downside_up_cta($persona_key = null)
{
    if ($persona_key) {
        if (!downside_up_get_cta_persona($persona_key)) {
            return;
        }

        get_template_part('template-parts/cta/cta-card', null, [
            'persona_key' => $persona_key,
        ]);

        return;
    }

    get_template_part('template-parts/cta/cta-carousel');
}
