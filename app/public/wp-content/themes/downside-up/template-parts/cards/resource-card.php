<?php
/**
 * Resource Card — the standard article card for the whole theme.
 *
 * Loaded via: get_template_part( 'template-parts/cards/resource-card', null, $args );
 *
 * Args:
 *   'post'              (WP_Post|int, required) — post object or ID
 *   'show_reading_time' (bool, optional)        — default false
 *   'heading_level'     (string, optional)      — default 'h3'
 */

if (empty($args['post'])) {
    return;
}

$du_post = is_object($args['post']) ? $args['post'] : get_post($args['post']);

if (!$du_post) {
    return;
}

$du_show_reading_time = !empty($args['show_reading_time']);
$du_heading_level     = !empty($args['heading_level']) ? $args['heading_level'] : 'h3';
$du_permalink         = get_permalink($du_post);

// Tags = badges, per project convention (Categories are used by Goal
// Navigation instead). Only the first tag is shown to keep the card calm.
$du_tags  = get_the_tags($du_post->ID);
$du_badge = $du_tags && !is_wp_error($du_tags) ? $du_tags[0]->name : '';
?>
<article class="du-resource-card">

    <div class="du-resource-card__media">
        <a href="<?php echo esc_url($du_permalink); ?>" class="du-resource-card__media-link" tabindex="-1" aria-hidden="true">
            <?php if (has_post_thumbnail($du_post)) : ?>
                <?php echo get_the_post_thumbnail($du_post, 'medium_large', [
                    'class'   => 'du-resource-card__image',
                    'loading' => 'lazy',
                    'alt'     => '',
                ]); ?>
            <?php else : ?>
                <div class="du-media-placeholder">
                    <?php echo downside_up_icon('image', ['width' => 24, 'height' => 24]); ?>
                </div>
            <?php endif; ?>
        </a>

        <?php if ($du_badge) : ?>
            <span class="du-badge du-resource-card__badge"><?php echo esc_html($du_badge); ?></span>
        <?php endif; ?>

        <button
            type="button"
            class="du-resource-card__bookmark"
            data-du-bookmark
            data-post-id="<?php echo esc_attr($du_post->ID); ?>"
            aria-pressed="false"
            aria-label="<?php esc_attr_e('Save this article', 'downside-up'); ?>"
        >
            <?php echo downside_up_icon('bookmark', ['width' => 16, 'height' => 16]); ?>
        </button>
    </div>

    <div class="du-resource-card__body">
        <?php if ($du_show_reading_time) : ?>
            <span class="du-resource-card__reading-time du-text-label-caps">
                <?php echo downside_up_icon('clock', ['width' => 12, 'height' => 12]); ?>
                <?php
                $du_minutes = downside_up_reading_time($du_post->ID);
                /* translators: %d: number of minutes */
                echo esc_html(sprintf(_n('%d MIN READ', '%d MIN READ', $du_minutes, 'downside-up'), $du_minutes));
                ?>
            </span>
        <?php endif; ?>

        <<?php echo tag_escape($du_heading_level); ?> class="du-resource-card__title">
            <a href="<?php echo esc_url($du_permalink); ?>" class="du-resource-card__title-link">
                <?php echo esc_html(get_the_title($du_post)); ?>
            </a>
        </<?php echo tag_escape($du_heading_level); ?>>

        <p class="du-resource-card__excerpt du-text-body-md">
            <?php echo esc_html(get_the_excerpt($du_post)); ?>
        </p>

        <div class="du-resource-card__footer">
            <time class="du-resource-card__date du-text-label-caps" datetime="<?php echo esc_attr(get_the_date('c', $du_post)); ?>">
                <?php echo esc_html(get_the_date('M j, Y', $du_post)); ?>
            </time>

            <a href="<?php echo esc_url($du_permalink); ?>" class="du-link-arrow">
                <?php esc_html_e('Read Article', 'downside-up'); ?>
                <span class="du-link-arrow__icon">
                    <?php echo downside_up_icon('arrow-right', ['width' => 14, 'height' => 14]); ?>
                </span>
            </a>
        </div>
    </div>

</article>
