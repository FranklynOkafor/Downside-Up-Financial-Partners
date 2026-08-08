<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Testimonials data.
 *
 * NOTE ON SCOPE: this file did not exist in the theme package as
 * delivered, even though functions.php require_once's it and both
 * front-page.php and template-parts/sections/testimonials.php already
 * depend on it — so the homepage (and any other page using the
 * testimonials section) was fatal-erroring before this file was added.
 * assets/images/testimonials/ already contains three named avatar files
 * (jameson-thorne.jpg, marcus-webb.jpg, priya-anand.jpg) suggesting a
 * fuller, real 3-quote carousel was planned; no copy for those three
 * exists anywhere in the project, so nothing has been invented for them
 * here. Only the single quote explicitly given in the Contact Us page
 * brief is included below, with a placeholder-avatar fallback (the
 * carousel component already handles a missing avatar gracefully — see
 * .du-testimonials__avatar--placeholder in _testimonials.css). Whoever
 * owns testimonial content should extend the array below with the real
 * quotes/roles for those three images when available; no template
 * changes are needed to do so.
 */
function downside_up_get_testimonials()
{
    $defaults = [
        [
            'quote'   => __('The transition from confusion to clarity begins with a single conversation.', 'downside-up'),
            'name'    => __('Marcus Thorne', 'downside-up'),
            'role'    => __('Head of Advisory', 'downside-up'),
            'company' => '',
            'avatar'  => '',
        ],
    ];

    return apply_filters('downside_up_testimonials', $defaults);
}

/**
 * Resolves a testimonial's avatar filename (stored relative to
 * assets/images/testimonials/) to a full URL, or '' if none is set —
 * template-parts/sections/testimonials.php already falls back to a
 * placeholder avatar in that case.
 */
function downside_up_testimonial_avatar_url($avatar)
{
    if (empty($avatar)) {
        return '';
    }

    return get_template_directory_uri() . '/assets/images/testimonials/' . ltrim($avatar, '/');
}
