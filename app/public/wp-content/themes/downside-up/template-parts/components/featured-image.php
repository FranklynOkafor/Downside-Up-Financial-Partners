<?php
/**
 * Featured Image — standalone, reusable component.
 * Loaded via: get_template_part( 'template-parts/components/featured-image', null, $args );
 *
 * Args:
 *   'post'  (WP_Post|int, optional) — defaults to the current post in the Loop
 *   'size'  (string, optional)      — registered image size, default 'large'
 *   'class' (string, optional)      — extra class on the <figure>
 *
 * get_the_post_thumbnail() already outputs a full responsive srcset/sizes
 * attribute set (core WordPress behavior) — nothing custom needed for that.
 * Caption comes from the attachment's native "Caption" field, so editors
 * set it the normal WordPress way (no extra ACF field required).
 */

$du_post = !empty($args['post']) ? (is_object($args['post']) ? $args['post'] : get_post($args['post'])) : get_post();

if (!$du_post || !has_post_thumbnail($du_post)) {
    return;
}

$du_size    = !empty($args['size']) ? $args['size'] : 'large';
$du_class   = !empty($args['class']) ? ' ' . $args['class'] : '';
$du_caption = wp_get_attachment_caption(get_post_thumbnail_id($du_post));
?>
<figure class="du-featured-image<?php echo esc_attr($du_class); ?>">
    <?php
    echo get_the_post_thumbnail($du_post, $du_size, [
        'class'         => 'du-featured-image__img',
        'loading'       => 'eager',
        'fetchpriority' => 'high',
        'decoding'      => 'async',
        'alt'           => wp_strip_all_tags(get_the_title($du_post)),
    ]);
    ?>

    <?php if ($du_caption) : ?>
        <figcaption class="du-featured-image__caption du-text-caption">
            <?php echo wp_kses_post($du_caption); ?>
        </figcaption>
    <?php endif; ?>
</figure>
