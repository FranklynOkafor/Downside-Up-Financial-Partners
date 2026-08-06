<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Single Article template — helper functions and content shortcodes.
 * Companion to template-parts/heroes/hero-article.php and the
 * template-parts/components/* files used by single.php.
 */

/**
 * Pull Quote shortcode.
 *
 * Usage in the post editor / content:
 *   [du_pullquote citation="Dr. Alistair Vaughn, Chief Strategist"]
 *   The most dangerous risk is the one you haven't given a name to.
 *   [/du_pullquote]
 *
 * Reuses .du-text-quote (existing serif-italic quote style from
 * _typography.css) for the quote text itself — only the surrounding card
 * (accent border, spacing, citation) is new, in _article-content.css.
 */
function downside_up_pullquote_shortcode($atts, $content = null)
{
    $atts = shortcode_atts([
        'citation' => '',
    ], $atts, 'du_pullquote');

    $content = trim(wpautop(do_shortcode($content)));

    if (empty($content)) {
        return '';
    }

    $citation_html = '';
    if (!empty($atts['citation'])) {
        $citation_html = sprintf(
            '<cite class="du-pullquote__citation du-text-label-caps">— %s</cite>',
            esc_html($atts['citation'])
        );
    }

    return sprintf(
        '<blockquote class="du-pullquote"><div class="du-pullquote__mark du-text-quote">%s</div>%s</blockquote>',
        $content,
        $citation_html
    );
}
add_shortcode('du_pullquote', 'downside_up_pullquote_shortcode');

/**
 * Editorial Callout shortcode.
 *
 * Usage:
 *   [du_callout type="insight" title="Key Insight"]Copy goes here.[/du_callout]
 *
 * type: insight | warning | recommendation | key-takeaway
 * Colors reuse the site's existing semantic "Traffic Light" tokens
 * (--success/--fragile/--critical from _variable.css) rather than
 * inventing new callout-specific colors.
 */
function downside_up_callout_shortcode($atts, $content = null)
{
    $atts = shortcode_atts([
        'type'  => 'insight',
        'title' => '',
    ], $atts, 'du_callout');

    $types = [
        'insight'        => [
            'icon'  => 'lightbulb',
            'label' => __('Insight', 'downside-up'),
        ],
        'warning'        => [
            'icon'  => 'alert-triangle',
            'label' => __('Warning', 'downside-up'),
        ],
        'recommendation' => [
            'icon'  => 'compass',
            'label' => __('Recommendation', 'downside-up'),
        ],
        'key-takeaway'   => [
            'icon'  => 'circle-check',
            'label' => __('Key Takeaway', 'downside-up'),
        ],
    ];

    $type = isset($types[$atts['type']]) ? $atts['type'] : 'insight';
    $meta = $types[$type];
    $title = !empty($atts['title']) ? $atts['title'] : $meta['label'];
    $content = trim(wpautop(do_shortcode($content)));

    if (empty($content)) {
        return '';
    }

    return sprintf(
        '<div class="du-callout du-callout--%1$s"><div class="du-callout__icon" aria-hidden="true">%2$s</div><div class="du-callout__body"><p class="du-callout__title du-text-label-caps">%3$s</p><div class="du-callout__content du-text-body-md">%4$s</div></div></div>',
        esc_attr($type),
        downside_up_icon($meta['icon'], ['width' => 18, 'height' => 18]),
        esc_html($title),
        $content
    );
}
add_shortcode('du_callout', 'downside_up_callout_shortcode');

/**
 * The primary category term for a post (Categories = pills, per the
 * project's existing convention documented in inc/resources.php).
 * Used by the Article Hero eyebrow.
 *
 * @param int|null $post_id
 * @return WP_Term|null
 */
function downside_up_get_primary_category($post_id = null)
{
    $post_id = $post_id ? $post_id : get_the_ID();
    $categories = get_the_category($post_id);

    return !empty($categories) ? $categories[0] : null;
}

/**
 * Short author bio for the Author Card. Wraps get_the_author_meta()
 * so the template doesn't need to know the meta key or fall back copy.
 *
 * @param int $author_id
 * @return string
 */
function downside_up_get_author_bio($author_id)
{
    $bio = get_the_author_meta('description', $author_id);

    return $bio ? $bio : '';
}
