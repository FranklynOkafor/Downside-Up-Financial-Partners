<?php
/**
 * 404 hero / error section.
 * Loaded via: get_template_part('template-parts/sections/error-404');
 *
 * A full-bleed dark section using the same --inverse-surface /
 * --inverse-on-surface pairing already established for full-width dark
 * sections (see .du-privacy in _how-it-works.css), so this reads as the
 * same "dark section" component family rather than a one-off. Buttons
 * reuse .du-btn--inverse (already built for a dark --primary-family
 * background), the search field reuses .du-search-field as-is, and the
 * small divider rule reuses the exact recipe already used under
 * eyebrows in the Reality Check Process / FAQ sections.
 *
 * This is static, branded system copy (not a CMS-editable page), so — in
 * keeping with how archive.php/search.php are currently plain stubs
 * rather than ACF-backed templates — the content below is written
 * directly in the template with standard WordPress i18n, instead of
 * introducing a data/ACF plumbing layer for a page that isn't meant to
 * be edited from the CMS.
 */
?>
<section class="du-404" aria-labelledby="du-404-heading">
    <div class="du-container du-404__inner">

        <p class="du-404__decorative" aria-hidden="true">404</p>

        <div class="du-404__content">

            <p class="du-404__code du-text-label-caps">
                <?php esc_html_e('ERR_NOT_FOUND', 'downside-up'); ?>
            </p>
            <span class="du-404__divider" aria-hidden="true"></span>

            <h1 id="du-404-heading" class="du-404__heading du-text-headline-xl">
                <?php esc_html_e('Lost in calculation.', 'downside-up'); ?>
            </h1>

            <p class="du-404__description du-text-body-md">
                <?php esc_html_e("The data point you're looking for has drifted outside our measurable parameters. Even the most precise models encounter an outlier.", 'downside-up'); ?>
            </p>

            <div class="du-404__search">
                <?php
                get_template_part('template-parts/components/search-field', null, [
                    'placeholder' => __('Search the site…', 'downside-up'),
                    'aria_label'  => __('Search the site', 'downside-up'),
                    'classes'     => 'du-search-field--inverse',
                ]);
                ?>
            </div>

            <nav class="du-404__actions" aria-label="<?php esc_attr_e('404 page actions', 'downside-up'); ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="du-btn du-btn--inverse">
                    <?php echo downside_up_icon('chevron-left', ['width' => 18, 'height' => 18]); ?>
                    <?php esc_html_e('Back to Home', 'downside-up'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/consultation/')); ?>" class="du-404__secondary-link">
                    <?php esc_html_e('Talk to an Advisor', 'downside-up'); ?>
                    <?php echo downside_up_icon('arrow-right', ['width' => 16, 'height' => 16]); ?>
                </a>
            </nav>

        </div>

    </div>
</section>
