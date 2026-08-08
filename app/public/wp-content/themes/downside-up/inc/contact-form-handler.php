<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Direct Inquiry (Contact Us) form — submission handling.
 *
 * Architecture (no existing AJAX/mail infrastructure was found anywhere in
 * the theme during inspection — the newsletter signup component is the
 * closest precedent and uses a plain admin-post.php POST, so that pattern
 * is reused here as the no-JS fallback, layered underneath a proper
 * wp_ajax_* endpoint for the JS-enhanced experience the brief asks for):
 *
 *   template-parts/contact/contact-form.php (markup + nonce + honeypot)
 *     |
 *     |-- JS enabled:  assets/js/contact-form.js intercepts submit,
 *     |                 fetch()es admin-ajax.php?action=downside_up_contact_submit,
 *     |                 gets JSON back, renders loading/success/error states
 *     |                 in place (no reload).
 *     |
 *     '-- No JS:        native form POST to admin-post.php, same
 *                        'action' value, handled by the admin_post_* hooks
 *                        below, then a redirect back to the page with a
 *                        ?contact=success|error|invalid query flag.
 *
 * Both paths call the same downside_up_process_contact_submission() so
 * validation/sanitization/spam-checking/mail-sending logic exists in
 * exactly one place.
 */

const DOWNSIDE_UP_CONTACT_ACTION   = 'downside_up_contact_submit';
const DOWNSIDE_UP_CONTACT_NONCE    = 'downside_up_contact_nonce';
const DOWNSIDE_UP_CONTACT_HONEYPOT = 'du_contact_hp';

/**
 * Registers the AJAX + admin-post endpoints (both logged-in and
 * logged-out — this form is public).
 */
function downside_up_register_contact_form_endpoints()
{
    add_action('wp_ajax_' . DOWNSIDE_UP_CONTACT_ACTION, 'downside_up_handle_contact_ajax');
    add_action('wp_ajax_nopriv_' . DOWNSIDE_UP_CONTACT_ACTION, 'downside_up_handle_contact_ajax');

    add_action('admin_post_' . DOWNSIDE_UP_CONTACT_ACTION, 'downside_up_handle_contact_admin_post');
    add_action('admin_post_nopriv_' . DOWNSIDE_UP_CONTACT_ACTION, 'downside_up_handle_contact_admin_post');
}
add_action('init', 'downside_up_register_contact_form_endpoints');

/**
 * AJAX endpoint. Always responds with JSON (wp_send_json_*), including on
 * validation failure, so the frontend can show field-level errors without
 * a page reload.
 */
function downside_up_handle_contact_ajax()
{
    $result = downside_up_process_contact_submission($_POST);

    if (!$result['success']) {
        wp_send_json_error([
            'message' => $result['message'],
            'errors'  => $result['errors'],
        ], 400);
    }

    wp_send_json_success([
        'message' => $result['message'],
    ]);
}

/**
 * No-JS fallback endpoint. Redirects back to where the form was submitted
 * from, with a status flag in the query string — same UX pattern as the
 * existing newsletter signup handler.
 */
function downside_up_handle_contact_admin_post()
{
    $result = downside_up_process_contact_submission($_POST);

    $redirect = wp_get_referer();
    if (!$redirect) {
        $redirect = home_url('/');
    }

    if (!$result['success']) {
        $status = ('invalid_nonce' === $result['code'] || 'spam' === $result['code']) ? 'error' : 'invalid';
        $redirect = add_query_arg('contact', $status, $redirect);
        wp_safe_redirect($redirect . '#du-contact-form');
        exit;
    }

    $redirect = add_query_arg('contact', 'success', $redirect);
    wp_safe_redirect($redirect . '#du-contact-form');
    exit;
}

