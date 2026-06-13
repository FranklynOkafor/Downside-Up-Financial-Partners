<section class="newsletter">
    <div class="container newsletter__inner">
        <div class="newsletter__copy">
            <h2><?php esc_html_e('The Weekly Intelligence', 'downside-up'); ?></h2>
            <p><?php esc_html_e('Exclusive market perspectives delivered every Monday.', 'downside-up'); ?></p>
        </div>

        <?php
        /**
         * TODO (Phase 5): wire this form up to Mailchimp / ConvertKit / Brevo
         * via their REST API instead of submitting as a plain form.
         */
        ?>
        <form class="newsletter-form" action="#" method="post">
            <label class="screen-reader-text" for="newsletter-email">
                <?php esc_html_e('Email Address', 'downside-up'); ?>
            </label>
            <input
                type="email"
                id="newsletter-email"
                name="email"
                placeholder="<?php esc_attr_e('Email Address', 'downside-up'); ?>"
                required
            >
            <button type="submit"><?php esc_html_e('Subscribe', 'downside-up'); ?></button>
        </form>
    </div>
</section>
