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