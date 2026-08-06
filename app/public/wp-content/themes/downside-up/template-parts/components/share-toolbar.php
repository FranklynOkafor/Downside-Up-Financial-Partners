<?php
/**
 * Floating Share Toolbar — Single Article template.
 * Loaded via: get_template_part( 'template-parts/components/share-toolbar' );
 * Must run inside the Loop (uses get_the_ID()).
 *
 * - Share button: native Web Share API where available, falls back to
 *   copying the URL to the clipboard (covers "Share" and "Copy Link" from
 *   the brief in one control, matching the 3-icon toolbar in the design).
 * - Bookmark button: reuses the existing bookmark system as-is (same
 *   data-du-bookmark / data-post-id contract as resource-card.php) —
 *   handled by the already-enqueued resource-card.js, not duplicated here.
 * - Like button: lightweight visual toggle, handled by article-share.js.
 */

$du_post_id = get_the_ID();
?>
<div class="du-share-toolbar" data-du-share-toolbar>

    <button type="button" class="du-share-toolbar__btn" data-du-share aria-label="<?php esc_attr_e('Share this article', 'downside-up'); ?>">
        <?php echo downside_up_icon('share', ['width' => 18, 'height' => 18]); ?>
        <span class="du-sr-only" data-du-share-status></span>
    </button>

    <button
        type="button"
        class="du-share-toolbar__btn"
        data-du-bookmark
        data-post-id="<?php echo esc_attr($du_post_id); ?>"
        aria-pressed="false"
        aria-label="<?php esc_attr_e('Save this article', 'downside-up'); ?>"
    >
        <?php echo downside_up_icon('bookmark-plus', ['width' => 18, 'height' => 18]); ?>
    </button>

    <button type="button" class="du-share-toolbar__btn" data-du-like aria-pressed="false" aria-label="<?php esc_attr_e('Like this article', 'downside-up'); ?>">
        <?php echo downside_up_icon('thumbs-up', ['width' => 18, 'height' => 18]); ?>
    </button>

</div>
