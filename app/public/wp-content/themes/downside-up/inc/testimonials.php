<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns all testimonials.
 *
 * Currently backed by the placeholder array in inc/data/testimonials.php.
 * To switch to a custom post type or ACF later: replace the body of this
 * function with a WP_Query / get_field() call that returns the same shape
 * (quote, name, role, company, avatar) — template-parts/sections/testimonials.php
 * never needs to change.
 */
function downside_up_get_testimonials()
{
    static $testimonials = null;

    if (null === $testimonials) {
        $testimonials = require get_template_directory() . '/inc/data/testimonials.php';
        $testimonials = apply_filters('downside_up_testimonials', $testimonials);
    }

    return $testimonials;
}

/**
 * Resolves a testimonial's avatar to a full URL.
 * Placeholder-friendly: falls back gracefully if the file doesn't exist
 * yet rather than rendering a broken image.
 */
function downside_up_testimonial_avatar_url($filename)
{
    if (empty($filename)) {
        return '';
    }

    $path = get_template_directory() . '/assets/images/testimonials/' . $filename;

    if (!file_exists($path)) {
        return '';
    }

    return get_template_directory_uri() . '/assets/images/testimonials/' . $filename;
}