/**
 * Shared validation + sanitization + spam-check + mail-sending logic.
 *
 * @param array $raw Unsanitized request data ($_POST).
 * @return array {
 *     @type bool   $success
 *     @type string $code     Machine-readable outcome, e.g. 'ok', 'invalid_nonce',
 *                            'spam', 'validation_failed', 'mail_failed'.
 *     @type string $message  Human-readable, safe-to-display message.
 *     @type array  $errors   field_name => message, for inline field errors.
 * }
 */
function downside_up_process_contact_submission($raw)
{
    // ---- 1. Nonce ----------------------------------------------------
    $nonce = isset($raw[DOWNSIDE_UP_CONTACT_NONCE]) ? $raw[DOWNSIDE_UP_CONTACT_NONCE] : '';

    if (!wp_verify_nonce($nonce, DOWNSIDE_UP_CONTACT_ACTION)) {
        return [
            'success' => false,
            'code'    => 'invalid_nonce',
            'message' => __("We couldn't verify your submission. Please refresh the page and try again.", 'downside-up'),
            'errors'  => [],
        ];
    }

    // ---- 2. Honeypot (spam) -------------------------------------------
    // Populated only by bots that blindly fill every field; real visitors
    // never see or fill it (see .du-honeypot in _components.css). Reject
    // silently with a generic message — never reveal that a honeypot was
    // detected, so scripted submitters get no signal to adapt to.
    $honeypot = isset($raw[DOWNSIDE_UP_CONTACT_HONEYPOT]) ? trim((string) $raw[DOWNSIDE_UP_CONTACT_HONEYPOT]) : '';

    if ('' !== $honeypot) {
        return [
            'success' => false,
            'code'    => 'spam',
            'message' => __("We couldn't transmit your inquiry at this time. Please try again or contact us directly.", 'downside-up'),
            'errors'  => [],
        ];
    }

    // ---- 3. Sanitize ----------------------------------------------------
    $name      = isset($raw['du_name']) ? sanitize_text_field(wp_unslash($raw['du_name'])) : '';
    $email     = isset($raw['du_email']) ? sanitize_email(wp_unslash($raw['du_email'])) : '';
    $interest  = isset($raw['du_interest']) ? sanitize_text_field(wp_unslash($raw['du_interest'])) : '';
    $message   = isset($raw['du_message']) ? sanitize_textarea_field(wp_unslash($raw['du_message'])) : '';

    // ---- 4. Validate ----------------------------------------------------
    $errors = [];

    if ('' === $name) {
        $errors['du_name'] = __('Please enter your full name.', 'downside-up');
    }

    if ('' === $email || !is_email($email)) {
        $errors['du_email'] = __('Please enter a valid email address.', 'downside-up');
    }

    $valid_interests = downside_up_get_contact_interest_options();
    if ('' === $interest || !array_key_exists($interest, $valid_interests)) {
        $errors['du_interest'] = __('Please select an area of interest.', 'downside-up');
    }

    if ('' === $message) {
        $errors['du_message'] = __('Please add a short message describing your inquiry.', 'downside-up');
    } elseif (mb_strlen($message) > 5000) {
        $errors['du_message'] = __('Message is too long — please keep it under 5000 characters.', 'downside-up');
    }

    if (!empty($errors)) {
        return [
            'success' => false,
            'code'    => 'validation_failed',
            'message' => __('Please correct the highlighted fields and try again.', 'downside-up'),
            'errors'  => $errors,
        ];
    }

    // ---- 5. Lightweight duplicate-submission throttle -------------------
    // Belt-and-braces alongside the JS "disable button while submitting"
    // behaviour: a transient keyed on the visitor's email stops a second
    // identical submission (double-click, resubmit, etc.) from sending a
    // second pair of emails within a short window.
    $throttle_key = 'du_contact_throttle_' . md5(strtolower($email));

    if (get_transient($throttle_key)) {
        return [
            'success' => false,
            'code'    => 'throttled',
            'message' => __("Your inquiry has already been received. Our team will review your message and get back to you.", 'downside-up'),
            'errors'  => [],
        ];
    }

    // ---- 6. Send email --------------------------------------------------
    $interest_label = $valid_interests[$interest];

    $admin_sent = downside_up_send_contact_admin_email($name, $email, $interest_label, $message);
    $user_sent  = downside_up_send_contact_confirmation_email($name, $email, $interest_label, $message);

    if (!$admin_sent) {
        // The visitor-facing message must not depend on wp_mail() alone
        // "not throwing" — we explicitly check its return value here, and
        // only report success once the admin notification actually sent.
        return [
            'success' => false,
            'code'    => 'mail_failed',
            'message' => __("We couldn't transmit your inquiry at this time. Please try again or contact us directly.", 'downside-up'),
            'errors'  => [],
        ];
    }

    set_transient($throttle_key, 1, 60);

    if (!$user_sent) {
        // Admin was notified (the inquiry is not lost), but let the caller
        // know the confirmation email itself failed, e.g. for logging.
        do_action('downside_up_contact_confirmation_failed', $email);
    }

    do_action('downside_up_contact_submitted', compact('name', 'email', 'interest', 'message'));

    return [
        'success' => true,
        'code'    => 'ok',
        'message' => __('Your inquiry has been received. Our team will review your message and get back to you.', 'downside-up'),
        'errors'  => [],
    ];
}

