<div class="footer-inner">

    <p>

        &copy;
        <?php echo date('Y'); ?>

        <?php bloginfo('name'); ?>

    </p>

    <?php

    wp_nav_menu([
        'theme_location' => 'footer',
        'container'      => false,
        'menu_class'     => 'footer-menu',
    ]);

    ?>

</div>