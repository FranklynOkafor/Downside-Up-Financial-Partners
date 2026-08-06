<?php
/**
 * Newsletter component — the standard newsletter signup section for the
 * whole theme.
 *
 * Loaded via: get_template_part( 'template-parts/components/newsletter' );
 *
 * Self-contained: reads its own content from downside_up_get_newsletter_data()
 * and posts to admin-post.php (inc/newsletter.php handles it). No args
 * needed — drop this one file into any page template unchanged.
 */

$du_newsletter = downside_up_get_newsletter_data();
$du_status      = isset($_GET['newsletter']) ? sanitize_key($_GET['newsletter']) : '';
?>
<section class="du-newsletter" aria-labelledby="du-newsletter-heading">
    <div class="du-container">
        <div class="du-newsletter__card">

            <div class="du-newsletter__content">
                <h2 id="du-newsletter-heading" class="du-newsletter__headline du-text-headline-xl">
                    <?php echo esc_html($du_newsletter['headline']); ?>
                </h2>
                <p class="du-newsletter__description du-text-body-md">
                    <?php echo esc_html($du_newsletter['description']); ?>
                </p>
            </div>

            <div class="du-newsletter__form-wrap">
                <?php if ('success' === $du_status) : ?>
                    <p class="du-newsletter__status du-newsletter__status--success" role="status">
                        <?php esc_html_e("You're subscribed — thank you.", 'downside-up'); ?>
                    </p>
                <?php else : ?>
                    <form class="du-newsletter__form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="downside_up_newsletter_signup">
                        <?php wp_nonce_field('downside_up_newsletter_signup', 'downside_up_newsletter_nonce'); ?>

                        <!-- Honeypot: hidden from real visitors, real bots often fill every field. -->
                        <span class="du-honeypot" aria-hidden="true">
                            <label for="du-newsletter-hp"><?php esc_html_e('Leave this field empty', 'downside-up'); ?></label>
                            <input type="text" id="du-newsletter-hp" name="du_newsletter_hp" tabindex="-1" autocomplete="off">
                        </span>

                        <div class="du-newsletter__field-row">
                            <label for="du-newsletter-email" class="du-sr-only"><?php esc_html_e('Email address', 'downside-up'); ?></label>
                            <input
                                type="email"
                                id="du-newsletter-email"
                                name="email"
                                class="du-newsletter__input du-text-body-md"
                                placeholder="<?php echo esc_attr($du_newsletter['placeholder']); ?>"
                                required>
                            <button type="submit" class="du-btn du-btn--inverse du-newsletter__submit">
                                <?php echo esc_html($du_newsletter['button_text']); ?>
                            </button>
                        </div>

                        <?php if ('invalid' === $du_status) : ?>
                            <p class="du-newsletter__status du-newsletter__status--error" role="alert">
                                <?php esc_html_e('Please enter a valid email address.', 'downside-up'); ?>
                            </p>
                        <?php elseif ('error' === $du_status) : ?>
                            <p class="du-newsletter__status du-newsletter__status--error" role="alert">
                                <?php esc_html_e('Something went wrong — please try again.', 'downside-up'); ?>
                            </p>
                        <?php else : ?>
                            <p class="du-newsletter__disclaimer du-text-caption">
                                <?php echo esc_html($du_newsletter['disclaimer']); ?>
                            </p>
                        <?php endif; ?>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
