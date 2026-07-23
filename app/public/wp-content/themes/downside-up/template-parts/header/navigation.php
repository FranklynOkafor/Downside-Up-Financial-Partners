<?php
/**
 * Header navigation — Primary Menu + Login + Start Assessment CTA.
 * Uses the 'primary' nav menu location registered in inc/theme-support.php.
 */
?>
<nav class="du-nav" aria-label="<?php esc_attr_e('Primary', 'downside-up'); ?>">

    <button type="button" class="du-nav__toggle" aria-expanded="false" aria-controls="du-nav-menu">
        <?php echo downside_up_icon('menu', ['class' => 'du-nav__icon du-nav__icon--open']); ?>
        <?php echo downside_up_icon('close', ['class' => 'du-nav__icon du-nav__icon--close']); ?>
        <span class="du-sr-only"><?php esc_html_e('Toggle menu', 'downside-up'); ?></span>
    </button>

    <div class="du-nav__menu" id="du-nav-menu">

        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'du-nav__list',
            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
            'fallback_cb'    => false,
            'depth'          => 1,
        ]);
        ?>

        <div class="du-nav__actions">
            <a href="<?php echo esc_url(home_url('/login/')); ?>" class="du-nav__login">
                <?php esc_html_e('Login', 'downside-up'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/quiz/')); ?>" class="du-btn du-btn--primary du-nav__cta">
                <?php esc_html_e('Start Assessment', 'downside-up'); ?>
            </a>
        </div>

    </div>
</nav>
