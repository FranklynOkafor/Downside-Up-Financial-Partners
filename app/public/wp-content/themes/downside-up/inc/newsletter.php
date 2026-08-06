<?php

/**
 * Newsletter component: content data + signup handling.
 * Template: template-parts/components/newsletter.php
 */

/**
 * Newsletter section content (ACF-ready, same pattern as inc/hero.php).
 */
function downside_up_get_newsletter_data()
{
    $defaults = [
        'headline'    => __('Stay ahead of the curve', 'downside-up'),
        'description' => __("Every two weeks, we deliver a distilled perspective on the markets, focusing on the 'why' rather than just the 'what'.", 'downside-up'),
        'placeholder' => __('Email address', 'downside-up'),
        'button_text' => __('Subscribe', 'downside-up'),
        'disclaimer'  => __('No spam. Only essential insights. Unsubscribe anytime.', 'downside-up'),
    ];

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $overrides = [
        'headline'    => get_field('newsletter_headline'),
        'description' => get_field('newsletter_description'),
        'placeholder' => get_field('newsletter_placeholder'),
        'button_text' => get_field('newsletter_button_text'),
        'disclaimer'  => get_field('newsletter_disclaimer'),
    ];

    foreach ($overrides as $key => $value) {
        if (!empty($value)) {
            $defaults[$key] = $value;
        }
    }

    return $defaults;
}

/**
 * Handles newsletter signup form submissions (admin-post.php).
 * Nonce-protected, honeypot spam check, stores the email, and fires
 * 'downside_up_newsletter_subscribe' so a real ESP integration (Mailchimp,
 * ConvertKit, etc.) can hook in later without any template/handler changes.
 */
function downside_up_handle_newsletter_signup()
{
    $du_redirect = wp_get_referer() ? wp_get_referer() : home_url('/');

    if (
        empty($_POST['downside_up_newsletter_nonce'])
        || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['downside_up_newsletter_nonce'])), 'downside_up_newsletter_signup')
    ) {
        wp_safe_redirect(add_query_arg('newsletter', 'error', $du_redirect));
        exit;
    }

    // Honeypot: real visitors never fill this hidden field in.
    if (!empty($_POST['du_newsletter_hp'])) {
        wp_safe_redirect(add_query_arg('newsletter', 'success', $du_redirect));
        exit;
    }

    $du_email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';

    if (empty($du_email) || !is_email($du_email)) {
        wp_safe_redirect(add_query_arg('newsletter', 'invalid', $du_redirect));
        exit;
    }

    $du_subscribers = get_option('downside_up_newsletter_subscribers', []);

    if (!in_array($du_email, $du_subscribers, true)) {
        $du_subscribers[] = $du_email;
        update_option('downside_up_newsletter_subscribers', $du_subscribers);
    }

    /**
     * Fires after a valid, de-duplicated newsletter signup.
     * Hook here to also send the email to a real email service provider.
     *
     * @param string $du_email
     */
    do_action('downside_up_newsletter_subscribe', $du_email);

    wp_safe_redirect(add_query_arg('newsletter', 'success', $du_redirect));
    exit;
}
add_action('admin_post_downside_up_newsletter_signup', 'downside_up_handle_newsletter_signup');
add_action('admin_post_nopriv_downside_up_newsletter_signup', 'downside_up_handle_newsletter_signup');
