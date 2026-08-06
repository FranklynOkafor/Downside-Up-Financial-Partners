<?php
/**
 * Article Hero — Single Article template.
 * Loaded via: get_template_part( 'template-parts/heroes/hero', 'article' );
 * Must run inside the Loop (uses the_title(), get_the_excerpt(), etc.).
 *
 * Contains: category, reading time, title, excerpt, publication date,
 * author byline. Reuses existing type tokens only:
 *   du-text-label-caps  — eyebrow row
 *   du-text-display-lg  — title (same scale as the homepage hero)
 *   du-text-quote__lg   — excerpt (serif italic, already defined for quotes)
 */

$du_category      = downside_up_get_primary_category();
$du_reading_time  = downside_up_reading_time();
$du_excerpt       = get_the_excerpt();
$du_author_id     = get_the_author_meta('ID');
?>
<header class="du-article-hero" aria-labelledby="du-article-heading">
    <div class="du-article-hero__inner du-container">

        <p class="du-article-hero__eyebrow du-text-label-caps">
            <?php if ($du_category) : ?>
                <a href="<?php echo esc_url(get_category_link($du_category)); ?>" class="du-article-hero__category">
                    <?php echo esc_html($du_category->name); ?>
                </a>
                <span class="du-article-hero__dot" aria-hidden="true">•</span>
            <?php endif; ?>
            <span class="du-article-hero__reading-time">
                <?php
                /* translators: %d: number of minutes */
                echo esc_html(sprintf(_n('%d MIN READ', '%d MIN READ', $du_reading_time, 'downside-up'), $du_reading_time));
                ?>
            </span>
        </p>

        <?php the_title('<h1 id="du-article-heading" class="du-article-hero__title du-text-display-lg">', '</h1>'); ?>

        <?php if ($du_excerpt) : ?>
            <p class="du-article-hero__excerpt du-text-quote__lg">
                <?php echo esc_html($du_excerpt); ?>
            </p>
        <?php endif; ?>

        <div class="du-article-hero__byline">
            <a href="<?php echo esc_url(get_author_posts_url($du_author_id)); ?>" class="du-article-hero__byline-avatar">
                <?php echo get_avatar($du_author_id, 40, '', '', ['class' => 'du-article-hero__avatar-image']); ?>
            </a>
            <div class="du-article-hero__byline-text">
                <a href="<?php echo esc_url(get_author_posts_url($du_author_id)); ?>" class="du-article-hero__byline-name">
                    <?php the_author(); ?>
                </a>
                <time class="du-article-hero__byline-date du-text-caption" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </div>
        </div>

    </div>
</header>
