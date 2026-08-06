<?php
/**
 * Related Articles — Single Article template.
 * Loaded via: get_template_part( 'template-parts/sections/related-articles' );
 * Must run inside the Loop (uses the current post's ID/categories).
 *
 * Reuses the Resource Card component and the Resource Grid's responsive
 * grid classes as-is. Related = same primary category, most recent first,
 * excluding the current post; falls back to latest posts site-wide if the
 * current post has no category or there aren't enough related posts.
 */

$du_current_id = get_the_ID();
$du_category   = downside_up_get_primary_category($du_current_id);

$du_args = [
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'post__not_in'   => [$du_current_id],
    'no_found_rows'  => true,
    'orderby'        => 'date',
    'order'          => 'DESC',
];

if ($du_category) {
    $du_args['category__in'] = [$du_category->term_id];
}

$du_related = new WP_Query($du_args);

// Not enough related-by-category posts — top up with latest posts site-wide.
if ($du_related->post_count < 3 && $du_category) {
    $du_related = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'post__not_in'   => [$du_current_id],
        'no_found_rows'  => true,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
}

if (!$du_related->have_posts()) {
    return;
}
?>
<section class="du-resource-grid du-related-articles" aria-labelledby="du-related-heading">
    <div class="du-container">

        <h2 id="du-related-heading" class="du-related-articles__heading du-text-headline-xl">
            <?php esc_html_e('Continue the Deep Dive', 'downside-up'); ?>
        </h2>

        <div class="du-resource-grid__grid">
            <?php while ($du_related->have_posts()) : $du_related->the_post(); ?>
                <?php
                get_template_part('template-parts/cards/resource-card', null, [
                    'post'              => get_post(),
                    'show_reading_time' => true,
                ]);
                ?>
            <?php endwhile; ?>
        </div>

    </div>
</section>
<?php
wp_reset_postdata();
