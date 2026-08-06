<?php
/**
 * Featured Resource section.
 * Loaded via: get_template_part( 'template-parts/sections/resources/featured-resource' );
 *
 * Pulls a single post via downside_up_get_featured_resource_post() (inc/resources.php).
 * Self-contained: renders nothing if the site has no posts yet.
 */

$du_featured_post = downside_up_get_featured_resource_post();

if (!$du_featured_post) {
    return;
}

$du_reading_time = downside_up_reading_time($du_featured_post->ID);
?>
<section class="du-featured-resource" aria-labelledby="du-featured-resource-heading">
    <div class="du-container">
        <article class="du-featured-resource__card">

            <div class="du-featured-resource__media">
                <?php if (has_post_thumbnail($du_featured_post)) : ?>
                    <?php echo get_the_post_thumbnail($du_featured_post, 'large', [
                        'class'   => 'du-featured-resource__image',
                        'loading' => 'lazy',
                        'alt'     => get_the_title($du_featured_post),
                    ]); ?>
                <?php else : ?>
                    <div class="du-media-placeholder">
                        <?php echo downside_up_icon('image', ['width' => 32, 'height' => 32]); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="du-featured-resource__content">
                <div class="du-featured-resource__meta">
                    <span class="du-badge"><?php esc_html_e('Featured', 'downside-up'); ?></span>
                    <span class="du-featured-resource__reading-time du-text-label-caps">
                        <?php
                        /* translators: %d: number of minutes */
                        echo esc_html(sprintf(_n('%d MIN READ', '%d MIN READ', $du_reading_time, 'downside-up'), $du_reading_time));
                        ?>
                    </span>
                </div>

                <h2 id="du-featured-resource-heading" class="du-featured-resource__title du-text-headline-lg">
                    <a href="<?php echo esc_url(get_permalink($du_featured_post)); ?>" class="du-featured-resource__title-link">
                        <?php echo esc_html(get_the_title($du_featured_post)); ?>
                    </a>
                </h2>

                <p class="du-featured-resource__excerpt du-text-body-md">
                    <?php echo esc_html(get_the_excerpt($du_featured_post)); ?>
                </p>

                <a href="<?php echo esc_url(get_permalink($du_featured_post)); ?>" class="du-link-arrow">
                    <?php esc_html_e('Read Full Article', 'downside-up'); ?>
                    <span class="du-link-arrow__icon">
                        <?php echo downside_up_icon('arrow-right', ['width' => 16, 'height' => 16]); ?>
                    </span>
                </a>
            </div>

        </article>
    </div>
</section>
