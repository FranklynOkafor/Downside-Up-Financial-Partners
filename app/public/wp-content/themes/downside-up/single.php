<?php
/**
 * The template for displaying all single posts.
 *
 * Assembles the Lego components built for the premium editorial Single
 * Article template:
 *   - template-parts/heroes/hero-article.php        (Article Hero)
 *   - template-parts/components/featured-image.php  (Featured Image)
 *   - template-parts/components/reading-progress.php(Reading Progress Bar)
 *   - template-parts/components/table-of-contents.php (Sticky TOC)
 *   - template-parts/components/share-toolbar.php   (Floating Share Toolbar)
 *   - template-parts/components/author-card.php     (Author Card)
 *   - template-parts/components/article-navigation.php (Prev/Next)
 *   - template-parts/sections/related-articles.php  (Related Articles)
 * Article body typography/pull-quotes/callouts come from _article-content.css
 * (applies to whatever the_content() outputs — no per-page styling here).
 *
 * @package Downside-up
 */

get_header();
?>

<?php get_template_part('template-parts/components/reading-progress'); ?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('du-article'); ?>>

            <?php get_template_part('template-parts/heroes/hero', 'article'); ?>

            <div class="du-container du-article__featured-image-wrap">
                <?php
                get_template_part('template-parts/components/featured-image', null, [
                    'post' => get_post(),
                    'size' => 'large',
                ]);
                ?>
            </div>

            <div class="du-article-layout du-container">

                <?php get_template_part('template-parts/components/table-of-contents'); ?>

                <div class="du-article-layout__content">

                    <div class="du-article__content" data-du-article-content>
                        <?php
                        the_content();

                        wp_link_pages([
                            'before' => '<div class="du-article__pagination du-text-body-md">' . esc_html__('Pages:', 'downside-up'),
                            'after'  => '</div>',
                        ]);
                        ?>
                    </div>

                    <?php
                    // Assessment CTA — reuses the existing CTA system's
                    // 'inline' variant (see template-parts/cta/cta-card.php)
                    // with the 'resource-discovery' persona, the persona
                    // already written for general/undecided readers.
                    downside_up_cta('resource-discovery', 'inline');
                    ?>

                </div>

                <?php get_template_part('template-parts/components/share-toolbar'); ?>

            </div>

            <div class="du-container">
                <div class="du-article-end">
                    <?php get_template_part('template-parts/components/author-card'); ?>
                </div>
            </div>

        </article>

        <div class="du-container">
            <div class="du-article-end">
                <?php get_template_part('template-parts/components/article-navigation'); ?>
            </div>
        </div>

        <?php
        if (comments_open() || get_comments_number()) :
            ?>
            <div class="du-container">
                <div class="du-article-end">
                    <?php comments_template(); ?>
                </div>
            </div>
            <?php
        endif;
        ?>

    <?php endwhile; ?>

    <?php get_template_part('template-parts/sections/related-articles'); ?>

</main>

<?php
get_footer();
