<?php

/**
 * Data/query functions for the Resources page (templates/template-resources.php).
 * One file per feature domain, matching inc/how-we-help.php, inc/hero.php, etc.
 */

/**
 * The single post to show in the Featured Resource section.
 *
 * "Featured" is editorial, not automatic: a post is featured by tagging or
 * categorizing it "featured" (matches the project's Categories = pills /
 * Tags = badges convention). Falls back to the most recent published post
 * so the section always has content even before anything is tagged.
 *
 * @return WP_Post|null
 */
function downside_up_get_featured_resource_post()
{
    $featured_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'no_found_rows'  => true,
        'tax_query'      => [
            'relation' => 'OR',
            [
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => 'featured',
            ],
            [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => 'featured',
            ],
        ],
    ]);

    if ($featured_query->have_posts()) {
        return $featured_query->posts[0];
    }

    $latest_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'no_found_rows'  => true,
    ]);

    return $latest_query->have_posts() ? $latest_query->posts[0] : null;
}

/**
 * Estimated reading time for a post, auto-calculated from its content
 * (no meta field required). ~200 words per minute, rounded up, minimum 1.
 *
 * @param int|null $post_id Defaults to the current post in the loop.
 * @return int Minutes.
 */
function downside_up_reading_time($post_id = null)
{
    $post_id = $post_id ? $post_id : get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(wp_strip_all_tags(strip_shortcodes($content)));

    return max(1, (int) ceil($word_count / 200));
}
/**
 * Goal Navigation terms.
 *
 * Categories = pills (per project convention). Only categories with at
 * least one published post are shown, so the row never has dead links.
 * "All Resources" is prepended as the default/reset state.
 *
 * @return array List of ['label' => string, 'slug' => string|null].
 *               A null slug represents "All Resources".
 */
function downside_up_get_resource_goal_terms()
{
    $terms = [
        [
            'label' => __('All Resources', 'downside-up'),
            'slug'  => null,
        ],
    ];

    $categories = get_categories([
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ]);

    foreach ($categories as $category) {
        $terms[] = [
            'label' => $category->name,
            'slug'  => $category->slug,
        ];
    }

    return $terms;
}

/**
 * The currently active goal/category, read from the 'resource_category'
 * query var. Shared by the Goal Navigation (to mark the active pill) and
 * the Resource Grid (to filter its query) so the two stay in sync without
 * any JS/AJAX — filtering is a plain link + query var.
 *
 * @return string|null Category slug, or null for "All Resources".
 */
function downside_up_get_active_resource_goal()
{
    if (empty($_GET['resource_category'])) {
        return null;
    }

    $slug = sanitize_title(wp_unslash($_GET['resource_category']));

    return term_exists($slug, 'category') ? $slug : null;
}
