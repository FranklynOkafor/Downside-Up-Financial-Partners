<?php

/**
 * Direct Inquiry — Contact Us form card.
 * Loaded via: get_template_part( 'template-parts/contact/contact-form' ).
 *
 * Real, functional WordPress form (see inc/contact-form-handler.php):
 *   - wp_nonce_field() + server-side wp_verify_nonce()
 *   - honeypot (.du-honeypot, already defined generically in _components.css)
 *   - posts to admin-post.php by default (works with JS disabled);
 *     assets/js/contact-form.js progressively enhances this into an
 *     admin-ajax.php fetch() with inline loading/success/error states.
 *
 * Uses the new generic .du-form-field system (assets/css/_forms.css) and
 * the existing .du-btn / icon system — no new button or input component
 * was invented beyond the one this file needed and now shares.
 */

$du_interest_options = downside_up_get_contact_interest_options();

// No-JS fallback status, mirrors the existing newsletter component's
// $_GET-based status pattern (template-parts/components/newsletter.php).
$du_status = isset($_GET['contact']) ? sanitize_key($_GET['contact']) : '';
?>
<div class="du-contact-form-card" id="du-contact-form">

    <h2 class="du-contact-form-card__heading du-text-headline-lg">
        <?php esc_html_e('Direct Inquiry', 'downside-up'); ?>
    </h2>
    <p class="du-contact-form-card__description du-text-body-md">
        <?php esc_html_e('Detailed inquiries allow our advisors to interpret your needs before the first conversation. Please provide context for your request.', 'downside-up'); ?>
    </p>

    <div
        class="du-form-status du-form-status--success"
        id="du-contact-status-success"
        role="status"
        <?php if ('success' !== $du_status) : ?>hidden<?php endif; ?>>
        <?php esc_html_e('Your inquiry has been received. Our team will review your message and get back to you.', 'downside-up'); ?>
    </div>

    <div
        class="du-form-status du-form-status--error"
        id="du-contact-status-error"
        role="alert"
        <?php if (!in_array($du_status, ['error', 'invalid'], true)) : ?>hidden<?php endif; ?>>
        <span id="du-contact-status-error-text">
            <?php
            if ('invalid' === $du_status) {
                esc_html_e('Please correct the highlighted fields and try again.', 'downside-up');
            } else {
                esc_html_e("We couldn't transmit your inquiry at this time. Please try again or contact us directly.", 'downside-up');
            }
            ?>
        </span>
    </div>

    <form
        class="du-contact-form"
        id="du-contact-form-el"
        method="post"
        action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
        novalidate
        <?php if ('success' === $du_status) : ?>hidden<?php endif; ?>>

        <input type="hidden" name="action" value="<?php echo esc_attr(DOWNSIDE_UP_CONTACT_ACTION); ?>">
        <?php wp_nonce_field(DOWNSIDE_UP_CONTACT_ACTION, DOWNSIDE_UP_CONTACT_NONCE); ?>

        <!-- Honeypot: hidden from real visitors and screen readers via
             aria-hidden + tabindex="-1"; bots that fill every field trip it. -->
        <span class="du-honeypot" aria-hidden="true">
            <label for="du-contact-hp"><?php esc_html_e('Leave this field empty', 'downside-up'); ?></label>
            <input
                type="text"
                id="du-contact-hp"
                name="<?php echo esc_attr(DOWNSIDE_UP_CONTACT_HONEYPOT); ?>"
                tabindex="-1"
                autocomplete="off">
        </span>

        <div class="du-contact-form__row">
            <div class="du-form-field" data-du-field="du_name">
                <label for="du-contact-name" class="du-form-field__label">
                    <?php esc_html_e('Legal Full Name', 'downside-up'); ?>
                    <span class="du-form-field__required" aria-hidden="true">*</span>
                </label>
                <input
                    type="text"
                    id="du-contact-name"
                    name="du_name"
                    class="du-form-field__control"
                    placeholder="<?php esc_attr_e('e.g. Alexander Sterling', 'downside-up'); ?>"
                    autocomplete="name"
                    aria-required="true"
                    aria-describedby="du-contact-name-error"
                    required>
                <p class="du-form-field__error" id="du-contact-name-error" role="alert" hidden></p>
            </div>

            <div class="du-form-field" data-du-field="du_email">
                <label for="du-contact-email" class="du-form-field__label">
                    <?php esc_html_e('Secure Email', 'downside-up'); ?>
                    <span class="du-form-field__required" aria-hidden="true">*</span>
                </label>
                <input
                    type="email"
                    id="du-contact-email"
                    name="du_email"
                    class="du-form-field__control"
                    placeholder="<?php esc_attr_e('email@institution.com', 'downside-up'); ?>"
                    autocomplete="email"
                    inputmode="email"
                    aria-required="true"
                    aria-describedby="du-contact-email-error"
                    required>
                <p class="du-form-field__error" id="du-contact-email-error" role="alert" hidden></p>
            </div>
        </div>

        <div class="du-form-field" data-du-field="du_interest">
            <label for="du-contact-interest" class="du-form-field__label">
                <?php esc_html_e('Area of Interest', 'downside-up'); ?>
                <span class="du-form-field__required" aria-hidden="true">*</span>
            </label>
            <select
                id="du-contact-interest"
                name="du_interest"
                class="du-form-field__control"
                aria-required="true"
                aria-describedby="du-contact-interest-error"
                required>
                <?php foreach ($du_interest_options as $du_value => $du_label) : ?>
                    <option value="<?php echo esc_attr($du_value); ?>"><?php echo esc_html($du_label); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="du-form-field__error" id="du-contact-interest-error" role="alert" hidden></p>
        </div>

        <div class="du-form-field" data-du-field="du_message">
            <label for="du-contact-message" class="du-form-field__label">
                <?php esc_html_e('Message Context', 'downside-up'); ?>
                <span class="du-form-field__required" aria-hidden="true">*</span>
            </label>
            <textarea
                id="du-contact-message"
                name="du_message"
                class="du-form-field__control"
                rows="6"
                placeholder="<?php esc_attr_e('Please describe your current financial landscape…', 'downside-up'); ?>"
                aria-required="true"
                aria-describedby="du-contact-message-error"
                required></textarea>
            <p class="du-form-field__error" id="du-contact-message-error" role="alert" hidden></p>
        </div>

        <button type="submit" class="du-btn du-btn--primary du-contact-form__submit" id="du-contact-submit">
            <span class="du-contact-form__submit-label">
                <?php esc_html_e('Transmit Inquiry', 'downside-up'); ?>
            </span>
            <span class="du-contact-form__submit-icon" aria-hidden="true">
                <?php echo downside_up_icon('arrow-right', ['width' => 18, 'height' => 18]); ?>
            </span>
            <span class="du-contact-form__spinner" aria-hidden="true"></span>
        </button>

    </form>

</div>
