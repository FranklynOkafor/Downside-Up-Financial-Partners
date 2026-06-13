<div class="site-branding">
    <?php if (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
    <?php else : ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-branding__link" rel="home">
            <?php bloginfo('name'); ?>
        </a>
    <?php endif; ?>
</div>