/**
 * Sends the internal notification email to the configured DownSide Up
 * recipient (see downside_up_contact_recipient_email() in inc/contact.php).
 */
function downside_up_send_contact_admin_email($name, $email, $interest_label, $message)
{
    $to      = downside_up_contact_recipient_email();
    $subject = __('New Contact Inquiry — DownSide Up', 'downside-up');

    $lines = [
        __('A new inquiry was submitted through the DownSide Up Contact Us page.', 'downside-up'),
        '',
        __('Full Name:', 'downside-up') . ' ' . $name,
        __('Email:', 'downside-up') . ' ' . $email,
        __('Area of Interest:', 'downside-up') . ' ' . $interest_label,
        __('Submitted:', 'downside-up') . ' ' . wp_date('Y-m-d H:i:s (T)'),
        '',
        __('Message:', 'downside-up'),
        $message,
    ];

    $body = implode("\n", $lines);

    $from_name  = downside_up_contact_from_name();
    $from_email = downside_up_contact_from_email();

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        sprintf('From: %s <%s>', $from_name, $from_email),
        // Visitor's address goes in Reply-To only — never From — to avoid
        // SPF/DMARC deliverability failures on the sending domain.
        sprintf('Reply-To: %s <%s>', $name, $email),
    ];

    return (bool) wp_mail($to, $subject, $body, $headers);
}

/**
 * Sends the visitor's automatic confirmation email.
 */
function downside_up_send_contact_confirmation_email($name, $email, $interest_label, $message)
{
    $subject = __('We received your inquiry — DownSide Up', 'downside-up');

    $site_name = get_bloginfo('name');
    if (empty($site_name)) {
        $site_name = 'DownSide Up';
    }

    $lines = [
        sprintf(__('Hello %s,', 'downside-up'), $name),
        '',
        __('Thank you for reaching out to DownSide Up Financial Partners. This confirms that your inquiry was successfully received.', 'downside-up'),
        __('Our advisory team reviews every submission personally and will follow up as soon as your request has been assessed.', 'downside-up'),
        '',
        __('Here is a copy of what you sent us:', 'downside-up'),
        __('Area of Interest:', 'downside-up') . ' ' . $interest_label,
        __('Message:', 'downside-up'),
        $message,
        '',
        __('If anything above needs correcting, simply reply to this email.', 'downside-up'),
        '',
        __('— The DownSide Up Advisory Team', 'downside-up'),
        home_url('/'),
    ];

    $body = implode("\n", $lines);

    $from_name  = downside_up_contact_from_name();
    $from_email = downside_up_contact_from_email();

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        sprintf('From: %s <%s>', $from_name, $from_email),
    ];

    return (bool) wp_mail($email, $subject, $body, $headers);
}
