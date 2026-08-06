<?php
/**
 * Previous / Next Navigation — reusable component.
 * Loaded via: get_template_part( 'template-parts/components/article-navigation' );
 * Must run inside the Loop.
 */

$du_prev_post = get_adjacent_post(false, '', true);
$du_next_post = get_adjacent_post(false, '', false);

if (!$du_prev_post && !$du_next_post) {
    return;
}
?>
<nav class="du-article-nav" aria-label="<?php esc_attr_e('More articles', 'downside-up'); ?>">
    <div class="du-article-nav__inner du-container">

        <?php if ($du_prev_post) : ?>
            <a href="<?php echo esc_url(get_permalink($du_prev_post)); ?>" class="du-article-nav__link du-article-nav__link--prev">
                <span class="du-article-nav__icon" aria-hidden="true">
                    <?php echo downside_up_icon('chevron-left', ['width' => 16, 'height' => 16]); ?>
                </span>
                <span class="du-article-nav__text">
                    <span class="du-article-nav__label du-text-label-caps"><?php esc_html_e('Previous', 'downside-up'); ?></span>
                    <span class="du-article-nav__title"><?php echo esc_html(get_the_title($du_prev_post)); ?></span>
                </span>
            </a>
        <?php else : ?>
            <span class="du-article-nav__spacer" aria-hidden="true"></span>
        <?php endif; ?>

        <?php if ($du_next_post) : ?>
            <a href="<?php echo esc_url(get_permalink($du_next_post)); ?>" class="du-article-nav__link du-article-nav__link--next">
                <span class="du-article-nav__text">
                    <span class="du-article-nav__label du-text-label-caps"><?php esc_html_e('Next', 'downside-up'); ?></span>
                    <span class="du-article-nav__title"><?php echo esc_html(get_the_title($du_next_post)); ?></span>
                </span>
                <span class="du-article-nav__icon" aria-hidden="true">
                    <?php echo downside_up_icon('chevron-right', ['width' => 16, 'height' => 16]); ?>
                </span>
            </a>
        <?php endif; ?>

    </div>
</nav>
