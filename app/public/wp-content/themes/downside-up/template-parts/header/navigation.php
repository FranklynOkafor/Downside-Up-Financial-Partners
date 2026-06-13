<nav class="primary-nav" aria-label="<?php esc_attr_e('Primary navigation', 'downside-up'); ?>">
    <?php
    if (has_nav_menu('primary')) {
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'primary-nav__list',
            'depth'          => 1,
        ]);
    } else {
        downside_up_default_menu();
    }
    ?>

    <a href="<?php echo esc_url(home_url('/start-assessment')); ?>" class="btn btn--primary btn--sm primary-nav__cta">
        <?php esc_html_e('Start Assessment', 'downside-up'); ?>
    </a>
</nav>
