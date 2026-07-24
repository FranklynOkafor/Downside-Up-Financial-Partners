<?php
/**
 * Footer content — brand/tagline, Platform/Customer/Legal menu columns, social, copyright.
 * Platform/Customer/Legal pull from the 'footer-platform', 'footer-customer',
 * and 'footer-legal' nav menu locations registered in inc/theme-support.php.
 */

$du_footer_columns = [
    'platform' => [
        'label'    => __('Platform', 'downside-up'),
        'location' => 'footer-platform',
    ],
    'customer' => [
        'label'    => __('Customer', 'downside-up'),
        'location' => 'footer-customer',
    ],
    'legal' => [
        'label'    => __('Legal', 'downside-up'),
        'location' => 'footer-legal',
    ],
];
?>
<div class="du-footer__inner du-container">

    <div class="du-footer__grid">

        <div class="du-footer__brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="du-footer__logo-link" rel="home">
                <?php $du_footer_logo = downside_up_logo_image(['class' => 'du-footer__logo-image']); ?>
                <?php if ($du_footer_logo) : ?>
                    <span class="du-footer__logo-image-wrap"><?php echo $du_footer_logo; ?></span>
                <?php endif; ?>
                <span class="du-footer__logo"><?php esc_html_e('DownSide Up', 'downside-up'); ?></span>
            </a>
            <p class="du-footer__tagline">
                <?php esc_html_e('Redefining financial introspection for the modern era. Institutional analysis with a modern touch.', 'downside-up'); ?>
            </p>
        </div>

        <?php foreach ($du_footer_columns as $du_column) : ?>
            <div class="du-footer__col">
                <h3 class="du-footer__heading du-text-label-caps"><?php echo esc_html($du_column['label']); ?></h3>
                <?php
                if (has_nav_menu($du_column['location'])) {
                    wp_nav_menu([
                        'theme_location' => $du_column['location'],
                        'container'      => false,
                        'menu_class'     => 'du-footer__list',
                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ]);
                }
                ?>
            </div>
        <?php endforeach; ?>

        <div class="du-footer__col du-footer__col--social">
            <h3 class="du-footer__heading du-text-label-caps"><?php esc_html_e('Social', 'downside-up'); ?></h3>
            <div class="du-footer__social">
                <a href="#" class="du-footer__social-link" aria-label="<?php esc_attr_e('LinkedIn', 'downside-up'); ?>">
                    <?php echo downside_up_icon('linkedin'); ?>
                </a>
                <a href="#" class="du-footer__social-link" aria-label="<?php esc_attr_e('X (Twitter)', 'downside-up'); ?>">
                    <?php echo downside_up_icon('x-twitter'); ?>
                </a>
            </div>
        </div>

    </div>

    <div class="du-footer__bottom">
        <p class="du-footer__copyright du-text-caption">
            &copy; <?php echo esc_html(gmdate('Y')); ?> <?php esc_html_e('DownSide Up Partners. All rights reserved.', 'downside-up'); ?>
        </p>
    </div>

</div>
