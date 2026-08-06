<?php
/**
 * Author Card — reusable component.
 * Loaded via: get_template_part( 'template-parts/components/author-card' );
 * Must run inside the Loop.
 *
 * Supports avatar, name, role (via the "description"-adjacent user meta
 * WordPress exposes as user_description isn't a "role" field, so role
 * comes from a light custom meta key, 'du_author_role', with a graceful
 * empty fallback), biography, and social links (LinkedIn / X — icons
 * already exist in downside_up_icon(), future-proofed the same way
 * cta-card.php future-proofs social links).
 */

$du_author_id     = get_the_author_meta('ID');
$du_author_name   = get_the_author_meta('display_name', $du_author_id);
$du_author_role   = get_the_author_meta('du_author_role', $du_author_id);
$du_author_bio    = downside_up_get_author_bio($du_author_id);
$du_author_url    = get_author_posts_url($du_author_id);
$du_linkedin      = get_the_author_meta('du_author_linkedin', $du_author_id);
$du_twitter       = get_the_author_meta('du_author_twitter', $du_author_id);

if (!$du_author_name) {
    return;
}
?>
<div class="du-author-card">

    <a href="<?php echo esc_url($du_author_url); ?>" class="du-author-card__avatar">
        <?php echo get_avatar($du_author_id, 96, '', '', ['class' => 'du-author-card__avatar-image']); ?>
    </a>

    <div class="du-author-card__body">
        <a href="<?php echo esc_url($du_author_url); ?>" class="du-author-card__name du-text-headline-lg">
            <?php echo esc_html($du_author_name); ?>
        </a>

        <?php if ($du_author_role) : ?>
            <p class="du-author-card__role du-text-label-caps"><?php echo esc_html($du_author_role); ?></p>
        <?php endif; ?>

        <?php if ($du_author_bio) : ?>
            <p class="du-author-card__bio du-text-body-md"><?php echo esc_html($du_author_bio); ?></p>
        <?php endif; ?>

        <?php if ($du_linkedin || $du_twitter) : ?>
            <div class="du-author-card__social">
                <?php if ($du_linkedin) : ?>
                    <a href="<?php echo esc_url($du_linkedin); ?>" class="du-author-card__social-link" aria-label="<?php esc_attr_e('LinkedIn', 'downside-up'); ?>">
                        <?php echo downside_up_icon('linkedin', ['width' => 16, 'height' => 16]); ?>
                    </a>
                <?php endif; ?>
                <?php if ($du_twitter) : ?>
                    <a href="<?php echo esc_url($du_twitter); ?>" class="du-author-card__social-link" aria-label="<?php esc_attr_e('X (Twitter)', 'downside-up'); ?>">
                        <?php echo downside_up_icon('x-twitter', ['width' => 16, 'height' => 16]); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

</div>
